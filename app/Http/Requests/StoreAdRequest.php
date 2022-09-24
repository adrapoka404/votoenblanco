<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required",
            "body" => "required",
            "status" => "required",
            "orden" => "nullable|numeric",
            "start" => "required",
            "end" => "required",
            "sections" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required"     => "El campo Nombre es requerido",
            "body.required"     => "El campo Cuerpo es requerido",
            "status.required"   => "El campo estatus es requerido",
            "orden.numeric"     => "El campo orden debe ser numerico",
            "start.required"    => "La fecha de inicio es requerida",
            "end.required"      => "La fecha de fin es requerida",
            "sections.required" => "Debe agregar a menos una sección donde se visualizará el anuncio",
        ];
    }
}
