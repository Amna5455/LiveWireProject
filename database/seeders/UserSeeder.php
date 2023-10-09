<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('123')
        ]);
        User::create([
            'name' => 'test',
            'email'=> 'test@gmail.com',
            'password' => bcrypt('123')
        ]);
         $faker = Faker::create();
            for($i=0;$i<20;$i++){
                User::create([
                    'name' => $faker->name,
                    'email'=> $faker->email,
                    'password' => bcrypt('123')
                ]);
            }
    }
}
