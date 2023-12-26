<?php

namespace Database\Seeders;

use App\Models\Todos;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Todos::create([
                'name'=>$faker->name(),
                'description'=>$faker->sentence(),
                'isDone'=>$faker->boolean(),
            ]);
        }
    }
}
