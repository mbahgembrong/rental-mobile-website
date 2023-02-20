<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Rental;
use Illuminate\Http\Request;
use Flash;
use Response;

class RentalController extends AppBaseController
{
    /**
     * Display a listing of the Rental.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Rental $rentals */
        $rentals = Rental::all();

        return view('rentals.index')
            ->with('rentals', $rentals);
    }

    /**
     * Show the form for creating a new Rental.
     *
     * @return Response
     */
    public function create()
    {
        return view('rentals.create');
    }

    /**
     * Store a newly created Rental in storage.
     *
     * @param CreateRentalRequest $request
     *
     * @return Response
     */
    public function store(CreateRentalRequest $request)
    {
        $input = $request->all();

        /** @var Rental $rental */
        $rental = Rental::create($input);

        Flash::success('Rental saved successfully.');

        return redirect(route('rentals.index'));
    }

    /**
     * Display the specified Rental.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rental $rental */
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }

        return view('rentals.show')->with('rental', $rental);
    }

    /**
     * Show the form for editing the specified Rental.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Rental $rental */
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }

        return view('rentals.edit')->with('rental', $rental);
    }

    /**
     * Update the specified Rental in storage.
     *
     * @param int $id
     * @param UpdateRentalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRentalRequest $request)
    {
        /** @var Rental $rental */
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }

        $rental->fill($request->all());
        $rental->save();

        Flash::success('Rental updated successfully.');

        return redirect(route('rentals.index'));
    }

    /**
     * Remove the specified Rental from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rental $rental */
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }

        $rental->delete();

        Flash::success('Rental deleted successfully.');

        return redirect(route('rentals.index'));
    }
}
