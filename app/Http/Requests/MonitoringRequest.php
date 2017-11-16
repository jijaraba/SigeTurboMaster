<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class MonitoringRequest extends Request
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
            'user' => 'required|integer',
            'rating' => 'required|numeric|min:0|max:5',
        ];
    }
}
