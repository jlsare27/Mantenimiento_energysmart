<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Llamar a los seeders en el orden correcto
        $this->call([
            DemoDataSeeder::class,
            // Puedes agregar más seeders aquí si los creas después
        ]);
    }
}