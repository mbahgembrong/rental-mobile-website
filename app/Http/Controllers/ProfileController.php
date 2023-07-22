<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePelangganRequest;
use Carbon\Carbon;

class ProfileController extends AppBaseController
{
    public function index(Request $request)
    {
        return view('profile.index');
    }

    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $input = $request->all();
        $pelanggan = Pelanggan::find(Auth::guard('pelanggan')->user()->id);
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $pelanggan->foto) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);


        $pelanggan->fill($input);
        $pelanggan->save();
        Flash::success('Pelanggan updated successfully.');
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect()->back();
        }

        return view('pelanggans.edit')->with('pelanggan', $pelanggan);
    }
    public function update($id, UpdatePelangganRequest $request)
    {
        /** @var Pelanggan $pelanggan */
        $pelanggan = Pelanggan::find($id);

        if (empty($pelanggan)) {
            Flash::error('Pelanggan not found');

            return redirect(route('pelanggans.index'));
        }
        $input = $request->all();
        if ($request->hasFile('ktp') && $request->file('ktp')->getClientOriginalName() != $pelanggan->ktp) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        } else
            unset($input['ktp']);
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $pelanggan->foto) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('pelanggans/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);

        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');
        if ($input['password'] == null)
            unset($input['password']);
        else
            $input['password'] = bcrypt($input['password']);

        $pelanggan->fill($input);
        $pelanggan->save();

        Flash::success('Pelanggan updated successfully.');

        return redirect(route('pelanggan.profile'));
    }

}