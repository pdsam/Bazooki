<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Swords'],
            ['name' => 'Firearms'],
            ['name' => 'Pistols'],
            ['name' => 'Bows'],
            ['name' => 'Crossbows'],
            ['name' => 'Knifes'],
            ['name' => 'Rifles'],
            ['name' => 'Vintage'],
            ['name' => 'Modern'],
            ['name' => 'Hunting'],
            ['name' => 'War'],
            ['name' => 'Sport'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
