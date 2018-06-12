<?php

namespace SigeTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
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
            'bank' => 'required|integer',
            'voucher' => 'required|integer',
            'consecutive' => 'required|integer',
            'date' => 'required|date',
            'value' => 'required',
            'description' => 'required',
        ];
    }
}
