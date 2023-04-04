<?php

namespace App\Console\Commands;

use App\Models\Rental;
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
        $rental = Rental::whereIn('status', ['berjalan', 'terlambat'])->where('waktu_selesai', '<', (Carbon::now()->timestamp + 30))->get();
        foreach ($rental as $rental) {
            $rental->status = 'terlambat';
            $rental->waktu_denda = Carbon::now()->timestamp;
            $rental->denda = round(($rental->waktu_denda - $rental->waktu_selesai) / ($rental->detailMobil->mobil->satuan == 'hari' ? 86_400 : 3_600)) * $rental->detailMobil->mobil->denda;
            $rental->grand_total = $rental->total + $rental->denda;

            $rental->save();
            Log::info($rental->id . ' - change status pemesanan (terlambat)');
            $this->info($rental->id . ' - change status pemesanan (terlambat)');
        }
        // return 1
    }
}