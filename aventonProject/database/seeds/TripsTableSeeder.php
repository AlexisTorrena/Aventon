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
            ['status' => 'abierto', 'date' => '2018-07-18', 'trip_config_id' => '1' ],
            ['status' => 'abierto', 'date' => '2018-07-19', 'trip_config_id' => '1' ]
            ]);
    }
}
