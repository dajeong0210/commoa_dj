<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Apply;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop_sort = $request->input('shop-sort');

        if( $shop_sort == '' ) {
            $shops = Shop::orderBy('updated_at', 'desc')->paginate(20);
        } else {
            if( $shop_sort == 'all' ) {
                $shops = Shop::orderBy('updated_at', 'desc')->paginate(20);
            } elseif ( $shop_sort == 'nameBy' ) {
                $shops = Shop::orderBy('name', 'asc')->paginate(20);
            }
        }      
        return view('shop.index')->with('shops', $shops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //apply id를 받아옴  
        $apply_id = $request->input('apply_id');
        $apply = Apply::find($apply_id);
        $apply_email = Apply::find($apply_id)->user_email;
        if( User::where('email', $apply_email)->count() != 0 ) {
            $shop_admin = User::where('email', $request->input('user_email'))->first();
            $shop_admin->permission = 1;
            $shop_admin->save();
            $apply->permission = 1;
            $apply->save();
            
            // $shop = new Shop;
            // $shop->name = $request->input('shop_name');
            // $shop->url = $request->input('shop_url');
            // $shop->contact_address = $request->input('business_address');
            // $shop->contact_name = $request->input('contact_name');
            // $shop->contact_phone = $request->input('contact_phone');
            // $shop->contact_email = $request->input('contact_email');
            // $shop->user_id = User::where('email', $apply_email)->first()->id;
            // $shop->save();
           
            $shop = new Shop;
            $shop->name = $apply->shop_name;
            $shop->url = $apply->shop_url;
            $shop->contact_address = $apply->business_address;
            $shop->contact_name = $apply->contact_name;
            $shop->contact_phone = $apply->contact_phone;
            $shop->contact_mobile = $apply->contact_mobile;
            $shop->contact_email = $apply->contact_email;
            $shop->user_id = User::where('email', $apply_email)->first()->id;
            $shop->save();
        }
        return redirect('apply');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        return view('shop.show')->with('shop', $shop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('shop.edit')->with('shop', $shop);
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
        $shop = Shop::find($id);
        if( $request->file('image') != null ) { 
            $path_i = $request->file('image')->store('images');
            $shop->image = $path_i;
        } 
        $shop->name = $request->input('shop_name');
        $shop->url = $request->input('shop_url');
        $shop->contact_address = $request->input('business_address');
        $shop->contact_name = $request->input('contact_name');
        $shop->contact_phone = $request->input('contact_phone');
        $shop->contact_mobile = $request->input('contact_mobile');
        $shop->contact_email = $request->input('contact_email');
        $shop->save();
        return redirect('shop/'.$shop->id.'/edit')->with('shop', $shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return redirect('/');
    }
}
