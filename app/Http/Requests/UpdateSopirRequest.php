<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sopir;

class UpdateSopirRequest extends FormRequest
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
        $rules = Sopir::$rules;
        $rules['nik'] = 'required|digits:16|unique:sopirs,nik,' . $this->sopir;
        $rules['nomor_sim'] = 'required|digits:12|unique:sopirs,nomor_sim,' . $this->sopir;
        $rules['hp'] = 'required|digits_between:10,15|numeric|unique:sopirs,hp,' . $this->sopir;
        $rules['email'] = 'required|email|unique:sopirs,email,' . $this->sopir;
        $rules['password'] = 'nullable|min:8';
        $rules['foto'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $rules['ktp'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        return $rules;
    }
}