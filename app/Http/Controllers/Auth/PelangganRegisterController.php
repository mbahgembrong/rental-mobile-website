<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\CreatePelangganRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PelangganRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(CreatePelangganRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('ktp')) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        }
        if ($request->hasFile('foto')) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        }
        $input['password'] = bcrypt($input['password']);
        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');

        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::create($input);

        $this->guard()->login($pelanggan);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect('/pelanggan/home');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('pelanggan');
    }
    protected function validator(array $data)
    {
        $rules = new CreatePelangganRequest;
        return Validator::make($data, $rules->rules());
    }
}
