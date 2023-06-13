<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if (!is_null($request->date)) {
            $date = Carbon::createFromTimestamp($request->date);
            $rentals = Rental::where('status', 'selesai')->whereYear('updated_at', $date->format('Y'))->whereMonth('updated_at', $date->format('m'))->get();
        } else
            $rentals = Rental::where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', date('m'))->get();
        return view('laporan.index', compact('rentals'));
    }
}
