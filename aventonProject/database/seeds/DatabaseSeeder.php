<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TripConfigurationsSeeder::class,
            TripsTableSeeder::class,
            VehicleTableSeeder::class,
        ]);
    }
}
