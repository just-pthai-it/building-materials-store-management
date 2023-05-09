<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $products = Product::all();

        foreach ($products as $product)
        {
            $edge = rand(4, 6);
            for ($i = 0; $i < $edge; $i++)
            {
                $specification = $product->specifications()->create();
                $specification->productTypes()->attach(ProductType::query()->whereNotNull('parent_id')->get()->shuffle()->first()->id);
            }
        }

    }
}
