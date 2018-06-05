<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PaymentRequest extends Request
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
            'method' => 'required',
            'type' => 'required',
            'package' => 'required|integer',
            'family' => 'required',
            'student' => 'required',
            'ispayment' => 'required',
            'approved' => 'required',
            'bank' => 'required',
            'concept1' => 'required',
            'date1' => 'required',
            'value1' => 'required',
            'observation1' => 'required',
            'concept2' => 'required',
            'date2' => 'required',
            'value2' => 'required',
            'observation2' => 'required',
            'concept3' => 'required',
            'date3' => 'required',
            'value3' => 'required',
            'observation3' => 'required',
            'concept4' => 'required',
            'date4' => 'required',
            'value4' => 'required',
            'observation4' => 'required',
        ];
    }
}