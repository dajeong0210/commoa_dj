<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Cpu;
use App\Vga;
use App\Category;
use URL;

class ProductController extends Controller
{

    public function index(Request $request)
    {        
        DB::statement(DB::raw('set @row:=0'));
        $filter_categories = $request->input('purpose');
        $product_sort = $request->input('product-sort');
        $cpu_level = $request->input('cpu_level'); 
        $vga_level = $request->input('vga_level'); 
        $os = $request->input('os');
        $monitor = $request->input('monitor');
        // $storage = $request->input('storage'); 
        $ssd = $request->input('ssd');
        $hdd = $request->input('hdd');
        $categories = Category::orderBy('sort', 'desc')->orderBy('name','asc')->get();
        $or_products = null;

        if ( strpos( URL::current() , 'office') ) {
            $products = Category::where('name', '사무용')->first()->products();
        } else if ( strpos( URL::current() , 'game') ) {
            $products = Category::where('name', '게임용')->first()->products();
        } else if ( strpos( URL::current() , 'graphic') ) {
            $products = Category::where('name', '디자인용')->first()->products();
        } else if ( strpos( URL::current() , 'home') ) {
            $products = Category::where('name', '가정용')->first()->products();
        } else {
            $products = new Product;
        }
        
        if( $cpu_level != null || $vga_level != null || $os != null || $monitor != null || $ssd != null || $hdd != null || $filter_categories != null ) {

            if( $cpu_level != null ) {               
                $cpus = Cpu::whereIn('level', $cpu_level)->get();
                $cpu_id = array();
                foreach ( $cpus as $cpu ) {
                    array_push($cpu_id, $cpu->id);
                }
                $products = $products->whereIn('cpu_id', $cpu_id);
            } 

            if( $vga_level != null ) {
                $vgas = Vga::whereIn('level', $vga_level)->get();
                $vga_id = array();
                foreach ( $vgas as $vga ) {
                    array_push($vga_id, $vga->id);
                }
                $products = $products->whereIn('vga_id', $vga_id);
            }
            
            if( $os != null ) {
                if( $os == 0 ) { 
                    $products = $products->where('os', 0);
                } else {
                    $products = $products->where('os', 1);
                }
            }

            if( $monitor != null ) {
                if( $monitor == 0 ) {
                    $products = $products->whereNull('monitor');
                } else {
                    $products = $products->whereNotNull('monitor');
                }
            }

            if( $ssd != null ) {
                if( $ssd == 0 ) {
                    $products = $products->whereNull('ssd');
                } else {
                    $products = $products->whereNotNull('ssd');
                }
            }

            if( $hdd != null ) {
                if( $hdd == 0 ) {
                    $products = $products->whereNull('hdd');
                } else {
                    $products = $products->whereNotNull('hdd');
                }
            }
            
            // if( $storage != null ) {
            //     if( count($storage) == 3 ) {
            //         $products = $products->Where(function ($products){
            //             $products = $products->whereNotNull('hdd')->whereNull('ssd');
            //         })->orWhere(function ($products){
            //             $products = $products->whereNotNull('ssd')->whereNull('hdd');
            //         })->orWhere(function ($products){
            //             $products = $products->whereNotNull('hdd')->whereNotNull('ssd');
            //         });
            //     } else if( count($storage) == 2 ) {
            //         if( in_array('hdd', $storage) ) {
            //             if( in_array('ssd', $storage) ) {
            //                 $products = $products->Where(function ($products){
            //                     $products = $products->whereNotNull('hdd')->whereNull('ssd');
            //                 })->orWhere(function ($products){
            //                     $products = $products->whereNotNull('ssd')->whereNull('hdd');
            //                 });
            //             } else {
            //                 $products = $products->where(function ($products){
            //                     $products = $products->whereNotNull('hdd')->whereNull('ssd');
            //                 })->orWhere(function ($products){
            //                     $products = $products->whereNotNull('hdd')->whereNotNull('ssd');
            //                 }); 
            //             }
            //         } else {
            //             $products = $products->where(function ($products){
            //                 $products = $products->whereNotNull('ssd')->whereNull('hdd');
            //             })->orWhere(function ($products){
            //                 $products = $products->whereNotNull('hdd')->whereNotNull('ssd');
            //             }); 
            //         }
            //     } else {
            //         if( in_array('hdd', $storage) ) {
            //             $products = $products->whereNotNull('hdd')->whereNull('ssd');
            //         } else if( in_array('ssd', $storage) ) {
            //             $products = $products->whereNotNull('ssd')->whereNull('hdd');
            //         } else {
            //             $products = $products->whereNotNull('hdd')->whereNotNull('ssd');
            //         }
            //     }            
            // }
            
            // 게임용PC filter 
            if( $filter_categories != null ) {
                //AND type filter
                foreach( $filter_categories as $category ) {
                    $products = $products->whereHas('categories', function($products) use ($category) {  
                            $products->where('categories.name', $category);            
                    });
                }
                    
                if( $products->count() == 0 ) {
                    $or_products = Category::where('name', '게임용')->first()->products();
                    //OR type filter 
                    $or_products = $or_products->whereHas('categories', function($or_products) use ($filter_categories) {  
                            $or_products->whereIn('categories.name', $filter_categories);            
                    })->paginate(4);
                }
            }
             
        }      

        $products = $products->selectRaw('*, @row:=@row+1 as row');

        if ( $product_sort == 'rankBy' ) {
            $products = $products->orderBy('views', 'desc')->paginate(12);
        } else if ( $product_sort == 'priceBydesc' ) {
            $products = $products->orderBy('price', 'desc')->paginate(12);
        } else if ( $product_sort == 'priceByasc' ) {
            $products = $products->orderBy('price', 'asc')->paginate(12);
        } else {
            $products = $products->orderBy('products.updated_at', 'desc')->paginate(12);
        } 

        return view('Product.index')->with('products', $products)->with('categories', $categories)->with('or_products', $or_products);
    }

    public function viewCount($product_id, Request $request)
    {
        $product = Product::find($product_id);
        $count = $product->views;
        $product->views = $count + 1;
        $product->save();
    }

    public function show($id)
    {
        $product = Product::find($id);
        $cpu_id = $product->cpu_id;
        $vga_id = $product->vga_id;
        $cpu_level = $product->cpu->level;
        $vga_level = $product->vga->level;
        $cpus = Cpu::where('level', $cpu_level)->pluck('id');
        $vgas = Vga::where('level', $vga_level)->pluck('id');
        $similar = Product::where('cpu_id', $cpu_id)->where('vga_id', $vga_id)->where('id', '<>', $id);
        $count = $similar->count();
        if( $count < 4 ) {
            $similar->orderBy('views', 'desc')->limit($count);
            $similar2 = Product::whereIn('cpu_id', $cpus)->whereIn('vga_id', $vgas)->where('id', '<>', $id)->orderBy('views', 'desc')->limit(4-$count);
            $similar = $similar->union($similar2)->get();
        }
       
        return view('Product.show')->with('product', $product)->with('similar', $similar);
    }

}
