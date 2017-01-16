<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Cpu;
use App\Vga;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::statement(DB::raw('set @row:=0'));
        $product_sort = $request->input('product-sort');
        if( $product_sort == '' ) {
            $products = Product::orderBy('views', 'desc');
        } else {
            if ( $product_sort == 'rankBy' ) {
                $products = Product::orderBy('views', 'desc');
            } else if ( $product_sort == 'priceBy' ) {
                $products = Product::orderBy('price', 'desc');
            } else {
                $products = Product::orderBy('id', 'desc');
            } 
        }
        $products = $products->selectRaw('*, @row:=@row+1 as row')->paginate(12);

        return view('Product.index')->with('products', $products);
        
        //test searchFilter 

        /* index.php 테스트 추가 
        <input type="hidden" class="search-val" name="cpu" value="1"/> 
        <input type="hidden" class="search-val" name="vga" value="3"/>  
        <input type="hidden" class="search-val" name="os" value="0"/> 
        */
        
        /* 시작 
        DB::statement(DB::raw('set @row:=0'));
        $product_sort = $request->input('product-sort');
        $cpu_level = $request->input('cpu');
        $vga_level = $request->input('vga');
        $os = $request->input('os');
        // $products = Product::get();

        if( $product_sort == '' ) {
            $products = Product::orderBy('views', 'desc');
        } else {
            if ( $product_sort == 'rankBy' ) {
                $products = Product::orderBy('views', 'desc');
            } else if ( $product_sort == 'priceBy' ) {
                $products = Product::orderBy('price', 'desc');
            } else {
                $products = Product::orderBy('id', 'desc');
            } 
        }

        if($cpu_level != ''){
            $cpus = Cpu::where('level', $cpu_level)->get();
            $cpu_id = array();
            foreach ( $cpus as $cpu ) {
                array_push($cpu_id, $cpu->id);
            }
            $products = $products->whereIn('cpu_id', $cpu_id);
        }   
        if($vga_level != ''){
            $vgas = Vga::where('level', $vga_level)->get();
            $vga_id = array();
            foreach ( $vgas as $vga ) {
                array_push($vga_id, $vga->id);
            }
            $products = $products->whereIn('vga_id', $vga_id);
        }
        if($os != ''){
            $products = $products->where('os', $os);
        }

        $products = $products->selectRaw('*, @row:=@row+1 as row')->paginate(12);

        return view('Product.index')->with('products', $products);
        끝 */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
        $product->name = $request->input('name');
        $product->image = $request->input('image');
        $product->url = $request->input('url');
        $product->price = number_format($request->input('price'));
        $product->os = $request->input('os');
        $product->ram = $request->input('ram');
        $product->ssd = $request->input('ssd');
        $product->hdd = $request->input('hdd');
        $product->overclock = $request->input('overclock');
        $product->power = $request->input('power');
        $product->monitor = $request->input('monitor');
        $product->shop_id = $product->shop->id;
        $product->cpu_id = $request->input('cpu_id');
        $product->vga_id = $request->input('vga_id');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect('product');
    }

    //view count up! 
    public function viewCount($product_id)
    {
        $product = Product::find($product_id);
        $product->views = $product->id + 1;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show')->with('product', $product);
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

        return view('product.edit')->with('product', $product);
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
        $product->name = $request->input('name');
        $product->image = $request->input('image');
        $product->url = $request->input('url');
        $product->price = number_format($request->input('price'));
        $product->os = $request->input('os');
        $product->ram = $request->input('ram');
        $product->ssd = $request->input('ssd');
        $product->hdd = $request->input('hdd');
        $product->overclock = $request->input('overclock');
        $product->power = $request->input('power');
        $product->monitor = $request->input('monitor');
        $product->shop_id = $product->shop()->id;
        $product->cpu_id = $request->input('cpu_id');
        $product->vga_id = $request->input('vga_id');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect('product');
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
        
        if(Auth::email() == $product->shop()->user_id)
            $product->delete();

        return redirect('product');
    }
}
