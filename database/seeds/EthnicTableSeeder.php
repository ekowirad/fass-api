<?php

use Illuminate\Database\Seeder;
use App\Ethnic;

class EthnicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $ethnics = ["Jawa", "Sunda", "Banten", "Cirebon", "Betawi", "Madura", "Melayu", "Batak", "Minangkabau", "Aceh", "Lampung", "Kubu", "Dayak", "Banjar", "Kutai", "Berau", "Bajau", "Makassar", "Bugis", "Mandar", "Tolaki", "Minahasa", "Gorontalo", "Toraja", "Bali", "Sasak", "Flores", "Sumba", "Sumbawa", "Timor", "Ambon", "Nualu", "Manusela", "Wemale", "Papua", "Dani", "Bauzi", "Asmat"];

       foreach ($ethnics as $key => $value) {
           Ethnic::create([
               'name' => $value
           ]);

       }
    }
}
