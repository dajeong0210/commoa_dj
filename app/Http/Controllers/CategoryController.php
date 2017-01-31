<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show($category_name)
    {
        $category_name = str_replace('_', ' ', $category_name);
        $category_id = Category::where('name', $category_name)->first()->id;
        $products = Category::where('name', $category_name)->first()->products()->orderBy('id', 'desc')->paginate(12);

        return view('category.show')->with('products', $products)->with('category_name', $category_name);
    }
}
