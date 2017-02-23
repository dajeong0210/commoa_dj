<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $recommends = Product::where('recommend', '<>', 0)->orderBy('recommend', 'asc')->limit(4)->get();
        $new_items = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $products1 = Product::orderBy('views', 'desc')->limit(4)->get(); 
        $products_cnt = Product::count();
        $shops_cnt = Shop::count();
        $banners = Banner::get();

        if( !Auth::guest() ) {
            $favorites = Auth::user()->products()->orderBy('pivot_product_user.created_at', 'desc')->limit(3)->get();
        } else {
            $favorites = null;
        }

        return view('welcome')->with('new_items', $new_items)->with('products1', $products1)
                ->with('products_cnt', $products_cnt)->with('shops_cnt', $shops_cnt)
                ->with('banners', $banners)->with('recommends', $recommends);
    }

    public function privacy() {
        return view('privacy');
    }

    public function service() {
        return view('service');
    }

    public function spec_game() {
        return view('spec');
    }
}
