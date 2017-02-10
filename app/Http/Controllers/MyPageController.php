<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Apply;
use App\Shop;
use App\Product;

class MyPageController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $favorites = $user->products()->orderBy('pivot_product_user.created_at', 'desc')->limit(4)->get();
        $bookmarks = $user->shops()->orderBy('pivot_shop_user.created_at', 'desc')->limit(8)->get();

        return view('mypage.index')->with('user', $user)->with('favorites', $favorites)->with('bookmarks', $bookmarks);
    }

    public function userIndex()
    {
        $user = User::find( Auth::user()->id );
        return view('mypage.edit')->with('user', $user);
    }

    public function userUpdate(UserUpdateRequest $request, $id)
    {
    
        $user = User::find($id);
        if( Hash::check( $request->input('old_password'), $user->password) ) {
            if( $request->input('password') != '' &&
                $request->input('password') == $request->input('password_confirmation')) {
                $user->name = $request->input('user_name');
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return redirect('/mypage');
            } else if ( $request->input('password') == '' ) {
                $user->name = $request->input('user_name');
                $user->save();
                return redirect('/mypage');
            }
        } else {
            session()->flash('msg', "비밀번호가 일치하지 않습니다.");
            return back();
        }
    }

    public function bookmarkIndex(Request $request)
    {
        $user = User::find( Auth::user()->id );
        $shops = $user->shops();
        $shop_sort = $request->input('shop-sort');

        if( $shop_sort == '' ) {
            $shops = $shops->orderBy('updated_at', 'desc')->paginate(20);
        } else {
            if( $shop_sort == 'all' ) {
                $shops = $shops->orderBy('updated_at', 'desc')->paginate(20);
            } elseif ( $shop_sort == 'nameBy' ) {
                $shops = $shops->orderBy('name', 'asc')->paginate(20);
            }
        }  

        return view('bookmark.index')->with('shops', $shops);
    }

    public function bookmarkStore($id, Request $request)
    {
        $shop = Shop::find($id);
        $shop->users()->toggle( Auth::user()->id );

        echo $shop->users()->get()->where('id', Auth::user()->id)->count();
    }

    public function favoriteIndex(Request $request)
    {
        $user = User::find( Auth::user()->id );
        $products = $user->products();
        $product_sort = $request->input('product-sort');

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

        return view('favorite.index')->with('products', $products);
    }

    public function favoriteStore($id, Request $request)
    {
        $product = Product::find($id);
        $product->users()->toggle( Auth::user()->id );

        echo $product->users()->get()->where('id', Auth::user()->id)->count();
    }

}
