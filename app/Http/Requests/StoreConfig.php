<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfig extends FormRequest
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
            "iframe_revista"    => "required",
            "link_ig"           => "required|url",
            "link_fb"           => "required|url",
            "link_tw"           => "required|url",
            "link_tt"           => "required|url",
            "link_yt"           => "required|url",
            "contact_wts"       => "required|numeric",
        ];
    }

    public function messages(){
        return [
            "iframe_revista.required" => "El campo Iframe para la revista digital es requerido",
            "link_ig.required"      => "El campo URL para Instagram es requerido",
            "link_ig.url"           => "El campo URL para Instagram debe ser una URL valida",
            "link_fb.required"      => "El campo URL para Facebook es requerido",
            "link_fb.url"           => "El campo URL para Facebook debe ser una URL valida",
            "link_tw.required"      => "El campo URL para Twitter es requerido",
            "link_tw.url"           => "El campo URL para Twitter debe ser una URL vlaida",
            "link_tt.required"      => "El campo URL para Tiktok es requerido",
            "link_tt.url"           => "El campo URL para tiktok debe ser una URL valida",
            "link_yt.required"      => "El campo URL para Youtube es requerido",
            "link_yt.url"           => "El campo URL para Youtube debe ser una URL valida",
            "contact_wts.required"  => "El campo Contacto de WhatsApp es requrido",
            "contact_wts.numeric"       => "El campo Contacto de WhatApp debe ser numerico",
        ];
    }
}
