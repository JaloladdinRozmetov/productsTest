<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $numberOfProducts = 10;

        for ($i = 0; $i < $numberOfProducts; $i++) {
            DB::table('products')->insert([
                'article' => $faker->unique()->regexify('/^[a-zA-Z0-9]+$/'),
                'name' => $faker->sentence(2),
                'status' => $faker->randomElement(['available']),
                'data' => json_encode(['color' => $faker->colorName, 'size' => $faker->randomElement(['small', 'medium', 'large'])]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
