<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'name' => 'Pembantu Rumah Tangga',
                'code' => 'PRT',
            ],
            [
                'name' => 'Pengasuh Bayi',
                'code' => 'BYI',
            ],
            [
                'name' => 'Pengasuh Lansia',
                'code' => 'LNS',
            ]

        ];

        foreach ($jobs as $key => $value) {
            Job::create([
                'name' => $value['name'],
                'code' => $value['code'],
            ]);
        }
    }
}
