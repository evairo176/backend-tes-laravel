<?php

namespace Database\Seeders;

use App\Models\Category;
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
        DB::table('categories')->delete();
        $categories = [
            ["id" => 1, "title" => "Olahraga", "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nostrum maxime deleniti?"],
            ["id" => 2, "title" => "Teknologi", "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nostrum maxime deleniti?"],
            ["id" => 3, "title" => "Makanan", "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nostrum maxime deleniti?"]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
