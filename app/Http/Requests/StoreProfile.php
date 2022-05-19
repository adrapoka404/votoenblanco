<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfile extends FormRequest
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
            "profile.position"      => "required",
            "profile.signature"     => "required",
            "profile.email"         => "required|email",
            "profile.profession"    => "required",
            "profile.speciality"    => "required",
            "profile.semblance"     => "required|min:250|max:500",
            "profile.birthday"      => "nullable||date",
            "profile.mobile"        => "required|digits:10",
            "profile.fb"            => "nullable|url",
            "profile.tw"            => "nullable|url",
            "profile.yt"            => "nullable|url",
            "profile.tt"            => "nullable|url",
            "profile.personal"      => "nullable|url",
            "profile.photo"         => "nullable|mimes:jpg,bmp,png",
            "profile.cover"         => "nullable|mimes:jpg,bmp,png",
           
        ];
    }

    public function attributes()
    {
        return [
            "profile.position"      => "Cargo",
            "profile.signature"     => "Alias/firma",
            "profile.email"         => "Correo electrónico",
            "profile.profession"    => "Profesión",
            "profile.speciality"    => "Especialidad",
            "profile.semblance"     => "Semblanza",
            "profile.birthday"      => "Cumpleaños",
            "profile.mobile"        => "Teléfono",
            "profile.fb"            => "Facebook",
            "profile.tw"            => "Twitter",
            "profile.yt"            => "YouTube",
            "profile.tt"            => "TikTok",
            "profile.personal"      => "Página Peronal",
            "profile.photo"         => "Foto de pérfil",
            "profile.cover"         => "Foto de portada",
        ];
    }

    public function messages()
    {
        return [
            "profile.position.required"     => "El campo de Cargo es obligatorio",
            "profile.signature.required"    => "El campo de Alias/Firma es obligatorio",
            "profile.email.required"        => "El Correo electrónico es obligatorio",
            "profile.email.email"           => "El Correo electrónico debe ser un correo con formato valido",
            "profile.profession"            => "Debes ingresar la profesión",
            "profile.speciality"            => "Debes especificar la especialidad",
            "profile.semblance.required"    => "El campo de Semblanza es obligatorio",
            "profile.semblance.min"         => "El campo de Semblanza de be contener mínimo 250 caracteres.",
            "profile.semblance.max"         => "El campo de Semblanza debe contener máximo 500 caracteres",
            "profile.birthday.date"         => "El campo de cumpleaños debe ser en formato de fecha (dd/mm/aaaa)",
            "profile.mobile.digits"         => "El campo de teléfono debe ser en a 10 digitos",
            "profile.fb.url"                => "El link para Facebook debe ser una URL valida",
            "profile.tw.url"                => "El link para Twitter debe ser una URL valida",
            "profile.yt.url"                => "El link para YouTube debe ser una URL valida",
            "profile.tt.url"                => "El link para TikTok debe ser una URL valida",
            "profile.personal.url"          => "El link para la URL personal debe ser una URL valida",
            "profile.photo.mimes"           => "La foto de pérfil debe ser una iamgen valida con alguna de las siguientes extensiones (jpg,bmp,png)",
            "profile.cover.mimes"           => "La portada debe ser una iamgen valida con alguna de las siguientes extensiones (jpg,bmp,png)",
        ];
    }

}
