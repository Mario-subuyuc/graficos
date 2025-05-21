<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Venta;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'codigo'=> '1000',
            'name' => 'Josue Hernandez',
            'email' => 'josue@gmail.com',
            'password' => Hash::make(value: '12345678')
        ]);
        User::create([
            'codigo'=> '1001',
            'name' => 'Gabriel Garcia',
            'email' => 'gabriel@gmail.com',
            'password' => Hash::make(value: '12345678')
        ]);
        User::create([
            'codigo'=> '1002',
            'name' => 'Sergio Bay',
            'email' => 'sergio@gmail.com',
            'password' => Hash::make(value: '12345678')
        ]);
        User::create([
            'codigo'=> '1003',
            'name' => 'Mario Subuyuc',
            'email' => 'mariosubuyucfb@gmail.com',
            'password' => Hash::make(value: '12345678')
        ]);


        Venta::create([
            'user_id' => 1,
            'fecha' => '2024-01-01',
            'total' => 4500.75,
            'articulo' => 'Articulo1',
            'cantidad' => 50,
            'metodo_pago' => 'Efectivo',
            'cliente' => 'Cliente1'
        ]);
        
        Venta::create([
            'user_id' => 2,
            'fecha' => '2024-02-03',
            'total' => 3600.40,
            'articulo' => 'Articulo2',
            'cantidad' => 33,
            'metodo_pago' => 'Tarjeta',
            'cliente' => 'Cliente2'
        ]);
        
        Venta::create([
            'user_id' => 3,
            'fecha' => '2024-03-05',
            'total' => 5000.90,
            'articulo' => 'Articulo3',
            'cantidad' => 70,
            'metodo_pago' => 'Transferencia',
            'cliente' => 'Cliente3'
        ]);
        
        Venta::create([
            'user_id' => 4,
            'fecha' => '2024-04-07',
            'total' => 3700.20,
            'articulo' => 'Articulo4',
            'cantidad' => 15,
            'metodo_pago' => 'Otro',
            'cliente' => 'Cliente4'
        ]);
        
        Venta::create([
            'user_id' => 1,
            'fecha' => '2024-05-10',
            'total' => 4200.55,
            'articulo' => 'Articulo5',
            'cantidad' => 15,
            'metodo_pago' => 'Efectivo',
            'cliente' => 'Cliente1'
        ]);
        
        Venta::create([
            'user_id' => 2,
            'fecha' => '2024-06-12',
            'total' => 5400.80,
            'articulo' => 'Articulo2',
            'cantidad' => 68,
            'metodo_pago' => 'Tarjeta',
            'cliente' => 'Cliente2'
        ]);
        
        Venta::create([
            'user_id' => 3,
            'fecha' => '2024-07-14',
            'total' => 6300.60,
            'articulo' => 'Articulo3',
            'cantidad' => 20,
            'metodo_pago' => 'Transferencia',
            'cliente' => 'Cliente3'
        ]);
        
        Venta::create([
            'user_id' => 4,
            'fecha' => '2024-08-16',
            'total' => 5800.99,
            'articulo' => 'Articulo4',
            'cantidad' => 42,
            'metodo_pago' => 'Otro',
            'cliente' => 'Cliente4'
        ]);
        
        Venta::create([
            'user_id' => 1,
            'fecha' => '2024-09-18',
            'total' => 3900.25,
            'articulo' => 'Articulo1',
            'cantidad' => 22,
            'metodo_pago' => 'Efectivo',
            'cliente' => 'Cliente1'
        ]);
        
        Venta::create([
            'user_id' => 2,
            'fecha' => '2024-10-20',
            'total' => 4600.10,
            'articulo' => 'Articulo5',
            'cantidad' => 33,
            'metodo_pago' => 'Tarjeta',
            'cliente' => 'Cliente2'
        ]);
        
        Venta::create([
            'user_id' => 3,
            'fecha' => '2024-11-22',
            'total' => 7100.80,
            'articulo' => 'Articulo2',
            'cantidad' => 50,
            'metodo_pago' => 'Transferencia',
            'cliente' => 'Cliente3'
        ]);
        
        Venta::create([
            'user_id' => 4,
            'fecha' => '2024-12-25',
            'total' => 8200.75,
            'articulo' => 'Articulo3',
            'cantidad' => 15,
            'metodo_pago' => 'Otro',
            'cliente' => 'Cliente4'
        ]);
        //ventas de 2025
        Venta::create([
            'user_id' => 1,
            'fecha' => '2025-01-28',
            'total' => 6500.65,
            'articulo' => 'Articulo4',
            'cantidad' => 10,
            'metodo_pago' => 'Otro',
            'cliente' => 'Otro'
        ]);
        
        Venta::create([
            'user_id' => 2,
            'fecha' => '2025-02-14',
            'total' => 6000.65,
            'articulo' => 'Articulo5',
            'cantidad' => 12,
            'metodo_pago' => 'Efectivo',
            'cliente' => 'Cliente1'
        ]);

        Venta::create([
            'user_id' => 3,
            'fecha' => '2025-03-20',
            'total' => 5700.65,
            'articulo' => 'Articulo2',
            'cantidad' => 15,
            'metodo_pago' => 'Tarjeta',
            'cliente' => 'Cliente3'
        ]);
    }
}
