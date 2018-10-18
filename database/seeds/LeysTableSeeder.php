<?php

use Illuminate\Database\Seeder;

class LeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ley::class, 1)->create();
    }
}
