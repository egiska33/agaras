<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRouteRequest extends FormRequest
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
            'user_id'           => 'required|exists:users,id',
            'pick_up_time'      => 'required|date',
            'name'              => 'required',
            'seller_address'    => 'required',
            'phone'             => 'required',
            'total_animals'     => 'required|numeric',
            'comment'           => 'max:1000',
            'file'              => 'file|mimes:pdf|max:25600',
        ];
    }
}
