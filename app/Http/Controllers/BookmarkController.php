<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\User;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find( Auth::user()->id );
        $shops = $user->shops();

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
    public function store($shop_id, Request $request)
    {
        $shop = Shop::find($shop_id);
        $shop->users()->toggle( Auth::user()->id );

        echo $shop->users()->get()->where('id', Auth::user()->id)->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
