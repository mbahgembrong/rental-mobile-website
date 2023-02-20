<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRentalAPIRequest;
use App\Http\Requests\API\UpdateRentalAPIRequest;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RentalController
 * @package App\Http\Controllers\API
 */

class RentalAPIController extends AppBaseController
{
    /**
     * Display a listing of the Rental.
     * GET|HEAD /rentals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Rental::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $rentals = $query->get();

        return $this->sendResponse($rentals->toArray(), 'Rentals retrieved successfully');
    }

    /**
     * Store a newly created Rental in storage.
     * POST /rentals
     *
     * @param CreateRentalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRentalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rental $rental */
        $rental = Rental::create($input);

        return $this->sendResponse($rental->toArray(), 'Rental saved successfully');
    }

    /**
     * Display the specified Rental.
     * GET|HEAD /rentals/{id}
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
            return $this->sendError('Rental not found');
        }

        return $this->sendResponse($rental->toArray(), 'Rental retrieved successfully');
    }

    /**
     * Update the specified Rental in storage.
     * PUT/PATCH /rentals/{id}
     *
     * @param int $id
     * @param UpdateRentalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRentalAPIRequest $request)
    {
        /** @var Rental $rental */
        $rental = Rental::find($id);

        if (empty($rental)) {
            return $this->sendError('Rental not found');
        }

        $rental->fill($request->all());
        $rental->save();

        return $this->sendResponse($rental->toArray(), 'Rental updated successfully');
    }

    /**
     * Remove the specified Rental from storage.
     * DELETE /rentals/{id}
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
            return $this->sendError('Rental not found');
        }

        $rental->delete();

        return $this->sendSuccess('Rental deleted successfully');
    }
}
