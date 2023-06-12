<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Rental;
use App\Models\Sopir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $card = [];
        $chart = [];
        $labels = array_chunk(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], date('m'))[0];

        if (!Auth::guard('pelanggan')->check()) { // pelanggan
            foreach ($labels as $index => $label) {
                $pelanggan = Pelanggan::whereYear('created_at', date('Y'))->whereMonth('created_at', $index + 1)->get()->count();
                $card['pelanggan'][] = $pelanggan;
            }
            // pendapatan
            foreach ($labels as $index => $label) {
                $pendapatan = Rental::where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->sum('grand_total');
                $card['pendapatan'][] = $pendapatan;
            }
            // penyewaan
            foreach ($labels as $index => $label) {
                $penyewaan = Rental::where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->count();
                $card['penyewaan'][] = $penyewaan;
            }
            // sopir
            foreach ($labels as $index => $label) {
                $sopir = Sopir::whereYear('created_at', date('Y'))->whereMonth('created_at', $index + 1)->get()->sum('sopir');
                $card['sopir'][] = $sopir;
            }
            $mobils = Mobil::all();
            foreach ($mobils as $key => $mobil) {
                foreach ($labels as $index => $label) {
                    $sumCarRental = 0;
                    foreach ($mobil->detailMobils as $detail) {
                        if (!is_null($detail->rental))
                            $sumCarRental += $detail->rental()->where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->count();
                    }
                    $chart[$key]['data'][] = $sumCarRental;
                }
                $chart[$key]['label'] = $mobil->nama;
            }

            return view('home', compact(['card', 'labels', 'chart']));
        } else {
            return view('home');
        }
    }

}
