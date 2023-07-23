<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DendaScedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dendascedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // toleransi waktu denda 30 menit diambil dari second
        $rental = Rental::whereIn('status', ['berjalan', 'terlambat'])->where('waktu_selesai', '<', (Carbon::now()->timestamp + 1800))->get();
        foreach ($rental as $rental) {
            $rental->status = 'terlambat';
            $rental->status_pembayaran = 'belum';
            $rental->waktu_denda = Carbon::now()->timestamp;
            $rental->denda = round(($rental->waktu_denda - $rental->waktu_selesai) / ($rental->detailMobil->mobil->satuan == 'hari' ? 86400 : 3600)) * $rental->detailMobil->mobil->denda;
            $rental->grand_total = $rental->total + $rental->denda;
            $rental->save();
            Log::info($rental->id . ' - change status pemesanan (terlambat)');
            $this->info($rental->id . ' - change status pemesanan (terlambat)');
            if (!NotificationService::isTerlambatNotify($rental->pelanggan_id, $rental->detailMobil->mobil->nama)) {
                NotificationService::add("pelanggan", $rental->pelanggan_id, "Terlambat", "Rental dengan " . $rental->detailMobil->mobil->nama . " telah terlambat", route('pelangan.rentals.index'));
            }
        }
        // return 1
    }
}