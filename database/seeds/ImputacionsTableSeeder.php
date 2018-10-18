<?php

use Illuminate\Database\Seeder;

class ImputacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Imputacion::class, 1)->create();
    }
}
