<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\User;

class BookmarkController extends Controller
{
    public function index(Request $request)
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

    public function create()
    {
        //
    }

    public function store($shop_id, Request $request)
    {
        $shop = Shop::find($shop_id);
        $shop->users()->toggle( Auth::user()->id );

        echo $shop->users()->get()->where('id', Auth::user()->id)->count();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
