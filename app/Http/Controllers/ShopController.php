<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderBy('id', 'asc')->paginate(20);
        
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
        $path_i = $request->file('image')->store('images');

        $shop = new Shop;
        $shop->name = $request->input('shop_name');
        $shop->image = $path_i;
        $shop->url = $request->input('shop_url');
        $shop->contact_address = $request->input('business_address');
        $shop->contact_name = $request->input('contact_name');
        $shop->phone = $request->input('contact_phone');
        $shop->email = $request->input('contact_email');
        $shop->user_id = input('user_email');
        $shop->save();

        return redirect('main');
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

        return view('shop.edit')->with($shop);
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
        $path_i = $request->file('image')->store('images');

        $shop = Shop::find($id);
        $shop->name = $request->input('shop_name');
        $shop->image = $path_i;
        $shop->url = $request->input('shop_url');
        $shop->contact_address = $request->input('business_address');
        $shop->contact_name = $request->input('contact_name');
        $shop->phone = $request->input('contact_phone');
        $shop->email = $request->input('contact_email');
        $shop->user_id = input('user_email');
        $shop->save();

        return redirect('main');
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

        return redirect('main');
    }
}
