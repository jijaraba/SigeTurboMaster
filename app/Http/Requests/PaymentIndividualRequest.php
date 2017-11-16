<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PaymentIndividualRequest extends Request
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
            'student' => 'required|integer',
            'concept' => 'required',
            'date1' => 'required',
            'value1' => 'required',
            'date2' => 'required',
            'value2' => 'required',
            'date3' => 'required',
            'value3' => 'required',
            'year' => 'required',
            'month' => 'required',
            'month_name' => 'required',
            'gender' => 'required',
            'scholarship' => 'required',
            'type' => 'required',
        ];
    }
}
