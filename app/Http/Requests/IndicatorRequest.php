<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class IndicatorRequest extends Request
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
            'achievement' => 'required|integer',
            'consecutive' => 'required|integer',
            'type01' => 'required|integer',
            'fortitude' => 'required',
            'type02' => 'required|integer',
            'recommendation' => 'required',
            'indicatorcategory' => 'required'
        ];
    }
}
