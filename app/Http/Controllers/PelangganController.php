<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Flash;
use Response;

class PelangganController extends AppBaseController
{
    /**
     * Display a listing of the Pelanggan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Pelanggan $pelanggans */
        $pelanggans = Pelanggan::all();

        return view('pelanggans.index')
            ->with('pelanggans', $pelanggans);
    }

    /**
     * Show the form for creating a new Pelanggan.
     *
     * @return Response
     */
    public function create()
    {
        return view('pelanggans.create');
    }

    /**
     * Store a newly created Pelanggan in storage.
     *
     * @param CreatePelangganRequest $request
     *
     * @return Response
     */
    public function store(CreatePelangganRequest $request)
    {
        $input = $request->all();

        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::create($input);

        Flash::success('Pelanggan saved successfully.');

        return redirect(route('pelanggans.index'));
    }

    /**
     * Display the specified Pelanggan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        return view('pelanggans.show')->with('pelanggan', $pelanggan);
    }

    /**
     * Show the form for editing the specified Pelanggan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        return view('pelanggans.edit')->with('pelanggan', $pelanggan);
    }

    /**
     * Update the specified Pelanggan in storage.
     *
     * @param int $id
     * @param UpdatePelangganRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePelangganRequest $request)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        $pelanggan->fill($request->all());
        $pelanggan->save();

        Flash::success('Pelanggan updated successfully.');

        return redirect(route('pelanggans.index'));
    }

    /**
     * Remove the specified Pelanggan from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }

        $pelanggan->delete();

        Flash::success('Pelanggan deleted successfully.');

        return redirect(route('pelanggans.index'));
    }
}
