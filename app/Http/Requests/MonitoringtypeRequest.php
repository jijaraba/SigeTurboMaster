<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class MonitoringtypeRequest extends Request
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
            'year' => 'required|integer',
            'period' => 'required|integer',
            'group' => 'required|integer',
            'subject' => 'required|integer',
            'nivel' => 'required|integer',
            'monitoringcategory' => 'required|integer',
            'date' => 'required|date',
            'name' => 'required',
            'name' => 'required',
        ];
    }
}
