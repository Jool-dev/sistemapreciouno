<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Aqui se llama a los sender, para que se registres por defecto en la BD
        $this->call([
//            UbigeoSeeder::class,
//            IndependienteSeeder::class,
            logicabdSeeder::class
        ]);
    }
}
