<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware("auth:api");

    }

    public function index()
    {

        $categories = Category::included()->filter()->sort()->getOrPaginate();

        return CategoryResource::collection($categories);

    }

    public function store(Request $request)
    {

        $request->validate([

            "category" => "required",
            "url" => "required|unique:categories"

        ]);

        $category = Category::create($request->all());

        return CategoryResource::make($category);

    }

    public function show($id)
    {

        $category = Category::included()->findOrFail($id);

        return CategoryResource::make($category);

    }

    public function update(Request $request, Category $category)
    {

        $request->validate([

            "category" => "required",
            "url" => "required|unique:categories,url,".$category->id

        ]);

        $category->update($request->all());

        return CategoryResource::make($category);

    }

    public function destroy(Category $category)
    {

        $category->delete();

        return CategoryResource::make($category);

    }

}