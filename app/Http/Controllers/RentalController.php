<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\DetailMobil;
use App\Models\DetailPembayaranRental;
use App\Models\KategoriMobil;
use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Rental;
use App\Models\Sopir;
use App\Models\Ulasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        if (Auth::guard('pelanggan')->check()) {
            $rentals = Rental::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->orderBy('created_at', 'desc')->get();
        } else {
            $rentals = Rental::orderBy('created_at', 'desc')->get();
        }
        return view('rentals.index')
            ->with('rentals', $rentals);
    }

    /**
     * Show the form for creating a new Rental.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->get('mobil_id') ?? false) {
            $mobil = Mobil::find($request->get('mobil_id'));
            $request->request->add(['kategori_id' => $mobil->kategori_id]);
        }
        $pelanggans = Pelanggan::pluck('nama', 'id');
        $kategoris = KategoriMobil::pluck('nama', 'id');

        return view('rentals.create', compact(['pelanggans', 'kategoris', 'request']));
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
        // dd($request->all());
        $input = $request->all();
        $input["waktu_peminjaman"] = Carbon::now()->timestamp;
        $input["waktu_mulai"] = Carbon::createFromFormat('Y-m-d H:i:s', $input['waktu_mulai'])->timestamp;
        $input["waktu_selesai"] = Carbon::createFromFormat('Y-m-d H:i:s', $input['waktu_selesai'])->timestamp;
        $input['waktu_denda'] = 0;
        $input['denda'] = 0;

        /** @var Rental $rental */
        $rental = Rental::create($input);

        Flash::success('Rental saved successfully.');
        if (Auth::guard('pelanggan')->check())
            return redirect(route('pelangan.rentals.index'));
        else
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

    public function bayar(Request $request, $id)
    {
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }
        $bayar = true;
        return view('rentals.show', compact(['bayar']))->with('rental', $rental);
    }
    public function pembayaran(Request $request, $id)
    {
        if (Auth::guard('pelanggan')->check()) {
            $request->validate([
                'bayar' => 'integer|min:1',
                'bukti' => 'required|image'
            ]);
            if ($request->hasFile('bukti')) {
                $imageName = time() . $request->file('bukti')->getClientOriginalName();
                Storage::disk('public')->put('rentals/bukti/' . $imageName, file_get_contents($request->file('bukti')->getRealPath()));
                $buktiPembayaran = $imageName;
            }
        } else
            $request->validate([
                'bayar' => 'integer|min:1'
            ]);

        // dd($request->all());
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }
        $detailPembayaran = new DetailPembayaranRental;
        $detailPembayaran->rental_id = $rental->id;
        $detailPembayaran->jumlah = $request->bayar;
        $detailPembayaran->kurang = $rental->grand_total - ($request->bayar + ($rental->detailPembayaran()->sum('jumlah') ?? 0));
        if (Auth::guard('pelanggan')->check())
            $detailPembayaran->bukti = $buktiPembayaran;
        else {
            $detailPembayaran->user_validasi_id = Auth::user()->id;
            if ($detailPembayaran->kurang <= 0) {
                $detailPembayaran->kurang = 0;
                $rental->status_pembayaran = 'lunas';
                $rental->save();
            }
        }
        $detailPembayaran->save();

        Flash::success('Rental bayar successfully.');

        if (Auth::guard('pelanggan')->check()) {
            return redirect(route('pelangan.rentals.index'));
        } else
            return redirect(route('rentals.index'));
    }

    public function validasi($id)
    {
        $rental = Rental::find($id);

        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('rentals.index'));
        }
        $bayar = true;
        $detailPembayaran = $rental->detailPembayaran()->whereNull('user_validasi_id')->first();
        $detailPembayaran->user_validasi_id = Auth::user()->id;
        $detailPembayaran->save();
        $totalBayar = $rental->detailPembayaran()->sum('jumlah');
        if ($totalBayar >= $rental->grand_total) {
            $rental->status_pembayaran = 'lunas';
            $rental->save();
        }
        Flash::success('Rental validasi successfully.');
        return redirect(route('rentals.index'));
    }
    public function status(Request $request)
    {
        $rental = Rental::find($request->id);
        if (empty($rental)) {
            return response([
                'status' => 'error',
                'message' => 'Rental not found'
            ], 404);
        }
        if ($request->status == 'selesai' && $rental->status_pembayaran != 'lunas') {
            return response([
                'status' => 'error',
                'message' => 'Rental Pembayaran belum lunas'
            ], 200);
        }
        $rental->status = $request->status;
        $rental->save();
        return response([
            'status' => 'success',
            'message' => 'Rental status updated successfully'
        ], 200);
    }

    public function ulasan(Request $request)
    {
        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string'
        ]);
        $rental = Rental::find($request->id);
        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('pelanggan.rentals.index'));
        }

        $ulasan = new Ulasan;
        $ulasan->rental_id = $rental->id;
        $ulasan->star = $request->star;
        $ulasan->ulasan = $request->ulasan;
        $ulasan->save();
        Flash::success('Rental ulasan successfully.');
        return redirect(route('pelangan.rentals.index'));
    }

    public function struk($id, Request $request)
    {
        $rental = Rental::find($request->id);
        if (empty($rental)) {
            Flash::error('Rental not found');

            return redirect(route('pelanggan.rentals.index'));
        }
        return view('rentals.struk', compact('rental'));
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

        // $rental->delete();
        $rental->status = 'batal';
        $rental->save();

        Flash::success('Rental canceled successfully.');

        return redirect(route('rentals.index'));
    }

    public function cekKetersediaanMobil(Request $request)
    {
        try {
            $mobilId = $request->mobil_id;
            $waktuMulai = $request->waktu_mulai ?? Carbon::now()->timestamp;
            $waktuSelesai = $request->waktu_selesai ?? Carbon::now()->timestamp;
            // dd(Rental::whereBetween('waktu_mulai', [$waktuMulai, $waktuSelesai])->orwhereBetween('waktu_selesai', [$waktuMulai, $waktuSelesai])->whereIn('status', ['pemesanan', 'berjalan'])->select('detail_mobil_id'));
            $mobil = DB::table('detail_mobils')->where('mobil_id', $mobilId)->whereNull('deleted_at')
                ->whereNotIn('id', function ($query) use ($waktuMulai, $waktuSelesai) {
                    $query->select('*')
                        ->from('rentals as rent')
                        ->whereBetween('waktu_mulai', [$waktuMulai, $waktuSelesai])->orwhereBetween('waktu_selesai', [$waktuMulai, $waktuSelesai])->whereIn('status', ['pemesanan', 'berjalan', 'terlambat'])->select('detail_mobil_id');
                })
                ->get();

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

            $sopir = Sopir::whereNull('deleted_at')->whereNotIn('id', function ($query) use ($waktuMulai, $waktuSelesai) {
                $query->select('*')
                    ->from('rentals')
                    ->whereBetween('waktu_mulai', [$waktuMulai, $waktuSelesai])->orwhereBetween('waktu_selesai', [$waktuMulai, $waktuSelesai])->whereIn('status', ['pemesanan', 'berjalan', 'terlambat'])->select('sopir_id');
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