<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class UpdatePelangganRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Pelanggan::$rules;
        $pelanggan = $this->pelanggan ?? Auth::guard('pelanggan')->user()->id;
        $rules['nik'] = 'required|digits:16|unique:pelanggans,nik,' . $pelanggan;
        $rules['hp'] = 'required|digits_between:10,15|numeric|unique:pelanggans,hp,' . $pelanggan;
        $rules['email'] = 'required|email|unique:pelanggans,email,' . $pelanggan;
        $rules['password'] = 'nullable|min:8';
        $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $rules['ktp'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        return $rules;
    }
}