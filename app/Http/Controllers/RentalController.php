<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DetailMobil;
use App\Models\KategoriMobil;
use App\Models\Pelanggan;
use App\Models\Rental;
use App\Models\Sopir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
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
        $pelanggans = Pelanggan::pluck('nama', 'id');
        $kategoris = KategoriMobil::pluck('nama', 'id');

        return view('rentals.create', compact(['pelanggans', 'kategoris']));
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
        $input["waktu_peminjaman"] = Carbon::now()->timestamp;
        $input["waktu_mulai"] = Carbon::createFromFormat('Y-m-d H:i:s', $input['waktu_mulai'])->timestamp;
        $input["waktu_selesai"] = Carbon::createFromFormat('Y-m-d H:i:s', $input['waktu_selesai'])->timestamp;
        $input['waktu_denda'] = 0;
        $input['denda'] = 0;

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

    public function cekKetersediaanMobil(Request $request)
    {
        try {
            $mobilId = $request->mobil_id;
            $waktuMulai = $request->waktu_mulai || Carbon::now()->timestamp;
            $waktuSelesai = $request->waktu_selesai || Carbon::now()->timestamp;

            $mobil = DetailMobil::where('mobil_id', $mobilId)->whereNotExists(function ($query) use ($waktuMulai, $waktuSelesai) {
                $query->select(DB::raw(1))
                    ->from('rentals')
                    ->whereRaw('rentals.detail_mobil_id = detail_mobils.id')
                    ->where('waktu_mulai', '>=', $waktuMulai)->where('waktu_selesai', '<=', $waktuSelesai);
            })->get();

            return response()->json([
                'status' => 'success',
                'data' => $mobil
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function cekKetersediaanSopir(Request $request)
    {
        try {
            $waktuMulai = $request->waktu_mulai || Carbon::now()->timestamp;
            $waktuSelesai = $request->waktu_selesai || Carbon::now()->timestamp;

            $sopir = Sopir::whereNotExists(function ($query) use ($waktuMulai, $waktuSelesai) {
                $query->select(DB::raw(1))
                    ->from('rentals')
                    ->whereRaw('rentals.sopir_id = sopirs.id')
                    ->where('waktu_mulai', '>=', $waktuMulai)->where('waktu_selesai', '<=', $waktuSelesai);
            })->get();

            return response()->json([
                'status' => 'success',
                'data' => $sopir
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
