<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $locations = Zoom::listLocation();
        $locations = [
            [
                "name" => "Lantai 3",
                "location_id" => "ZorPKdF5Qhayz1bd_PUy4A",
            ],
            [
                "name" => "Lantai 4",
                "location_id" => "ybq2Bw2rRQK1oEVACQIzDA",
            ],
            [
                "name" => "Lantai 5",
                "location_id" => "mF_oINIfRsu8eIA41esVdg",
            ],
            [
                "name" => "Lantai 6",
                "location_id" => "4FirfiIYSWapLVa0rvrCMQ",
            ],
        ];
        $data = [];
        foreach ($locations as $value) {
            $data[] = [
                'location_id' => $value['location_id'],
                'name' => $value['name'],
            ];
        }
        Location::insert($data);
    }
}
