<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSopirRequest;
use App\Http\Requests\UpdateSopirRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Sopir;
use Illuminate\Http\Request;
use Flash;
use Response;

class SopirController extends AppBaseController
{
    /**
     * Display a listing of the Sopir.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Sopir $sopirs */
        $sopirs = Sopir::all();

        return view('sopirs.index')
            ->with('sopirs', $sopirs);
    }

    /**
     * Show the form for creating a new Sopir.
     *
     * @return Response
     */
    public function create()
    {
        return view('sopirs.create');
    }

    /**
     * Store a newly created Sopir in storage.
     *
     * @param CreateSopirRequest $request
     *
     * @return Response
     */
    public function store(CreateSopirRequest $request)
    {
        $input = $request->all();

        /** @var Sopir $sopir */
        $sopir = Sopir::create($input);

        Flash::success('Sopir saved successfully.');

        return redirect(route('sopirs.index'));
    }

    /**
     * Display the specified Sopir.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        return view('sopirs.show')->with('sopir', $sopir);
    }

    /**
     * Show the form for editing the specified Sopir.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        return view('sopirs.edit')->with('sopir', $sopir);
    }

    /**
     * Update the specified Sopir in storage.
     *
     * @param int $id
     * @param UpdateSopirRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSopirRequest $request)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        $sopir->fill($request->all());
        $sopir->save();

        Flash::success('Sopir updated successfully.');

        return redirect(route('sopirs.index'));
    }

    /**
     * Remove the specified Sopir from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        $sopir->delete();

        Flash::success('Sopir deleted successfully.');

        return redirect(route('sopirs.index'));
    }
}
