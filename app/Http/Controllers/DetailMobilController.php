<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDetailMobilRequest;
use App\Http\Requests\UpdateDetailMobilRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DetailMobil;
use Illuminate\Http\Request;
use Flash;
use Response;

class DetailMobilController extends AppBaseController
{
    /**
     * Display a listing of the DetailMobil.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var DetailMobil $detailMobils */
        $detailMobils = DetailMobil::all();

        return view('detail_mobils.index')
            ->with('detailMobils', $detailMobils);
    }

    /**
     * Show the form for creating a new DetailMobil.
     *
     * @return Response
     */
    public function create()
    {
        return view('detail_mobils.create');
    }

    /**
     * Store a newly created DetailMobil in storage.
     *
     * @param CreateDetailMobilRequest $request
     *
     * @return Response
     */
    public function store(CreateDetailMobilRequest $request)
    {
        $input = $request->all();

        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::create($input);

        Flash::success('Detail Mobil saved successfully.');

        return redirect(route('detailMobils.index'));
    }

    /**
     * Display the specified DetailMobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::find($id);

        if (empty($detailMobil)) {
            Flash::error('Detail Mobil not found');

            return redirect(route('detailMobils.index'));
        }

        return view('detail_mobils.show')->with('detailMobil', $detailMobil);
    }

    /**
     * Show the form for editing the specified DetailMobil.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::find($id);

        if (empty($detailMobil)) {
            Flash::error('Detail Mobil not found');

            return redirect(route('detailMobils.index'));
        }

        return view('detail_mobils.edit')->with('detailMobil', $detailMobil);
    }

    /**
     * Update the specified DetailMobil in storage.
     *
     * @param int $id
     * @param UpdateDetailMobilRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDetailMobilRequest $request)
    {
        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::find($id);

        if (empty($detailMobil)) {
            Flash::error('Detail Mobil not found');

            return redirect(route('detailMobils.index'));
        }

        $detailMobil->fill($request->all());
        $detailMobil->save();

        Flash::success('Detail Mobil updated successfully.');

        return redirect(route('detailMobils.index'));
    }

    /**
     * Remove the specified DetailMobil from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::find($id);

        if (empty($detailMobil)) {
            Flash::error('Detail Mobil not found');

            return redirect(route('detailMobils.index'));
        }

        $detailMobil->delete();

        Flash::success('Detail Mobil deleted successfully.');

        return redirect(route('detailMobils.index'));
    }
}
