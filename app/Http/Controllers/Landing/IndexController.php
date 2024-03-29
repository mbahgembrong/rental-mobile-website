<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\KategoriMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = KategoriMobil::all();
        $mobils = Mobil::with([
            'kategoriMobil',
            'detailMobils',
        ])->chunkMap(
                function ($mobil) {
                    $mobil->countRentalMobil = $mobil->detailMobils->sum(
                        function ($detailMobil) {
                            return $detailMobil->rental->count();
                        }
                    );
                    return $mobil;
                }
            )->sortByDesc(
                'countRentalMobil'
            )
            ->take(5);
        return view('landing.index', compact(['kategoris', 'mobils']));
    }


    public function getMobil($idKategori)
    {
        $mobils = Mobil::where('kategori_id', $idKategori)->pluck('nama', 'id');
        return response()->json($mobils);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
