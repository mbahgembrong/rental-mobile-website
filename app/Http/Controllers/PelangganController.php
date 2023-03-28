<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
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
        if ($request->hasFile('ktp')) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        }
        if ($request->hasFile('foto')) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        }
        $input['password'] = bcrypt($input['password']);
        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');

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
        $input = $request->all();
        if ($request->hasFile('ktp') && $request->file('ktp')->getClientOriginalName() != $pelanggan->ktp) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        } else
            unset($input['ktp']);
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $pelanggan->foto) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);

        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');
        if ($input['password'] == null)
            unset($input['password']);
        else
            $input['password'] = bcrypt($input['password']);

        $pelanggan->fill($input);
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