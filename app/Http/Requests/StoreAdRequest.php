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
            "body" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "body_2" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "body_3" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            "body.required"    => "El archivo de imagen de tamaño LG es requerido",
                "body.image"       => "El archivo no es una imagen",
                "body.mimes"       => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
                "body.max"         => "La imagen no debe superar los 2MB",
                "body_2.required"    => "El archivo de imagen de tamaño MD es requerido",
                "body_2.image"       => "El archivo no es una imagen",
                "body_2.mimes"       => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
                "body_2.max"         => "La imagen no debe superar los 2MB",
                "body_3.required"    => "El archivo de imagen de tamaño SM es requerido",
                "body_3.image"       => "El archivo no es una imagen",
                "body_3.mimes"       => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
                "body_3.max"         => "La imagen no debe superar los 2MB",
            "status.required"   => "El campo estatus es requerido",
            "orden.numeric"     => "El campo orden debe ser numerico",
            "start.required"    => "La fecha de inicio es requerida",
            "end.required"      => "La fecha de fin es requerida",
            "sections.required" => "Debe agregar a menos una sección donde se visualizará el anuncio",
        ];
    }
}
