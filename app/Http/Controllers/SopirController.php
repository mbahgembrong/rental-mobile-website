<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSopirRequest;
use App\Http\Requests\UpdateSopirRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Sopir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Response;

class SopirController extends AppBaseController
{
    /**
     * Display a listing of the Sopir.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Sopir $sopirs */
        $sopirs = Sopir::orderBy('created_at', 'DESC')->get();

        return view('sopirs.index')
            ->with('sopirs', $sopirs);
    }

    /**
     * Show the form for creating a new Sopir.
     *
     * @return Response
     */
    public function create()
    {
        return view('sopirs.create');
    }

    /**
     * Store a newly created Sopir in storage.
     *
     * @param CreateSopirRequest $request
     *
     * @return Response
     */
    public function store(CreateSopirRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');
        if ($request->hasFile('ktp')) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        }
        if ($request->hasFile('sim')) {
            $imageName = time() . $request->file('sim')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/sim/' . $imageName, file_get_contents($request->file('sim')->getRealPath()));
            $input['sim'] = $imageName;
        }
        if ($request->hasFile('foto')) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        }
        /** @var Sopir $sopir */
        $sopir = Sopir::create($input);

        Flash::success('Sopir saved successfully.');

        return redirect(route('sopirs.index'));
    }

    /**
     * Display the specified Sopir.
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
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        return view('sopirs.show')->with('sopir', $sopir);
    }

    /**
     * Show the form for editing the specified Sopir.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        return view('sopirs.edit')->with('sopir', $sopir);
    }

    /**
     * Update the specified Sopir in storage.
     *
     * @param int $id
     * @param UpdateSopirRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSopirRequest $request)
    {
        /** @var Sopir $sopir */
        $sopir = Sopir::find($id);

        if (empty($sopir)) {
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }
        $input = $request->all();
        if ($request->hasFile('ktp') && $request->file('ktp')->getClientOriginalName() != $sopir->ktp) {
            $imageName = time() . $request->file('ktp')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/ktp/' . $imageName, file_get_contents($request->file('ktp')->getRealPath()));
            $input['ktp'] = $imageName;
        } else
            unset($input['ktp']);
        if ($request->hasFile('sim') && $request->file('sim')->getClientOriginalName() != $sopir->sim) {
            $imageName = time() . $request->file('sim')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/sim/' . $imageName, file_get_contents($request->file('sim')->getRealPath()));
            $input['sim'] = $imageName;
        } else
            unset($input['sim']);
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $sopir->foto) {
            $imageName = time() . $request->file('foto')->getClientOriginalName();
            Storage::disk('public')->put('sopirs/foto/' . $imageName, file_get_contents($request->file('foto')->getRealPath()));
            $input['foto'] = $imageName;
        } else
            unset($input['foto']);

        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');
        if ($input['password'] == null)
            unset($input['password']);
        else
            $input['password'] = bcrypt($input['password']);
        $sopir->fill($input);
        $sopir->save();

        Flash::success('Sopir updated successfully.');

        return redirect(route('sopirs.index'));
    }

    /**
     * Remove the specified Sopir from storage.
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
            Flash::error('Sopir not found');

            return redirect(route('sopirs.index'));
        }

        $sopir->delete();

        Flash::success('Sopir deleted successfully.');

        return redirect(route('sopirs.index'));
    }
}
