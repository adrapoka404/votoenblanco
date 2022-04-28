<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusPostRequest extends FormRequest
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
            "name"          => "required",
            "description"   => "required",
            "status"         => "required",
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Nombre de estatus',
            'description'   => 'Descripción de estatus',
            'status'        => 'Estado del estatus'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Debe escribir una nombre para el estatus del post',
            'description.required'  => 'Debe escribir una descripción para el estatus del post',
            'status.required'       => 'Debe elegir un stauts para el estatus del post',
        ];
    }
}
