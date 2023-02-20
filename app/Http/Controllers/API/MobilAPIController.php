<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMobilAPIRequest;
use App\Http\Requests\API\UpdateMobilAPIRequest;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MobilController
 * @package App\Http\Controllers\API
 */

class MobilAPIController extends AppBaseController
{
    /**
     * Display a listing of the Mobil.
     * GET|HEAD /mobils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Mobil::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $mobils = $query->get();

        return $this->sendResponse($mobils->toArray(), 'Mobils retrieved successfully');
    }

    /**
     * Store a newly created Mobil in storage.
     * POST /mobils
     *
     * @param CreateMobilAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMobilAPIRequest $request)
    {
        $input = $request->all();

        /** @var Mobil $mobil */
        $mobil = Mobil::create($input);

        return $this->sendResponse($mobil->toArray(), 'Mobil saved successfully');
    }

    /**
     * Display the specified Mobil.
     * GET|HEAD /mobils/{id}
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
            return $this->sendError('Mobil not found');
        }

        return $this->sendResponse($mobil->toArray(), 'Mobil retrieved successfully');
    }

    /**
     * Update the specified Mobil in storage.
     * PUT/PATCH /mobils/{id}
     *
     * @param int $id
     * @param UpdateMobilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMobilAPIRequest $request)
    {
        /** @var Mobil $mobil */
        $mobil = Mobil::find($id);

        if (empty($mobil)) {
            return $this->sendError('Mobil not found');
        }

        $mobil->fill($request->all());
        $mobil->save();

        return $this->sendResponse($mobil->toArray(), 'Mobil updated successfully');
    }

    /**
     * Remove the specified Mobil from storage.
     * DELETE /mobils/{id}
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
            return $this->sendError('Mobil not found');
        }

        $mobil->delete();

        return $this->sendSuccess('Mobil deleted successfully');
    }
}
