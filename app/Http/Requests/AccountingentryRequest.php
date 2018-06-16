<?php

namespace SigeTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountingentryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'receipt' => 'required|integer',
            'accounttype' => 'required',
            'transactiontype' => 'required',
            'description' => 'required',
            'value' => 'required',
            'date' => 'required',
        ];
    }
}
