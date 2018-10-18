<?php

use Illuminate\Database\Seeder;

class EstablecimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Establecimiento::class, 1)->create();
    }
}
