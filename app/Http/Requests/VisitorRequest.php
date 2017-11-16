<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class VisitorRequest extends Request
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
            'type' => 'required|integer',
            'identificationtype' => 'required|integer',
            'identification' => 'required',
            'name' => 'required',
            'code' => 'required',
            'accesstype' => 'required',
            'date' => 'required',
            'time' => 'required',
            'destination' => 'required',
        ];
    }
}
