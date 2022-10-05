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
            "name"              => "required",
            "status"            => "required",
            "orden"             => "nullable|numeric",
            "start"             => "required",
            "end"               => "required",
            "add.local"         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "add.lateral"       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "add.category"      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "add.potbody"       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "add.postlateral"   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            "name.required"             => "El campo Nombre es requerido",
            "add.local.image"           => "El archivo no es una imagen",
            "add.local.mimes"           => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
            "add.local.max"             => "La imagen no debe superar los 2MB",
            "add.lateral.image"         => "El archivo no es una imagen",
            "add.lateral.mimes"         => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
            "add.lateral.max"           => "La imagen no debe superar los 2MB",
            "add.category.image"        => "El archivo no es una imagen",
            "add.category.mimes"        => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
            "add.category.max"          => "La imagen no debe superar los 2MB",
            "add.postbody.image"        => "El archivo no es una imagen",
            "add.postbody.mimes"        => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
            "add.postbody.max"          => "La imagen no debe superar los 2MB",
            "add.postlateral.image"     => "El archivo no es una imagen",
            "add.postlateral.mimes"     => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
            "add.postlateral.max"       => "La imagen no debe superar los 2MB",
            "status.required"           => "El campo estatus es requerido",
            "orden.numeric"             => "El campo orden debe ser numerico",
            "start.required"            => "La fecha de inicio es requerida",
            "end.required"              => "La fecha de fin es requerida",
        ];
    }
}
