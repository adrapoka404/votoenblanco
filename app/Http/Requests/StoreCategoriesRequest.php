<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriesRequest extends FormRequest
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
            "nombre"      => "required",
            "orden"     => "required|numeric",
           // "imagen"    => "image",
            "visible"    => "required|in:0,1",
        ];
    }

    public function attributes()
    {
        return [
            'nombre'   => 'Nombre de categoría',
            'orden'  => 'Orden de visibilidad',
            //'imagen' => 'Imagen de la categoría',
            'visible' => 'Estado de la categoría'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'Debe escribir una nombre para la categoría',
            'orden.required'  => 'Debe asignar un orden de visualizacion a la categoría',
            //'imagen.image'  => 'Debe seleccionar una imagen descriptiva de la categoría',
            'visible.required' => 'Debe elegir un stauts para la categoría',
        ];
    }
}
