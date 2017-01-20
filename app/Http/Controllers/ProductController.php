<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cpu;
use App\Vga;
use App\Category;

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
        $total_categories = Category::get();
        $categories = $request->input('purpose');
        $cpu_level = $request->input('cpu_level');
        $vga_level = $request->input('vga_level');
        $os = $request->input('os');
        $monitor = $request->input('monitor');
        $ssd = $request->input('ssd');
        $products = new Product;

        if( $categories != null ) {
            
            // OR type filter
            // $products = $products->whereHas('categories', function($products) use ($categories) {
            //     $products->whereIn('categories.name', $categories);
            // });

            // AND type filter
            foreach( $categories as $category ) {
                $products = $products->whereHas('categories', function($products) use ($category) {  
                        $products->where('categories.name', $category);            
                });
            }   

        } else if( $cpu_level != '' || $vga_level != '' || $os != '' || $monitor != '' || $ssd != '' ) {

            if( $cpu_level != '' ) {
                $cpus = Cpu::where('level', $cpu_level)->get();
                $cpu_id = array();
                foreach ( $cpus as $cpu ) {
                    array_push($cpu_id, $cpu->id);
                }
                $products = $products->whereIn('cpu_id', $cpu_id);
            } 

            if( $vga_level != '' ) {
                $vgas = Vga::where('level', $vga_level)->get();
                $vga_id = array();
                foreach ( $vgas as $vga ) {
                    array_push($vga_id, $vga->id);
                }
                $products = $products->whereIn('vga_id', $vga_id);
            }

            if( $os != '' ) {
                if( $os == 0 ) { 
                    $products = $products->where('os', 0);
                } else {
                    $products = $products->where('os', 1);
                }
            }

            if( $ssd != '' ) {
                if( $ssd == 0 ) {
                    $products = $products->whereNull('ssd');
                } else {
                    $products = $products->whereNotNull('ssd');
                }
            }
            
            if( $monitor != '' ) {
                if( $monitor == 0 ) {
                    $products = $products->whereNull('monitor');
                } else {
                    $products = $products->whereNotNull('monitor');
                }
            }

        }

        $products = $products->selectRaw('*, @row:=@row+1 as row');

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

        return view('Product.index')->with('products', $products)->with('categories', $total_categories);
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
    public function store(Request $request)
    {
        //
    }

    //view count up! 
    public function viewCount($product_id, Request $request)
    {
        $product = Product::find($product_id);
        $count = $product->views;
        $product->views = $count + 1;
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
