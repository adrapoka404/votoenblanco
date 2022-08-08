<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'             => 'required|min:15|max:250',
            'body'              => 'required|min:100',
            'description'       => 'required|min:120|max:160',
            'tags'              => 'required',
            'keywords'          => 'required',
            'categories'        => 'required|array',
            'social_text'       => 'requiredif:redfb,on|requiredif:redtw,on',
            'date'              => 'requiredif:post_now,null&after_or_equal:yesterday',
            'time'              => 'requiredif:post_now,null&requiredunless:date,null',
            'image_principal'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'title'         => 'Encabezado de nota',
            'body'          => 'Cuerpo de la nota',
            'description'   => 'Meta descripción',
            'tags'          => 'Capo de Tags',
            'keywords'      => 'Capo de keywords',
            'categories'    => 'Categoría de la nota',
            'social_text'   => 'Texto para redes sociales',
            'date'          => 'Fecha de posteo',
            'time'          => 'Hora de posteo',
            'image_principal' => 'Imagen principal',
        ];
    }

    public function messages()
    {
        return [
            'title.required'         => 'El encabezado de la nota es un campo obligatorio',
            'title.min'       => 'El encabezado debe tener al menos 15 caracteres',
            'title.max' => 'El encabezado debe tener máximo 250 caracteres',
            'body.required'=> 'El cuerpo de la nota es obligatorio',
            'body.min' => 'El cuerpo de la nota debe tener al menos cien caracteres',
            'description.required' => 'El campo de meta descripción es obligatorio',
            'description.min' => 'El campo de meta descripción debe tener minimo 120 caracteres',
            'description.max' => 'El campo de meta descripción debe tener máximo 160 caracteres',
            'tags.required' => 'Debe agregar al menos una TAG para el SEO',
            'keywords.required' => 'Debe agregar al menos una KEYWORD para el SEO',
            'categories.required'    => 'Debe elegir al menos una categoría para la nota',
            'social_text.requiredif'   => 'El texto para redes sociales es obligatorio si selecciona publicar en alguna de las redes',
            'date.requiredunless'  => 'El campo de fecha es obligatirio si requiere programar la publicacion de la nota',
            'date.date'  => 'El campo de fecha debe tener el formato dd/mm/aaaa',
            'date.after_or_equal'  => 'El campo de fecha debe ser mayor a la fecha actual',
            'time.requiredunless'  => 'El campo hora es obligatorio si requiere programar la publicacion de la nota',
            'image_principal.required' => 'Es necesario agregar una imagen principal al post',
        ];
    }
}
