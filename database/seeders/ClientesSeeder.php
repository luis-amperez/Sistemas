<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            ['nombre' => 'Cliente 1', 'correo' => 'cliente1@example.com'],
            ['nombre' => 'Cliente 2', 'correo' => 'cliente2@example.com'],
            ['nombre' => 'Cliente 3', 'correo' => 'cliente3@example.com'],
            
        ]);
    }
}

