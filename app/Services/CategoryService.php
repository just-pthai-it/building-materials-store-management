<?php

namespace App\Services;

use App\Helpers\CusResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryService
{
    public function list (array $inputs = []) : JsonResponse
    {
        $categories = Category::query()->filter($inputs)->get();
        return CusResponse::successful($categories);
    }

    public function get (Category $category) : JsonResponse
    {
        return CusResponse::successful($category);
    }

    public function store (array $inputs) : JsonResponse
    {
        $category = Category::query()->create($inputs);
        return CusResponse::createSuccessful(['id' => $category->id]);
    }

    public function update (Category $category, array $inputs) : JsonResponse
    {
        $category->update($inputs);
        return CusResponse::successfulWithNoData();
    }

    public function delete (Category $category) : JsonResponse
    {
        $category->delete();
        return CusResponse::successfulWithNoData();
    }
}
