<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PaymentMassiveRequest extends Request
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
            'concept' => 'required',
            'date1' => 'required',
            'date2' => 'required',
            'date3' => 'required',
            'date4' => 'required',
            'year' => 'required',
            'month' => 'required',
            'month_name' => 'required',
            'type' => 'required',
            'exclude' => 'required',
        ];
    }
}
