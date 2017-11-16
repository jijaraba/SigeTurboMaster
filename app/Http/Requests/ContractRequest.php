<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class ContractRequest extends Request
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
            'idperiod' => 'required|integer',
            'idgroup' => 'required|integer',
            'idsubject' => 'required|integer',
            'idnivel' => 'required|integer',
            'iduser' => 'required|integer',
            'timeintensity' => 'required|integer',
        ];
    }
}
