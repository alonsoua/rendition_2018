<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobu\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create();

        Role::create([
        	'name' 		=> 'Admin',
        	'slug' 		=> 'admin',
        	'special'	=> 'all-access'
        ]);
    }
}
