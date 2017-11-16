<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PreregistrationRequest extends Request
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
            'user' => 'required|integer',
            'firstname' => 'required',
            'lastname' => 'required',
            'identificationtype' => 'required',
            'identification' => 'required',
            'expedition' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'address' => 'required',
            'district' => 'required',
            'town' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'celular' => 'required',
        ];
    }
}
