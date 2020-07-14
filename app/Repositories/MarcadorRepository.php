<?php

namespace App\Repositories;

use App\Marcador;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

/**
 * Class MarcadorRepository
 * @package App\Repositories
 */
class MarcadorRepository implements MarcadorRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * MarcadorRepository constructor.
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }


    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return Marcador[]|\Illuminate\Database\Eloquent\Collection
     * Listado de Marcadores
     */
    public function all()
    {
        return Marcador::all();
    }

    /**
     * @param  array  $marcadores
     * @return int
     * Creación de Marcadores
     */
    public function create(array $marcadores)
    {
        return Marcador::create($marcadores)->id;
    }

    /**
     * @param  array  $data
     * @param $marcadorId
     * Actualización de Marcador
     */
    public function update(array $data, $marcadorId)
    {
        Marcador::where('id', $marcadorId)->update($data);
    }

    /**
     * @param $marcadorId
     * @return void
     * Eliminar Marcador
     */
    public function delete($marcadorId)
    {
        Marcador::destroy($marcadorId);
    }

    /**
     * @param $marcadorId
     * @return Collection
     * Búsqueda de Marcador
     */
    public function findById($marcadorId)
    {
        return Marcador::findOrFail($marcadorId);
    }

    /**
     * @param $marcadorName
     * @return mixed
     * Obtener Marcador por Nombre
     */
    public function findByName($marcadorName)
    {
        return Marcador::where('titulo_marcador', $marcadorName)->get();
    }

    /**
     * @param $marcadorId
     * @return mixed
     * Obtiene la ubicación del Marcador
     * Retorna la latitud y longitud
     */
    public function marcadorLocation($marcadorId)
    {
        return Marcador::findOrFail($marcadorId, ['latitud_marcador', 'longitud_marcador']);
    }


    /**
     * @param $marcadorId
     * @param $scope
     * @return mixed
     * Se buscan los marcadores cercanos
     * Se filtrarán los resultados por el parametro del scope
     * Se llama al stored procedure SP_MARCADORES_CERCANOS(marcadorId, scope)
     * Se establece el scope por defecto en 5 para envitar error en la consulta
     *
     */
    public function marcadoresCercanos($marcadorId, $scope = 5)
    {
        return DB::select('CALL SP_MARCADORES_CERCANOS(?, ?)', array($marcadorId, $scope));
    }
}