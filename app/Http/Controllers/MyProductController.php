<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
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

    public function index(Request $request)
    {   
        if( Auth::user()->permission == 2 ) { 
            $products = Product::select('id', 'name', 'cpu_id', 'vga_id', 'ram', 'ssd', 'hdd', 'power', 'os', 'overclock', 'monitor', 'image', 'price');
        } else { 
            $products = User::find(Auth::user()->id)->shop->products();
        }
        $search = $request->input('search');
        $product_sort = $request->input('product-sort');
        $products = $products->where('name', 'LIKE', '%'.$search.'%');
        if( $product_sort == '' ) {
            $products = $products->orderBy('updated_at', 'desc')->paginate(12);
            // $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
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

    public function create()
    {
        $categories = Category::get(); 
        $cpus = Cpu::get();
        $vgas = Vga::get();

        return view('myproduct.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
    }

    public function store(ProductStoreRequest $request)
    {
//before
        // $product = new Product;
        // $path_i = $request->file('image')->store('images');
        // $product->name = $request->input('name');
        // $product->image = $path_i;
        // $product->url = $request->input('url');
        // $product->price = $request->input('price');
        // if($request->input('monitor') == '') { 
        //     $product->monitor = Null;
        // } else { 
        //     $product->monitor = $request->input('monitor');
        // }
        // $product->ram = $request->input('ram');
        // $product->ssd = $request->input('ssd');
        // $product->hdd = $request->input('hdd');
        // $product->overclock = $request->input('overclock');
        // $product->power = $request->input('power');
        // $product->os = $request->input('os');
        // $product->shop_id = User::find( Auth::user()->id )->shop->id;
        // $product->cpu_id = $request->input('cpu_id');
        // $product->vga_id = $request->input('vga_id');
        // $product->save();
//
        $request->merge(['image' => $request->file('image')->store('images')]);
        if($request->input('monitor') == '') { 
            $request->merge(['monitor' => null]);
        }
        $product = Auth::user()->shop->products()->create($request->all());

        $categories = $request->input('category');
        if( $categories != null )
            $product->categories()->sync($categories);

        return redirect('myproduct');
    }

    public function edit($id)
    {
        if( Product::find($id)->shop()->first()->user()->first()->id != Auth::user()->id ) {
            return back();
        }
        $product = Product::find($id);
        $categories = Category::get();
        $cpus = Cpu::get();
        $vgas = Vga::get();
        $selected = array();
        foreach ($product->categories()->get() as $category) {
           array_push($selected, $category->id);
        }
        
        return view('myproduct.edit')->with('product', $product)->with('categories', $categories)
                ->with('cpus', $cpus)->with('vgas', $vgas)->with('selected', $selected);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $categories = $request->input('category');
        if ( $categories == null ) { $categories = array(); }
        $product->categories()->sync($categories);

        if( $request->file('image') != Null ) {
            $request->merge(['image' => $request->file('image')->store('images')]);
        }
        if($request->input('monitor') == '') { 
            $request->merge(['monitor' => null]);
        }
        $request = $request->except(['_method', '_token', 'category']);
        $product->update($request);

        return redirect('myproduct');
//before 
        // $product = Product::find($id);
        // if( $request->file('image') != Null ) {
        //     $path_i = $request->file('image')->store('images');
        //     $product->image = $path_i;
        // }        
        // $product->name = $request->input('name');
        // $product->url = $request->input('url');
        // $product->price = $request->input('price');
        // $product->os = $request->input('os');
        // $product->ram = $request->input('ram');
        // $product->ssd = $request->input('ssd');
        // $product->hdd = $request->input('hdd');
        // $product->overclock = $request->input('overclock');
        // $product->power = $request->input('power');
        // if($request->input('monitor') == '') { 
        //     $product->monitor = Null;
        // } else { 
        //     $product->monitor = $request->input('monitor');
        // }
        // $product->shop_id = User::find( Auth::user()->id )->shop->id;
        // $product->cpu_id = $request->input('cpu');
        // $product->vga_id = $request->input('vga');
        // $product->save();
        // $categories = $request->input('category');
        // $product->categories()->sync($categories);
//
    }

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
