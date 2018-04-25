<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSellerRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT':
                return [
                    'name'                  => 'required',
                    'address'               => 'required',
                    'pick_up_address'       => 'required',
                    'seller_representative' => 'required',
                    'phone'                 => 'required|digits:7'
                ];
                break;
            
            default:
                return [
                    'name'                  => 'required',
                    'code'                  => 'required|numeric|unique:sellers',
                    'address'               => 'required',
                    'pick_up_address'       => 'required',
                    'phone'                 => 'required|digits:7'
                ];
                break;
        }
    }
}
