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
use Carbon\Carbon;

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
            return view('Admin.Product.index')->with('products', $products)->with('search', $search);
        } else { 
            return view('MyProduct.index')->with('products', $products)->with('search', $search);
        }
    }

    public function create()
    {
        $categories = Category::get(); 
        $cpus = Cpu::get();
        $vgas = Vga::get();

        if( Auth::user()->permission == 2 ) { 
            return view('Admin.Product.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
        } else { 
            return view('MyProduct.create')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
        }
        
    }

    public function store(ProductStoreRequest $request)
    {
        $product = new Product($request->all());
        $image = $request->file('image');
        $purpose = $request->input('purpose');
        $categories = $request->input('category');
        $id = Category::where('name', $purpose)->first()->id;
        
        if( $purpose != '게임용') {
            $categories = array($id);
        } else {
            $count = count($categories);
            if( $count < 1 || $count > 7 ) {
                session()->flash('msg', "카테고리는 1~7개 범위로 선택해주세요.");
                return back();
            } else {
                array_push($categories, $id);
            }
            
        }
            
        $product->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('product',  $image, 'public');

        if($request->input('ssd') == '') { 
            $product->ssd = null;
        }
        if($request->input('hdd') == '') { 
            $product->hdd = null;
        }
        if($request->input('monitor') == '') { 
            $product->monitor = null;
        }
        $product->shop_id = Auth::user()->shop->id;
        $product->save();
        $product->categories()->sync($categories);
        $shop = $product->shop;
        $shop->product_updated_at = Carbon::now('Asia/Seoul');
        $shop->save();
            
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
            return view('Admin.Product.edit')->with('product', $product)->with('categories', $categories)
                ->with('cpus', $cpus)->with('vgas', $vgas)->with('selected', $selected);
        } else {
            return view('MyProduct.edit')->with('product', $product)->with('categories', $categories)
                ->with('cpus', $cpus)->with('vgas', $vgas)->with('selected', $selected);
        }
        
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if( Auth::user()->permission != 2 ) {
            $this->authorize('update', $product->shop);
        }

        $purpose = $request->input('purpose');
        $categories = $request->input('category');
        $id = Category::where('name', $purpose)->first()->id;
        
        if( $purpose != '게임용') {
            $categories = array($id);
        } else {

            if( count($categories) > 7 ) {
                session()->flash('msg', "카테고리는 1~7개 범위로 선택해주세요.");
                return back();
            } else {
                array_push($categories, $id);
            }
            
        }
        
        $product->categories()->sync($categories);
        $image = $request->file('image');
        $monitor = $request->input('monitor');
        $ssd = $request->input('ssd');
        $hdd = $request->input('hdd');
        if($ssd == '') { 
            $ssd = null;
        }
        if($hdd == '') { 
            $hdd = null;
        }
        if( $monitor == '' ) { 
            $monitor = null;
        }
        $request->merge(['monitor' => $monitor,'ssd' => $ssd, 'hdd' => $hdd ]);
        $request = $request->except(['_method', '_token', 'category']);
        $product->update($request);
        
        if( $image != Null ) {
            $product->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::disk("s3")->put('product', $image, 'public');    
        }
        $product->save();
        $shop = $product->shop;
        $shop->product_updated_at = Carbon::now('Asia/Seoul');
        $shop->save();
        
        if( Auth::user()->permission == 2 ){
            return redirect('admin/product');
        } else {
            return redirect('myproduct');
        }

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if( Auth::user()->permission != 2 ) {
            $this->authorize('delete', $product->shop);
        }
        $categories = $product->categories()->get();
        $users = $product->users()->get();
        foreach ($categories as $category) {
            $category->products()->toggle( $product->id );
        }
        foreach ($users as $user) {
            $product->users()->toggle( $user->id );
        }
        $product->delete();
        
        if( Auth::user()->permission == 2 ){
            return redirect('admin/product');
        } else {
            return redirect('myproduct');
        }
    }
}
