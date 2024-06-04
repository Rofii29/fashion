<?php

namespace Database\Seeders;

use App\Models\fashion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class fashionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = \Faker\Factory::create('id_ID');
       for ($i=0; $i < 10; $i++) {
         fashion::create([
            'nama' => $faker->sentence,
            'nomortelp' => $faker->phoneNumber,
            'alamat' => $faker->address,
            'gambar' => $faker->imageUrl($width = 640, $height = 480),
            'text' => $faker->text($maxNbChars = 200)
         ]);
       }
    }
}
