<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Home;
use App\Models\Appliance;
use App\Models\Lighting;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario demo
        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'demo@energysmart.com',
            'password' => bcrypt('password'), // contraseña: "password"
        ]);
        
        // Crear hogar demo
        $home = $user->homes()->create([
            'name' => 'Mi Hogar',
            'address' => 'Calle Falsa 123',
            'city' => 'Ciudad Ejemplo',
            'state' => 'Estado',
            'zip_code' => '12345',
            'connection_type' => 'residencial',
            'occupants' => 4,
            'area' => 120,
            'energy_tariff' => 0.85, // $0.85 por kWh
        ]);
        
        // Electrodomésticos de ejemplo
        $home->appliances()->createMany([
            [
                'name' => 'Refrigerador',
                'category' => 'refrigeracion',
                'power' => 150,
                'hours_use' => 24,
                'energy_efficiency' => 'A+'
            ],
            [
                'name' => 'Televisor LED',
                'category' => 'entretenimiento',
                'power' => 100,
                'hours_use' => 5,
                'quantity' => 2
            ],
            [
                'name' => 'Lavadora',
                'category' => 'lavado',
                'power' => 500,
                'hours_use' => 0.5,
                'quantity' => 1
            ]
        ]);
        
        // Iluminación de ejemplo
        $home->lightings()->create([
            'type' => 'LED',
            'power' => 9,
            'quantity' => 10,
            'hours_use' => 6
        ]);
        
        $this->command->info('Datos demo creados exitosamente!');
        $this->command->info('Usuario: demo@energysmart.com');
        $this->command->info('Contraseña: password');
    }
}