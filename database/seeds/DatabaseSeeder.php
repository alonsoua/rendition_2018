<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SostenedorsTableSeeder::class);
        $this->call(EstablecimientosTableSeeder::class);
        $this->call(SubvencionsTableSeeder::class);
        $this->call(LeysTableSeeder::class);
        $this->call(CuentasTableSeeder::class);
        $this->call(ProveedorsTableSeeder::class);
        $this->call(DocumentosTableSeeder::class);
        $this->call(FuncionsTableSeeder::class);
        $this->call(FuncionariosTableSeeder::class);
        $this->call(ImputacionsTableSeeder::class);
        $this->call(LiquidacionsTableSeeder::class);
        

    }
}
