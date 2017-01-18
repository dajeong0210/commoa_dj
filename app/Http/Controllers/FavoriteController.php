<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find( Auth::user()->id );
        $products = $user->products();

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

        return view('favorite.index')->with('products', $favorites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id, Request $request)
    {
        $product = Product::find($product_id);
        $product->users()->toggle( Auth::user()->id );

        echo $product->users()->get()->where('id', Auth::user()->id)->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
