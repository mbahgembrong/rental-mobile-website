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
        $rental = Rental::where('status', 'pemesanan')->where('waktu_peminjaman', '<=', (Carbon::now()->timestamp - 300))->get();
        // prin in console
        Log::info('change status pemesanan');
        foreach ($rental as $key => $value) {
            if ($value->detailPembayaran()->count() == 0) {
                $value->status = 'batal';
                $value->save();
                Log::info($value->id . ' - change status pemesanan (batal)');
                $this->info($value->id . ' - change status pemesanan (batal)');
                NotificationService::add("pelanggan", $rental->pelanggan_id, "Pembatalan rental", "Rental dengan id " . $value->id . " telah dibatalkan karena tidak melakukan pembayaran dalam waktu 5 menit setelah melakukan pemesanan", route('pelangan.rentals.index'));
            } elseif ($value->status == 'pemesanan' && $value->where('waktu_selesai', '<=', (Carbon::now()->timestamp))) {
                $value->status = 'batal';
                $value->save();
                Log::info($value->id . ' - change status pemesanan (batal)');
                $this->info($value->id . ' - change status pemesanan (batal)');
                NotificationService::add("pelanggan", "Pembatalan rental", $rental->pelanggan_id, "
                Rental dengan id " . $value->id . " telah dibatalkan karena tidak melakukan pembayaran dalam waktu 5 menit setelah melakukan pemesanan", route('pelangan.rentals.index'));
            }
        }
        return 1;
    }
}