<?php

use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            ['status' => 'abierto', 'origin' => 'La Plata', 'destination' => 'Buenos Aires', 'date' => '2018-05-18 00:00:00', 'cost' => '120', 'periodicity' => 'Unica' ],
            ['status' => 'abierto', 'origin' => 'Buenos Aires', 'destination' => 'La Plata', 'date' => '2018-05-19 00:00:00', 'cost' => '120', 'periodicity' => 'Unica' ],
            ['status' => 'cerrado', 'origin' => 'Quilmes', 'destination' => 'La Plata', 'date' => '2018-05-20 00:00:00', 'cost' => '60', 'periodicity' => 'Unica' ]
        ]);
    }
}
