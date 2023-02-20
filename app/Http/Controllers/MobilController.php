<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMobilRequest;
use App\Http\Requests\UpdateMobilRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Flash;
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
        return view('mobils.create');
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

        /** @var Mobil $mobil */
        $mobil = Mobil::create($input);

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

        return view('mobils.edit')->with('mobil', $mobil);
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

        $mobil->fill($request->all());
        $mobil->save();

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
}
