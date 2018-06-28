<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle')->insert([
            ['brand' => 'Volkswagen', 'model' => 'Fox', 'patent' => 'LHN 640','seats' => '5'],
            ['brand' => 'Volkswagen', 'model' => 'Gol', 'patent' => 'JSV 111','seats' => '5']
            ]);
    }
}
