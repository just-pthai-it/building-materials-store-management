<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () : void
    {
        $productTypes = [
            [
                'name'     => 'Hình dáng',
                'children' => [
                    ['name' => 'Thẳng',],
                    ['name' => 'Chữ L',],
                ],
            ],
            [
                'name'     => 'Màu sắc',
                'children' => [
                    ['name' => 'Vàng',],
                    ['name' => 'Xanh',],
                    ['name' => 'Đỏ',],
                ],
            ],
        ];

        foreach ($productTypes as $productType)
        {
            $object = ProductType::query()->create(Arr::only($productType, ['name']));
            foreach ($productType['children'] as $child)
            {
                $object->children()->create($child);
            }
        }
    }
}
