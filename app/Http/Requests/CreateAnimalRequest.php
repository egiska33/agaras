<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnimalRequest extends FormRequest
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
        if($this->method() == 'PUT') {
            $animal_id = 'required';
        } else {
            $animal_id = 'required|unique:animals';
        }

        return [
            'animal_id'         => $animal_id,
            'dob'               => 'required',
            'cob'               => 'required',
            'pog'               => 'required',
            'inclination'       => 'required|numeric',
            'real_weight'       => 'required|numeric',
            'includable_weight' => 'required',
            'price_kg'          => 'required_unless:inclination,0',
            'seller_name'       => 'required',
            'seller_address'    => 'required',
            'code'              => 'required|numeric',
            'breed'             => 'required'
        ];
    }

    public function messages()
    {
        return [
            'inclination.numeric' => 'Pasirinkite įmitimo kategoriją',
            'price_kg.required_unless' => 'Jeigu įmitimo kategorija nėra ,,Pagal skerdieną", privaloma įvesti kainą!',
            'animal_id.unique' => 'Toks gyvulys jau egzistuoja',
        ];
    }
}
