<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDetailMobilAPIRequest;
use App\Http\Requests\API\UpdateDetailMobilAPIRequest;
use App\Models\DetailMobil;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DetailMobilController
 * @package App\Http\Controllers\API
 */

class DetailMobilAPIController extends AppBaseController
{
    /**
     * Display a listing of the DetailMobil.
     * GET|HEAD /detailMobils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DetailMobil::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $detailMobils = $query->get();

        return $this->sendResponse($detailMobils->toArray(), 'Detail Mobils retrieved successfully');
    }

    /**
     * Store a newly created DetailMobil in storage.
     * POST /detailMobils
     *
     * @param CreateDetailMobilAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDetailMobilAPIRequest $request)
    {
        $input = $request->all();

        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::create($input);

        return $this->sendResponse($detailMobil->toArray(), 'Detail Mobil saved successfully');
    }

    /**
     * Display the specified DetailMobil.
     * GET|HEAD /detailMobils/{id}
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
            return $this->sendError('Detail Mobil not found');
        }

        return $this->sendResponse($detailMobil->toArray(), 'Detail Mobil retrieved successfully');
    }

    /**
     * Update the specified DetailMobil in storage.
     * PUT/PATCH /detailMobils/{id}
     *
     * @param int $id
     * @param UpdateDetailMobilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDetailMobilAPIRequest $request)
    {
        /** @var DetailMobil $detailMobil */
        $detailMobil = DetailMobil::find($id);

        if (empty($detailMobil)) {
            return $this->sendError('Detail Mobil not found');
        }

        $detailMobil->fill($request->all());
        $detailMobil->save();

        return $this->sendResponse($detailMobil->toArray(), 'DetailMobil updated successfully');
    }

    /**
     * Remove the specified DetailMobil from storage.
     * DELETE /detailMobils/{id}
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
            return $this->sendError('Detail Mobil not found');
        }

        $detailMobil->delete();

        return $this->sendSuccess('Detail Mobil deleted successfully');
    }
}
