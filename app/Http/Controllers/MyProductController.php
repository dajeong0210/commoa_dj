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
            $products = Product::whereNotNull('name');
        } else { 
            $products = User::find(Auth::user()->id)->shop->products();
        }

        $search = $request->input('search');
        $product_sort = $request->input('product-sort');
        $products = $products->where('name', 'LIKE', '%'.$search.'%');

        if( $product_sort == '' ) {
            $products = $products->orderBy('updated_at', 'desc')->paginate(12);
        } else {
            if ( $product_sort == 'rankBy' ) {
                $products = $products->orderBy('views', 'desc')->paginate(12);
            } else if ( $product_sort == 'priceBydesc' ) {
                $products = $products->orderBy('price', 'desc')->paginate(12);
            } else if ( $product_sort == 'priceByasc' ) {
                $products = $products->orderBy('price', 'asc')->paginate(12);
            } else if ( $product_sort == 'nameBy' ) {
                $products = $products->orderBy('name', 'asc')->paginate(12);
            } else {
                $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
            } 
        } 

        if( Auth::user()->permission == 2 ) { 
            return view('admin.product.index')->with('products', $products)->with('search', $search);
        } else { 
            return view('myproduct.index')->with('products', $products)->with('search', $search);
        }
    }

    public function create()
    {
        $categories = Category::get(); 
        $cpus = Cpu::get();
        $vgas = Vga::get();

        if( Auth::user()->permission == 2 ) { 
            return view('admin.product.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
        } else { 
            return view('myproduct.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
        }
        
    }

    public function store(ProductStoreRequest $request)
    {
        $product = new Product($request->all());
        // $request->merge(['image' => $request->file('image')->store('images')]);
        $image = $request->file('image');
        $product->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('product',  $image, 'public');

        if($request->input('monitor') == '') { 
            // $request->merge(['monitor' => null]);
            $product->monitor = null;
        }
        // $product = Auth::user()->shop->products()->create($request->all());
        $product->shop_id = Auth::user()->shop->id;
        $product->save();

        $categories = $request->input('category');
        if( $categories != null )
            $product->categories()->sync($categories);

        if( Auth::user()->permission == 2 ){
            return redirect('admin/product');
        } else {
            return redirect('myproduct');
        }
    }

    public function edit($id)
    {
        if( Product::find($id)->shop()->first()->user()->first()->id != Auth::user()->id && Auth::user()->permission != 2 ) {
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
        if( Auth::user()->permission == 2 ) { 
            return view('admin.product.edit')->with('product', $product)->with('categories', $categories)
                ->with('cpus', $cpus)->with('vgas', $vgas)->with('selected', $selected);
        } else {
            return view('myproduct.edit')->with('product', $product)->with('categories', $categories)
                ->with('cpus', $cpus)->with('vgas', $vgas)->with('selected', $selected);
        }
        
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $categories = $request->input('category');
        if ( $categories == null ) { $categories = array(); }
        $product->categories()->sync($categories);
        $image = $request->file('image');
        $monitor = $request->input('monitor');
        if( $monitor == '' ) { 
            $request->merge(['monitor' => null]);
        }
        $request = $request->except(['_method', '_token', 'category']);
        $product->update($request);
        
        if( $image != Null ) {
            $product->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::disk("s3")->put('product', $image, 'public');    
        }
        $product->save();
        
        if( Auth::user()->permission == 2 ){
            return redirect('admin/product');
        } else {
            return redirect('myproduct');
        }

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
        if( Auth::user()->id == $product->shop->user_id || Auth::user()->permission == 2 ) {
            $product->delete();
        }

        if( Auth::user()->permission == 2 ){
            return redirect('admin/product');
        } else {
            return redirect('myproduct');
        }
    }
}
