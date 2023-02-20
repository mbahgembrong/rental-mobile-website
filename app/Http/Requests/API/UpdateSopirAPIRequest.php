<?php

namespace App\Http\Requests\API;

use App\Models\Sopir;
use InfyOm\Generator\Request\APIRequest;

class UpdateSopirAPIRequest extends APIRequest
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
        
        return $rules;
    }
}
