<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
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
        $validation = [
            'name'                  => 'required|max:255',
            'phone'                 => 'required|min:8',
            'position'              => 'required',
            'plate'                 => 'required|min:6|max:6|regex:/[a-zA-Z][a-zA-Z][a-zA-Z][0-9][0-9][0-9]/',
            'vat_invoice_serial'    => 'required',
            'vat_invoice_number'    => 'required|numeric',
            'invoice_serial'        => 'required',
            'invoice_number'        => 'required|numeric',
            'payout_check_serial'   => 'required',
            'payout_check_number'   => 'required|numeric',
            'sp_agreement_serial'   => 'required',
            'sp_agreement_number'   => 'required|numeric',
            'waybill_serial'        => 'required',
            'waybill_number'        => 'required|numeric',
        ];

        if ($this->method() == 'PUT') {
            $validation['email'] = 'required|email|max:255';
        } else {
            $validation['email'] = 'required|email|max:255|unique:users';
            $validation['password'] = 'required|min:6|confirmed';
        }

        return $validation;
    }
}
