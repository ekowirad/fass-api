<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $password = Hash::make('password');

        User::create([
        'name'=> 'Administrator',
        'username' => 'admin',
        'role' => 2,
        'phone' => $faker->e164PhoneNumber,
        'email' => 'admin@admin.com',
        'password' => Hash::make('admin')
    ]);


        for ($i=0; $i < 5; $i++) {
            User::create([
        'name'=> $faker->name,
        'username' => $faker->firstName,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'email' => $faker->email,
        'password' => $password
    ]);
        }
        
     
        //
    }
}
