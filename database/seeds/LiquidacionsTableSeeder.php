<?php

use Illuminate\Database\Seeder;

class LiquidacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Liquidacion::class, 1)->create();
    }
}
