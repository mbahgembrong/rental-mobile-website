<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKategoriMobilAPIRequest;
use App\Http\Requests\API\UpdateKategoriMobilAPIRequest;
use App\Models\KategoriMobil;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KategoriMobilController
 * @package App\Http\Controllers\API
 */

class KategoriMobilAPIController extends AppBaseController
{
    /**
     * Display a listing of the KategoriMobil.
     * GET|HEAD /kategoriMobils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = KategoriMobil::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $kategoriMobils = $query->get();

        return $this->sendResponse($kategoriMobils->toArray(), 'Kategori Mobils retrieved successfully');
    }

    /**
     * Store a newly created KategoriMobil in storage.
     * POST /kategoriMobils
     *
     * @param CreateKategoriMobilAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKategoriMobilAPIRequest $request)
    {
        $input = $request->all();

        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::create($input);

        return $this->sendResponse($kategoriMobil->toArray(), 'Kategori Mobil saved successfully');
    }

    /**
     * Display the specified KategoriMobil.
     * GET|HEAD /kategoriMobils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            return $this->sendError('Kategori Mobil not found');
        }

        return $this->sendResponse($kategoriMobil->toArray(), 'Kategori Mobil retrieved successfully');
    }

    /**
     * Update the specified KategoriMobil in storage.
     * PUT/PATCH /kategoriMobils/{id}
     *
     * @param int $id
     * @param UpdateKategoriMobilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKategoriMobilAPIRequest $request)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            return $this->sendError('Kategori Mobil not found');
        }

        $kategoriMobil->fill($request->all());
        $kategoriMobil->save();

        return $this->sendResponse($kategoriMobil->toArray(), 'KategoriMobil updated successfully');
    }

    /**
     * Remove the specified KategoriMobil from storage.
     * DELETE /kategoriMobils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KategoriMobil $kategoriMobil */
        $kategoriMobil = KategoriMobil::find($id);

        if (empty($kategoriMobil)) {
            return $this->sendError('Kategori Mobil not found');
        }

        $kategoriMobil->delete();

        return $this->sendSuccess('Kategori Mobil deleted successfully');
    }
}
