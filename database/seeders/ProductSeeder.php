<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () : void
    {
        $categories = Category::all();
        foreach ($categories as $category)
        {
            $edge = rand(4, 6);
            for ($i = 0; $i < $edge; $i++)
            {
                $category->products()->create([
                                                  'name'    => $category->name . Str::random(5),
                                                  'unit_id' => Unit::query()->whereNotNull('parent_id')->get()->shuffle()->first()->id,
                                              ]);
            }
        }
    }
}
