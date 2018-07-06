<?php

use Illuminate\Database\Seeder;

class TripConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_configurations')->insert([
            ['origin' => 'La Plata', 'destination' => 'Buenos Aires', 'startTime' => '13:30:00','startDate' => '2018-07-04','endDate' => '2018-07-05', 'cost' => '120','duration' => '45', 'periodicity' => 'Diaria', 'id' => '1' ],
            ['origin' => 'Buenos Aires', 'destination' => 'La Plata', 'startTime' => '11:30:00','startDate' => '2018-08-18','endDate' => '2018-08-19', 'cost' => '120','duration' => '45', 'periodicity' => 'Diaria', 'id' => '2' ]
            ]);
    }
}
