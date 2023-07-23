<?php

namespace App\Console\Commands;

use App\Models\Rental;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class RentalScedule extends Command
{
    /**
     * The rentalscedule and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:rentalscedule';

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
        // status pembatalan 5 menit diambil dari second
        $rental = Rental::where('status', 'pemesanan')->where('waktu_peminjaman', '<=', (Carbon::now()->timestamp - 300))->get();
        // prin in console
        Log::info('change status pemesanan');
        foreach ($rental as $key => $value) {
            if ($value->detailPembayaran->count() == 0) {
                $value->status = 'batal';
                $value->save();
                Log::info($value->id . ' - change status pemesanan (batal) 1');
                $this->info($value->id . ' - change status pemesanan (batal)');
                NotificationService::add("pelanggan", $rental->pelanggan_id, "Pembatalan rental", "Rental dengan  " . $value->detailMobil->mobil->nama . " telah dibatalkan karena tidak melakukan pembayaran dalam waktu 5 menit setelah melakukan pemesanan", route('pelangan.rentals.index'));
            }
        }
        // notify pada pelanggan 30 menit sebelum berjalan
        $rental = Rental::where('status', 'pemesanan')->where('waktu_mulai',  (Carbon::now()->timestamp+ 1800))->get();
        foreach ($rental as $key => $value) {

                NotificationService::add("pelanggan",$rental->pelanggan_id, "Pengambilan rental Mobil.", "Ayo segera ambil kendaraanmu ".$rental->detailMobil->mobil->nama, route('pelangan.rentals.index'));
        }
        // return 1;
    }
}