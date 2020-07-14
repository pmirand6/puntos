<?php

namespace App\Rules;

use App\Marcador;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UbicacionUnicaUpdate implements Rule
{
    private $idMarcador;
    private $lon;
    private $lat;

    /**
     * Create a new rule instance.
     *
     * @param $lat
     * @param $lon
     * @param $idMarcador
     */
    public function __construct($lat, $lon, $idMarcador)
    {
        $this->idMarcador = $idMarcador;
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
        $array = [
            ['latitud_marcador', $this->lat],
            ['longitud_marcador', $this->lon],
            ['id', '<>', $this->idMarcador]
        ];
        return DB::table('marcadores')->where($array)->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe un marcador con las coordenadas: '.$this->lat.', '.$this->lon.','.$this->idMarcador;
    }
}
