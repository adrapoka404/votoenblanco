<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVidegaleria extends FormRequest
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
            'name'          => 'required|min:10|max:50',
            'url'           => 'required|url',
            'description'   => 'nullable|min:100|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'El campo nombre es requerido',
            'name.min'          => 'El campo nombre debe tener mínimo 10 caracteres',
            'name.max'          => 'El campo nombre debe tener máximo 50 caracteres',
            'url.required'      => 'El campo URL es requerido',
            'url.url'           => 'El campo URL debe ser una URL Valida',
            'description.min'   => 'El campo iframe debe tener mínimo 100 caracteres',
            'description.max'   => 'El campo iframe debe tener máximo 500 caracteres',
        ];
    }
}
