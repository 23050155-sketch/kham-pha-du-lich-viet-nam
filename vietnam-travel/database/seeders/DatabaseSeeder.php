<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            CategorySeeder::class,
            PlaceSeeder::class,
            PlaceImageSeeder::class,
            TayNinhPlaceSeeder::class,
        ]);
    }
}