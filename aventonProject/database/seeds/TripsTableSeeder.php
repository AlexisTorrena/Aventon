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
            ['status' => 'abierto', 'origin' => 'La Plata', 'destination' => 'Buenos Aires', 'date' => '18/5/2018', 'cost' => '120', 'isPeriodic' => 'Si' ],
            ['status' => 'abierto', 'origin' => 'Buenos Aires', 'destination' => 'La Plata', 'date' => '19/5/2018', 'cost' => '120', 'isPeriodic' => 'Si' ],
            ['status' => 'completo', 'origin' => 'Quilmes', 'destination' => 'La Plata', 'date' => '20/5/2018', 'cost' => '60', 'isPeriodic' => 'no' ]
        ]);
    }
}
