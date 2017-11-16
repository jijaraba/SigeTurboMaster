<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class ProviderRequest extends Request
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
            'nit' => 'required',
            'name' => 'required',
            'leadtime' => 'required',
            'paymentform' => 'required',
            'evaluation' => 'required',
            'warranty' => 'required',
            'date' => 'required'
        ];
    }
}
