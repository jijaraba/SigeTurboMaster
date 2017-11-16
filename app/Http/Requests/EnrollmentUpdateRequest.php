<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class EnrollmentUpdateRequest extends Request
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
            'group' => 'required|integer',
            'register' => 'required|date',
            'status' => 'required|integer',
            'statusdate' => 'date',
            'scholarship' => 'required|numeric',
            'reentry' => 'required|boolean',
            'inclusion' => 'required|boolean'
        ];
    }
}
