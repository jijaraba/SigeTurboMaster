<?php

namespace SigeTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentNewRequest extends FormRequest
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
            'student' => 'required|integer',
            'register' => 'required|date',
            'status' => 'required|integer',
            'statusdate' => 'date',
            'scholarship' => 'required|numeric',
            'reentry' => 'required|boolean',
            'inclusion' => 'required|boolean'
        ];
    }
}
