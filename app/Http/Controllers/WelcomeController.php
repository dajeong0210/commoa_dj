<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Shop;
use App\Category;
use App\Banner;
use App\Advertisement;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    public function index()
    {
        DB::statement(DB::raw('set @row:=0'));

        $recommends = Product::where('recommend', '<>', 0)->orderBy('recommend', 'asc')->limit(4)->get();
        $new_items = Product::orderBy('created_at', 'desc')->limit(8)->get();
        $hot_items = Product::orderBy('views', 'desc')->limit(8)->get(); 
        $products_cnt = Product::count();
        $shops_cnt = Shop::count();
        $banners = Banner::get();
        $shops = Shop::get();
        $advertisements = Advertisement::get();

        return view('welcome')->with('new_items', $new_items)->with('hot_items', $hot_items)
                ->with('products_cnt', $products_cnt)->with('shops_cnt', $shops_cnt)->with('advertisements', $advertisements)
                ->with('banners', $banners)->with('recommends', $recommends)->with('shops', $shops);
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
    
    public function guide() {
        $games = Category::where('sort', '<>', 0)->orWhere('sort', null)->get();
		return view('guide')->with('games', $games);
	}
}
