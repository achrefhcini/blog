<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Sport','Politique','Tourisme','covid19','Media'];
        foreach ($categories as $cat){
            DB::table('categories')->insert([
                'name' => $cat,
                'slug' => strtolower($cat),
                'created_at' => now(),

            ]);
        }
        //
    }
}
