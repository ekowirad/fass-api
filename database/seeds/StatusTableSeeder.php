<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            // Order Status
            [
                'name' => 'Sedang diproses',
                'type' => 1,
            ],
            [
                'name' => 'Selesai',
                'type' => 1,
            ],
            [
                'name' => 'Ditolak',
                'type' => 1,
            ],

            // Labor Status
            [
                'name' => 'Tersedia',
                'type' => 2,
            ],
            [
                'name' => 'Sedang Bekerja',
                'type' => 2,
            ],
            [
                'name' => 'Tidak Aktif',
                'type' => 2,
            ],

        ];

        foreach ($statuses as $key => $value) {
            Status::create([
                'name' => $value['name'],
                'type' => $value['type'],
            ]);
        }
    }
}
