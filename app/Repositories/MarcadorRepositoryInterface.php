<?php


namespace App\Repositories;

interface MarcadorRepositoryInterface
{

    public function all();

    public function create(array $marcadores);

    public function update(array $data, $idMarcador);

    public function delete($marcadorId);

    public function findById($marcadorId);

    public function findByName($marcadorName);

    public function marcadorLocation($marcadorId);

    public function marcadoresCercanos($marcadorId, $scope);

}