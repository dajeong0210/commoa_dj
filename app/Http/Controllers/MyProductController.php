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
use App\Cpu;
use App\Vga;

class MyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = User::find(Auth::user()->id)->shop->products();
        $search = $request->input('search');
        $product_sort = $request->input('product-sort');
        $products = $products->where('name', 'LIKE', '%'.$search.'%');
        if( $product_sort == '' ) {
            $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
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
        return view('myproduct.index')->with('products', $products)->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get(); 
        $cpus = Cpu::get();
        $vgas = Vga::get();

        return view('myproduct.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
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
        if($request->input('os') == '') { 
            $product->os = Null;
        } else { 
            $product->os = $request->input('os');
        }
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
        $categories = Category::get();
        $cpus = Cpu::get();
        $vgas = Vga::get();
        $selected = array();
        foreach( $product->categories()->get() as $select ){
            array_push( $selected, $select->id);
        }

        return view('myproduct.edit')->with('product', $product)->with('categories', $categories)
                ->with('selected', $selected)->with('cpus', $cpus)->with('vgas', $vgas);
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
        if( $request->file('image') != Null ) {
            $path_i = $request->file('image')->store('images');
            $product->image = $path_i;
        }        
        $product->name = $request->input('name');
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
        $categories = $product->categories()->get();
        $users = $product->users()->get();
        foreach ($categories as $category) {
            $category->products()->toggle( $product->id );
        }
        foreach ($users as $user) {
            $product->users()->toggle( $user->id );
        }
        if( Auth::user()->id == $product->shop->user_id ) {
            $product->delete();
        }
        return redirect('myproduct');
    }
}
