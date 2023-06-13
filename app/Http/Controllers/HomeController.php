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
            // transaksi sebulan
            foreach ($labels as $index => $label) {
                $transaksi = Rental::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->count();
                $card['transaksi'][] = $transaksi;
            }
            // total pengeluaran
            foreach ($labels as $index => $label) {
                $pengeluaran = Rental::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->where('status', 'selesai')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->sum('grand_total');
                $card['pengeluaran'][] = $pengeluaran;
            }
            // total tanggungan
            foreach ($labels as $index => $label) {
                $rentals = Rental::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->whereIn('status', ['pemesanan', 'terlambat'])->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get();
                $sumTanggungan = 0;
                foreach ($rentals as $key => $rental) {
                    $sumTanggungan += $rental->grand_total - ($rental->detailPembayaran()->orderBy('updated_at', 'DESC')->get()->sum('jumlah') ?: 0);
                }
                $card['tanggungan'][] = $sumTanggungan;
            }
            // total transaksi yang dibatalkan
            foreach ($labels as $index => $label) {
                $batal = Rental::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->where('status', 'batal')->whereYear('updated_at', date('Y'))->whereMonth('updated_at', $index + 1)->get()->count();
                $card['batal'][] = $batal;
            }
            return view('home', compact(['labels', 'card']));
        }
    }

}
