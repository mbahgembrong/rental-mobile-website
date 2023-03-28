<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pelanggan;

class CreatePelangganRequest extends FormRequest
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
        $rules['nik'] = 'required|digits:16|unique:pelanggans,nik';
        $rules['hp'] = 'required|digits_between:10,15|numeric|unique:pelanggans,hp';
        $rules['email'] = 'required|email|unique:pelanggans,email';
        $rules['password'] = 'required|min:8';
        $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $rules['ktp'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        return $rules;
    }
}
