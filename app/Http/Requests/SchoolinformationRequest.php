<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class SchoolinformationRequest extends Request
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
            'school' => 'required',
            'schoolinformation_user' => 'required|integer',
            'calendar' => 'required',
            'ubication' => 'required',
            'grade' => 'required|integer',
            'reason' => 'required|integer'
        ];
    }
}
