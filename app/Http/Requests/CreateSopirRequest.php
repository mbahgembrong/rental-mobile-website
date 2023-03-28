<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sopir;

class CreateSopirRequest extends FormRequest
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
        $rules['nik'] = 'required|unique:sopirs,nik';
        $rules['nomor_sim'] = 'required|unique:sopirs,nomor_sim';
        $rules['email'] = 'required|unique:sopirs,email';
        $rules['password'] = 'required|min:8';
        return $rules;
    }
}