<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class UserCreateRequest extends Request
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
            'iduser' => 'required|integer',
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'idcategory' => 'required|integer',
            'idstatus' => 'required|integer',
            'idtown' => 'required|integer',
            'address' => 'required',
            'idstratus' => 'required|integer',
            'phone' => 'required',
            'celular' => 'required|unique:users',
            'idethnicgroup' => 'required|integer',
            'idmaritalstatus' => 'required|integer',
            'idgender' => 'required|integer',
            'idreligion' => 'required|integer',
            'birth' => 'required|date',
            'email' => 'required|email|unique:users'
        ];
    }
}
