<?php

use Illuminate\Database\Seeder;

class SubvencionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Subvencion::class, 1)->create();
    }
}
