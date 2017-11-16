<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PermissionRequest extends Request
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
            'iduser' => 'required|integer',
            'date' => 'required',
            'entry' => 'required',
            'output' => 'required',
            'reason' => 'required',
        ];
    }
}
