<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use App\Category;
use App\Banner;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    public function index()
    {
        DB::statement(DB::raw('set @row:=0'));

        // $recommend = Product::where('recommend', '<>', 0)->orderBy('recommend', 'asc')->limit(4)->get();
        $products1 = Category::where('id', 1)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $products2 = Category::where('id', 2)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $products3 = Category::where('id', 3)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $shops = Shop::orderBy('id', 'asc')->selectRaw('*, @row:=@row+1 as row')->limit(8)->get();
        $banners = Banner::get();

        return view('welcome')->with('products1', $products1)->with('products2', $products2)
                ->with('products3', $products3)->with('shops', $shops)->with('banners', $banners);
    }
}
