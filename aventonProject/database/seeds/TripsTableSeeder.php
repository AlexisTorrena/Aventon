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
            ['status' => 'Abierto', 'date' => '2018-07-04', 'trip_config_id' => '1' ],
            ['status' => 'Abierto', 'date' => '2018-07-05', 'trip_config_id' => '1' ]
            ]);
    }
}
