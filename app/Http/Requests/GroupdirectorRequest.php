<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class GroupdirectorRequest extends Request
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
            'idgroup' => 'required|integer',
            'iduser' => 'required|integer',
        ];
    }
}
