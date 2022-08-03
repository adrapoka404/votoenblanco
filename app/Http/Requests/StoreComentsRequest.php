<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComentsRequest extends FormRequest
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
            "coment.name"       => "required|min:5|max:25",
            "coment.email"      => "required|email",
            "coment.comment"    => "required|min:20|max:250",
        ];
    }

    public function attributes()
    {
        return [
            "coment.name"       => "Nombre",
            "coment.email"      => "Correo Electrónico",
            "coment.comment"    => "Comentario",
        ];
    }

    public function messages()
    {
        return [
            "coment.name.required"      => "El campo de nombre es requerido",
            "coment.name.min"           => "El campo nombre debe tener mínimo 5 caracteres",
            "coment.name.max"           => "El campo nombre debe tener máximo 25 caracteres",
            "coment.email.required"     => "El campo de correo electrónico es requerido",
            "coment.email.email"        => "El campo de correo electrónico no tiene un formato valido",
            "coment.comment.required"   => "El campo de comentario es requerido",
            "coment.comment.min"        => "El campo de comentario debe tener mínimo 20 caracteres",
            "coment.comment.max"        => "El campo de comentario debe tener máximo 250 caracteres",
        ];
    }
}
