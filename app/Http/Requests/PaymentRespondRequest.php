<?php

namespace SigeTurbo\Http\Requests;

use SigeTurbo\Http\Requests\Request;

class PaymentRespondRequest extends Request
{

    protected $redirectRoute = 'payments_fails';

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        //return $this->getClientIp() == env('SERVER_CPV');
        return true;
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'transaccionConvenioId' => 'required',
            'transaccionId' => 'required',
            'uuid' => 'required',
            'aprobado' => 'required',
            'ref1' => 'required',
            'valor' => 'required',
        ];
    }
}
