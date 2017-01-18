<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Product;
use App\Category;

class MyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = User::find(Auth::user()->id)->shop->products()->orderBy('updated_at', 'desc')->get();
        return view('myproduct.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myproduct.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $path_i = $request->file('image')->store('images');
        $product->name = $request->input('name');
        $product->image = $path_i;
        $product->url = $request->input('url');
        $product->price = $request->input('price');
        $product->os = $request->input('os');
        $product->ram = $request->input('ram');
        $product->ssd = $request->input('ssd');
        $product->hdd = $request->input('hdd');
        $product->overclock = $request->input('overclock');
        $product->power = $request->input('power');
        $product->monitor = $request->input('monitor');
        $product->shop_id = User::find( Auth::user()->id )->shop->id;
        $product->cpu_id = $request->input('cpu');
        $product->vga_id = $request->input('vga');
        $product->save();

        //category id는 배열로 받아와야함!  
        $categories = $request->input('category');
        // foreach( $categories as $category ) {
        //     Category::find($category)->products()->toggle($product->id);
        // }
        $product->categories()->sync($categories);
        return redirect('myproduct');
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
        $product = Product::find($id);
        return view('myproduct.edit')->with('product', $product);
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
        $product = Product::find($id);
        $path_i = $request->file('image')->store('images');
        $product->name = $request->input('name');
        $product->image = $path_i;
        $product->url = $request->input('url');
        $product->price = $request->input('price');
        $product->os = $request->input('os');
        $product->ram = $request->input('ram');
        $product->ssd = $request->input('ssd');
        $product->hdd = $request->input('hdd');
        $product->overclock = $request->input('overclock');
        $product->power = $request->input('power');
        $product->monitor = $request->input('monitor');
        $product->shop_id = User::find( Auth::user()->id )->shop->id;
        $product->cpu_id = $request->input('cpu');
        $product->vga_id = $request->input('vga');
        $product->save();
        $categories = $request->input('category');

        // foreach( $categories as $category ) {
        //     Category::find($category)->products()->toggle($product->id);
        // }
        $product->categories()->sync($categories);
        return redirect('myproduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if( Auth::user()->id == $product->shop->user_id ) {
            $product->delete();
        }
        return redirect('myproduct');
    }
}
