<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Apply;

class UserController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $favorites = $user->products()->orderBy('pivot_product_user.created_at', 'desc')->limit(4)->get();
        $bookmarks = $user->shops()->orderBy('pivot_shop_user.created_at', 'desc')->limit(8)->get();

        return view('mypage.index')->with('user', $user)->with('favorites', $favorites)->with('bookmarks', $bookmarks);
    }

}
