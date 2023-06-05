<?php

namespace App\Console\Commands;

use App\Models\Rental;
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
        $rental = Rental::where('status', 'pemesanan')->where('waktu_mulai', '<=', (Carbon::now()->timestamp - 30))->get();
        foreach ($rental as $key => $value) {
            if ($value->detailPembayaran()->orderBy('created_at', 'DESC')->first() == null) {
                $value->status = 'batal';
                $value->save();
                Log::info($value->id . ' - change status pemesanan (batal)');
                $this->info($value->id . ' - change status pemesanan (batal)');
            }
        }
        // return 1;
    }
}