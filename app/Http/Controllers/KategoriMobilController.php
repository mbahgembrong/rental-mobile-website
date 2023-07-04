<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKategoriMobilRequest;
use App\Http\Requests\UpdateKategoriMobilRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\KategoriMobil;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;

class KategoriMobilController extends AppBaseController
{
    /**
     * Display a listing of the KategoriMobil.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var KategoriMobil $kategoriMobils */
        $kategoriMobils = KategoriMobil::orderBy('created_at', 'DESC')->get();

        return view('kategori_mobils.index')
            ->with('kategoriMobils', $kategoriMobils);
    }

    /**
     * Show the form for creating a new KategoriMobil.
     *
     * @return Response
     */
    public function create()
    {
        return view('kategori_mobils.create');
    }

    /**
     * Store a newly created KategoriMobil in storage.
     *
     * @param CreateKategoriMobilRequest $request
     *
     * @return Response
     */
    public function store(CreateKategoriMobilRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('foto')) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('kategoriMobils/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        }
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::create($input);

        Flash::success('Kategori Mobil saved successfully.');

        return redirect(route('kategoriMobils.index'));
    }

    /**
     * Display the specified KategoriMobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            Flash::error('Kategori Mobil not found');

            return redirect(route('kategoriMobils.index'));
        }

        return view('kategori_mobils.show')->with('kategoriMobil', $kategoriMobil);
    }

    /**
     * Show the form for editing the specified KategoriMobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            Flash::error('Kategori Mobil not found');

            return redirect(route('kategoriMobils.index'));
        }

        return view('kategori_mobils.edit')->with('kategoriMobil', $kategoriMobil);
    }

    /**
     * Update the specified KategoriMobil in storage.
     *
     * @param int $id
     * @param UpdateKategoriMobilRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKategoriMobilRequest $request)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            Flash::error('Kategori Mobil not found');

            return redirect(route('kategoriMobils.index'));
        }
        $input = $request->all();
        if ($request->hasFile('foto') &&( $request->file('foto')->getClientOriginalName() != $kategoriMobil->foto)) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('kategoriMobils/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);
        $kategoriMobil->fill($input);
        $kategoriMobil->save();

        Flash::success('Kategori Mobil updated successfully.');

        return redirect(route('kategoriMobils.index'));
    }

    /**
     * Remove the specified KategoriMobil from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            Flash::error('Kategori Mobil not found');

            return redirect(route('kategoriMobils.index'));
        }

        $kategoriMobil->delete();

        Flash::success('Kategori Mobil deleted successfully.');

        return redirect(route('kategoriMobils.index'));
    }
}
