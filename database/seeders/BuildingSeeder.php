<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $building =  [
            [
                'name' => 'AL NOOR SALALAH',
            ],
            [
                'name' => 'AL NOOR SAADAH',
            ],
            [
                'name' => 'AL NOOR PLAZA',
            ],
            [
                'name' => 'AL NOOR SQUARE',
            ],
            [
                'name' => 'AL NOOR BEACH',
            ],
            [
                'name' => 'AL NOOR SUITES',
            ],
            [
                'name' => 'MIRBAT VILLA',
            ],
            [
                'name' => 'AL NAJOR VILLA',
            ],


        ];

        Building::insert($building);
    }
}
