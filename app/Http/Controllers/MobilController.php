<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMobilRequest;
use App\Http\Requests\UpdateMobilRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DetailMobil;
use App\Models\KategoriMobil;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;

class MobilController extends AppBaseController
{
    /**
     * Display a listing of the Mobil.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Mobil $mobils */
        $mobils = Mobil::all();

        return view('mobils.index')
            ->with('mobils', $mobils);
    }

    /**
     * Show the form for creating a new Mobil.
     *
     * @return Response
     */
    public function create()
    {
        $kategori_mobils = KategoriMobil::pluck('nama', 'id');
        return view('mobils.create', compact('kategori_mobils'));
    }

    /**
     * Store a newly created Mobil in storage.
     *
     * @param CreateMobilRequest $request
     *
     * @return Response
     */
    public function store(CreateMobilRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('foto')) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('mobils/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        }
        /** @var Mobil $mobil */
        $mobil = Mobil::create($input);
        $detailMobilLength = count($input['stnk']);
        for ($i = 0; $i < $detailMobilLength; $i++) {
            $detailMobil = DetailMobil::create([
                'mobil_id' => $mobil->id,
                'plat' => $input['plat'][$i],
                'stnk' => $input['stnk'][$i],
                'tahun_mobil' => $input['tahun_mobil'][$i],
                'status' => 'tersedia',
            ]);
        }

        Flash::success('Mobil saved successfully.');

        return redirect(route('mobils.index'));
    }

    /**
     * Display the specified Mobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Mobil $mobil */
        $mobil = Mobil::find($id);

        if (empty($mobil)) {
            Flash::error('Mobil not found');

            return redirect(route('mobils.index'));
        }

        return view('mobils.show')->with('mobil', $mobil);
    }

    /**
     * Show the form for editing the specified Mobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Mobil $mobil */
        $mobil = Mobil::find($id);

        if (empty($mobil)) {
            Flash::error('Mobil not found');

            return redirect(route('mobils.index'));
        }
        $kategori_mobils = KategoriMobil::pluck('nama', 'id');
        return view('mobils.edit', compact('kategori_mobils'))->with('mobil', $mobil);
    }

    /**
     * Update the specified Mobil in storage.
     *
     * @param int $id
     * @param UpdateMobilRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMobilRequest $request)
    {
        /** @var Mobil $mobil */
        $mobil = Mobil::find($id);

        if (empty($mobil)) {
            Flash::error('Mobil not found');

            return redirect(route('mobils.index'));
        }
        $input = $request->all();
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $mobil->foto) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('mobils/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);
        $mobil->fill($input);
        $mobil->save();

        $detailMobilLength = count($request->plat);
        foreach ($mobil->detailMobils()->pluck('id')->toArray() as $value) {
            if (!in_array($value, $request->detail_mobil_id)) {
                DetailMobil::find($value)->delete();
            }
        }
        for ($i = 0; $i < $detailMobilLength; $i++) {
            if ($request->detail_mobil_id[$i] == null) {
                $detailMobil = DetailMobil::create([
                    'mobil_id' => $mobil->id,
                    'plat' => $request->plat[$i],
                    'stnk' => $request->stnk[$i],
                    'tahun_mobil' => $request->tahun_mobil[$i],
                    'status' => 'tersedia',
                ]);
            } else {
                $detailMobil = DetailMobil::find($request->detail_mobil_id[$i]);
                $detailMobil->fill([
                    'mobil_id' => $mobil->id,
                    'plat' => $request->plat[$i],
                    'stnk' => $request->stnk[$i],
                    'tahun_mobil' => $request->tahun_mobil[$i],
                    'status' => 'tersedia',
                ]);
                $detailMobil->save();
            }
            // if ($mobil->detailMobils()->where('plat', $request->plat[$i])->first() == null)

        }


        Flash::success('Mobil updated successfully.');

        return redirect(route('mobils.index'));
    }

    /**
     * Remove the specified Mobil from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Mobil $mobil */
        $mobil = Mobil::find($id);

        if (empty($mobil)) {
            Flash::error('Mobil not found');

            return redirect(route('mobils.index'));
        }

        $mobil->delete();

        Flash::success('Mobil deleted successfully.');

        return redirect(route('mobils.index'));
    }

    public function getMobil(Request $request, $idKategori)
    {
        try {

            $mobil = Mobil::where('kategori_id', $idKategori)->get();
            return response()->json([
                'status' => 'success',
                'data' => $mobil,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ]);
        }
    }
}
