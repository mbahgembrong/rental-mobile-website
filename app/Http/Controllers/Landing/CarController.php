<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\KategoriMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {

        $mobils = Mobil::where('kategori_id', 'LIKE', '%' . ($request->get('kategori_id') ?? '') . '%')->with(['kategoriMobil', 'detailMobils'])->paginate(30)
            ->appends(request()->except(['kategori_id']));
        $kategoris = KategoriMobil::pluck('nama', 'id');
        return view('landing.car', compact(['mobils', 'kategoris']));
    }
}