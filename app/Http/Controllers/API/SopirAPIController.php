<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSopirAPIRequest;
use App\Http\Requests\API\UpdateSopirAPIRequest;
use App\Models\Sopir;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SopirController
 * @package App\Http\Controllers\API
 */

class SopirAPIController extends AppBaseController
{
    /**
     * Display a listing of the Sopir.
     * GET|HEAD /sopirs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Sopir::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $sopirs = $query->get();

        return $this->sendResponse($sopirs->toArray(), 'Sopirs retrieved successfully');
    }

    /**
     * Store a newly created Sopir in storage.
     * POST /sopirs
     *
     * @param CreateSopirAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSopirAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sopir $sopir */
        $sopir = Sopir::create($input);

        return $this->sendResponse($sopir->toArray(), 'Sopir saved successfully');
    }

    /**
     * Display the specified Sopir.
     * GET|HEAD /sopirs/{id}
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
            return $this->sendError('Sopir not found');
        }

        return $this->sendResponse($sopir->toArray(), 'Sopir retrieved successfully');
    }

    /**
     * Update the specified Sopir in storage.
     * PUT/PATCH /sopirs/{id}
     *
     * @param int $id
     * @param UpdateSopirAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSopirAPIRequest $request)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            return $this->sendError('Sopir not found');
        }

        $sopir->fill($request->all());
        $sopir->save();

        return $this->sendResponse($sopir->toArray(), 'Sopir updated successfully');
    }

    /**
     * Remove the specified Sopir from storage.
     * DELETE /sopirs/{id}
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
            return $this->sendError('Sopir not found');
        }

        $sopir->delete();

        return $this->sendSuccess('Sopir deleted successfully');
    }
}
