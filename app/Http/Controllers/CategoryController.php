<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryPostRequest;
use App\Http\Requests\Category\UpdateCategoryPatchRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct (CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index (Request $request) : JsonResponse
    {
        return $this->categoryService->list($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryPostRequest $request
     * @return JsonResponse
     */
    public function store (StoreCategoryPostRequest $request) : JsonResponse
    {
        return $this->categoryService->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show (Category $category) : JsonResponse
    {
        return $this->categoryService->get($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryPatchRequest $request
     * @param Category                   $category
     * @return JsonResponse
     */
    public function update (UpdateCategoryPatchRequest $request, Category $category) : JsonResponse
    {
        return $this->categoryService->update($category, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy (Category $category) : JsonResponse
    {
        return $this->categoryService->delete($category);
    }
}
