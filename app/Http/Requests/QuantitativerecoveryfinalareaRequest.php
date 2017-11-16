<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class QuantitativerecoveryfinalareaRequest extends Request
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
        return [
            'idyear' => 'required|integer',
            'idprovenance' => 'required|integer',
            'idgroup' => 'required|integer',
            'idarea' => 'required|integer',
            'iduser' => 'required|integer',
            'act' => 'required|integer',
            'rating' => 'required|numeric|min:0|max:5',
            'recovery_at' => 'required|date',
        ];
    }
}
