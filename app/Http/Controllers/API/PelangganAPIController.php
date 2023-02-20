<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePelangganAPIRequest;
use App\Http\Requests\API\UpdatePelangganAPIRequest;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PelangganController
 * @package App\Http\Controllers\API
 */

class PelangganAPIController extends AppBaseController
{
    /**
     * Display a listing of the Pelanggan.
     * GET|HEAD /pelanggans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Pelanggan::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $pelanggans = $query->get();

        return $this->sendResponse($pelanggans->toArray(), 'Pelanggans retrieved successfully');
    }

    /**
     * Store a newly created Pelanggan in storage.
     * POST /pelanggans
     *
     * @param CreatePelangganAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePelangganAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::create($input);

        return $this->sendResponse($pelanggan->toArray(), 'Pelanggan saved successfully');
    }

    /**
     * Display the specified Pelanggan.
     * GET|HEAD /pelanggans/{id}
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
            return $this->sendError('Pelanggan not found');
        }

        return $this->sendResponse($pelanggan->toArray(), 'Pelanggan retrieved successfully');
    }

    /**
     * Update the specified Pelanggan in storage.
     * PUT/PATCH /pelanggans/{id}
     *
     * @param int $id
     * @param UpdatePelangganAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePelangganAPIRequest $request)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            return $this->sendError('Pelanggan not found');
        }

        $pelanggan->fill($request->all());
        $pelanggan->save();

        return $this->sendResponse($pelanggan->toArray(), 'Pelanggan updated successfully');
    }

    /**
     * Remove the specified Pelanggan from storage.
     * DELETE /pelanggans/{id}
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
            return $this->sendError('Pelanggan not found');
        }

        $pelanggan->delete();

        return $this->sendSuccess('Pelanggan deleted successfully');
    }
}
