<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class HealthinformationRequest extends Request
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
            'idbloodtype' => 'required|integer',
            'idprepaidmedical' => 'required|integer',
            'idmedicalinsurance' => 'required|integer',
            'emergency_contact' => 'required',
            'emergency_phone' => 'required',
            'medical_treatment' => 'required',
            'insurance' => 'required',
            'vaccination_card' => 'required'
        ];
    }
}