<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {

        $mobils = Mobil::paginate(30)
            ->appends(request()->query());
        // dd($mobils);
        return view('landing.car', compact(['mobils']));
    }
}