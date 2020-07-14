<?php

namespace Tests\Unit;

use App\Marcador;
use Tests\TestCase;

class MarcadorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    private $marcador;

    public function setUp(): void
    {
        parent::setUp();
        $this->marcador = factory(Marcador::class)->create();
    }


    public function test_marcador_fue_borrado()
    {
        $response = $this->delete('api/marcadores/delete/'.$this->marcador->id);
        $response->assertStatus(200);
    }

    public function test_marcador_ubicacion()
    {
        $response = $this->get('api/marcadores/showlocation/'.$this->marcador->id);
        $res_array = json_decode($response->content(), true);
        $this->assertArrayHasKey('latitud_marcador', $res_array);
        $this->assertArrayHasKey('longitud_marcador', $res_array);
        $response->assertStatus(200);
    }

    public function test_marcador_creacion()
    {
        $response = $this->post('api/marcadores/create/', [
            'nombre_marcador' => $this->marcador->titulo_marcador,
            'descripcion_marcador' => $this->marcador->descripcion_marcador,
            'latitud_marcador' => $this->marcador->latitud_marcador,
            'longitud_marcador' => $this->marcador->longitud_marcador
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_marcador_update_ubicacion()
    {
        $response = $this->post('api/marcadores/update/1', [
            'titulo_marcador' => 'nombre falso1',
            'descripcion_marcador' => 'descripcions',
            'latitud_marcador' => '-34.474205',
            'longitud_marcador' => '-58.646495',
            'id' => '1'
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_marcadores_cercanos()
    {
        $response = $this->get('api/marcadores/near/1/scope/10');
        $res_array = json_decode($response->content(), true);
        $this->assertArrayHasKey('distance', $res_array[0]);
        $response->assertStatus(200);
    }


}
