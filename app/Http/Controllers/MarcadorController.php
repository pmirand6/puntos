<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcadorCreateRequest;
use App\Http\Requests\MarcadorUpdateRequest;
use App\Marcador;
use App\Repositories\MarcadorRepository;
use Illuminate\Http\Request;

class MarcadorController extends Controller
{
    /** @var MarcadorRepository */
    private $marcador;

    /** Se inyecta por dependencia el Modelo Marcador
     * @param  Marcador  $marcador
     */
    public function __construct(Marcador $marcador)
    {
        $this->marcador = new MarcadorRepository($marcador);
    }

    /**
     * Muestra todos los marcadores
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->marcador->all(), 200);
    }

    /**
     * Creación de Marcador
     *
     * @param  MarcadorCreateRequest  $request
     * @param  Request  $request
     * @return mixed
     */
    public function crearMarcador(MarcadorCreateRequest $request)
    {
        $idMarcador = $this->marcador->create($request->except('_token'));
        return $this->marcador->findById($idMarcador);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Se obtienen los datos del Marcador por el nombre
     *
     */

    public function show(Request $request)
    {
        return response()->json($this->marcador->findByName($request->name), 200);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Se obtiene la ubicación del nombre
     */
    public function marcadorLocation(Request $request)
    {
        return response()->json($this->marcador->marcadorLocation($request->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marcador  $marcador
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $marcador = $this->marcador->findById($request->id);
        return view('paginas.modificarMarcador')->with('marcador', $marcador);
    }

    /**
     * Se Actualiza la ubicación del Marcador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $idMarcador
     * @return \phpDocumentor\Reflection\Types\Collection
     */
    public function updateUbicacion(MarcadorUpdateRequest $request, $idMarcador)
    {
        $this->marcador->update($request->except('_token'), $idMarcador);
        return $this->marcador->findById($idMarcador);
    }

    /**
     * Elimina el marcador
     *
     * @param  \App\Marcador  $marcador
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMarcador)
    {
        $this->marcador->delete($idMarcador);
    }

    /**
     * @param $idMarcador
     * @param  int  $scope
     * @return \Illuminate\Http\JsonResponse
     */
    public function marcadoresCercanos($idMarcador, $scope = 5)
    {
        return response()->json($this->marcador->marcadoresCercanos($idMarcador, $scope), 200);
    }

    public function vistaMarcadoresCercanos(Request $request)
    {
        return view('paginas.near')->with('marcador', $this->marcador->findById($request->id));
    }
}
