<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEditor extends FormRequest
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
            'editor.name'      => 'required|min:10|max:50',
            'editor.email'     => 'required|email',
            'editor.specialty' => 'required|min:5|max:30',
            'editor.semblance' => 'required|min:50|max:250',
            'editor.status'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'editor.name.required'         => 'El campo Nombre es requerido',
            'editor.name.min'              => 'El campo Nombre debe tener mínimo 10 caracteres.',
            'editor.name.max'              => 'El campo Nnombre debe tener máximo 50 caracteres.',
            'editor.email.required'        => 'El campo Correo electrónico es requerido',
            'editor.email.email'           => 'El campo Correo electrónico no es un correo valido',
            'editor.specialty.required'    => 'El campo Especialidad es requerido',
            'editor.specialty.min'         => 'El campo Especialidad debe tener mínimo 5 caracteres',
            'editor.specialty.max'         => 'El campo Especialidad debe tener máximo 30 caracteres',
            'editor.semblance.required'    => 'El campo Semblanza es requerido',
            'editor.semblance.min'         => 'El campo Semblanza debe tener mínimo 50 caracteres',
            'editor.semblance.max'         => 'El campo Semblanza debe tener máximo 250 caracteres',
            'editor.status.required'       => 'El campo Estado es requerido',
        ];
    }
}
