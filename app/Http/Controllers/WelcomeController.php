<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use App\Category;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    public function index()
    {
        DB::statement(DB::raw('set @row:=0'));

        $products1 = Category::where('id', 1)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $products2 = Category::where('id', 2)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $products3 = Category::where('id', 3)->first()->products()->orderBy('views', 'desc')->limit(4)->get(); 
        $shops = Shop::orderBy('id', 'asc')->selectRaw('*, @row:=@row+1 as row')->limit(8)->get();

        return view('welcome')->with('products1', $products1)->with('products2', $products2)
                ->with('products3', $products3)->with('shops', $shops);
    }
}
