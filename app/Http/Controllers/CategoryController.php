<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show($category_name, Request $request)
    {
        $category_name = str_replace('_', ' ', $category_name);
        $category = Category::where('name', $category_name)->first();
        $products = Category::where('name', $category_name)->first()->products();
        $product_sort = $request->input('product-sort');
        
        if ( $product_sort == 'rankBy' ) {
            $products = $products->orderBy('views', 'desc')->paginate(12);
        } else if ( $product_sort == 'priceBydesc' ) {
            $products = $products->orderBy('price', 'desc')->paginate(12);
        } else if ( $product_sort == 'priceByasc' ) {
            $products = $products->orderBy('price', 'asc')->paginate(12);
        } else {
            $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
        } 


        return view('Category.show')->with('products', $products)->with('category_name', $category_name)->with('game', $category);
    }
}
