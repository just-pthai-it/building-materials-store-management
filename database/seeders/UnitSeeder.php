<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () : void
    {
        $units = [
            [
                'name'     => 'Độ dài',
                'children' => [
                    ['name' => 'm',],
                    ['name' => 'cm',],
                ],
            ],
            [
                'name'     => 'Khối lượng',
                'children' => [
                    ['name' => 'kg',],
                    ['name' => 'g',],
                ],
            ],
            [
                'name'     => 'Số lượng',
                'children' => [
                    ['name' => 'tấm',],
                    ['name' => 'viên',],
                ],
            ],
        ];

        foreach ($units as $unit)
        {
            $object = Unit::query()->create(Arr::only($unit, ['name']));
            foreach ($unit['children'] as $child)
            {
                $object->children()->create($child);
            }
        }
    }
}
