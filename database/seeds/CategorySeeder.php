<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.ies
     *
     * @return void
     */
    public function run()
    {
         DB::table('categories')->insert([
            ['name' => 'ファッション'],
            ['name' => '食品'],
            ['name' => '雑貨'],
            ['name' => '日用品'],
        ]);
    }
}
