<?php

namespace App\Http\Requests;


use App\Rules\UbicacionUnicaCreacion;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Latitud;
use App\Rules\Longitud;
use Illuminate\Validation\Rule;

class MarcadorCreateRequest extends FormRequest
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
            //
            'titulo_marcador' => 'required|max:255',
            'descripcion_marcador' => 'required|max:255',
            'longitud_marcador' => [
                'required', new Longitud,
                new UbicacionUnicaCreacion($this->get('latitud_marcador'), $this->get('longitud_marcador')),
            ],
            'latitud_marcador' => [
                'required', new Latitud,
                new UbicacionUnicaCreacion($this->get('latitud_marcador'), $this->get('longitud_marcador')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'titulo_marcador.required' => 'Debe Indicar un :attribute',
            'descripcion_marcador.required' => 'Debe Indicar una :attribute para el marcador',
            'latitud_marcador.required' => 'Debe indicar la :attribute del marcador',
            'longitud_marcador.required' => 'Debe indicar la :attribute del marcador',
        ];
    }

    public function attributes()
    {
        return [
            'titulo_marcador' => 'título',
            'descripcion_marcador' => 'descripción',
            'longitud_marcador' => 'longitud',
            'latitud_marcador' => 'latitud',
        ];
    }
}
