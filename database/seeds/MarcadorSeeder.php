<?php

use App\Marcador;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MarcadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Marcador::class)->times(10)->create();

    }
}
