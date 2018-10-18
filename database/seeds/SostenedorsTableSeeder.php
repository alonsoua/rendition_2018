<?php

use Illuminate\Database\Seeder;

class SostenedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Sostenedor::class, 5)->create();
    }
}
