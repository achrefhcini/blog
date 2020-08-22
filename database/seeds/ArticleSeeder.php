<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            $date = now();
            DB::table('articles')->insert([
                'titre' => $faker->realText(50),
                 'created_at' => $date,
                'category_id' => null,
                'image' => "http://lorempixel.com/600/400/sports/",
                'text' =>  $faker->realText(140),
            ]);
        }
        //
    }
}
