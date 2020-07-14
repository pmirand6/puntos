<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Marcador;

class UbicacionUnicaCreacion implements Rule
{
    private $lon;
    private $lat;

    /**
     * Create a new rule instance.
     *
     * @param $lat
     * @param $lon
     */
    public function __construct($lat, $lon)
    {
        //
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $array = ['latitud_marcador' => $this->lat, 'longitud_marcador' => $this->lon];
        return Marcador::where($array)->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe un marcador con las coordenadas: '.$this->lat.', '.$this->lon;
    }
}
