<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find( Auth::user()->id );
        $products = $user->products();
        $product_sort = $request->input('product-sort');

        if( $product_sort == '' ) {
            $products = $products->orderBy('views', 'desc')->paginate(12);
        } else {
            if ( $product_sort == 'rankBy' ) {
                $products = $products->orderBy('views', 'desc')->paginate(12);
            } else if ( $product_sort == 'priceBydesc' ) {
                $products = $products->orderBy('price', 'desc')->paginate(12);
            } else if ( $product_sort == 'priceByasc' ) {
                $products = $products->orderBy('price', 'asc')->paginate(12);
            } else {
                $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
            } 
        }  

        return view('favorite.index')->with('products', $products);
    }

    public function create()
    {
        //
    }

    public function store($product_id, Request $request)
    {
        $product = Product::find($product_id);
        $product->users()->toggle( Auth::user()->id );

        echo $product->users()->get()->where('id', Auth::user()->id)->count();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
