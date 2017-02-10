<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Shop;
use App\User;
use App\Apply;
use App\Product;
use URL;

class ShopController extends Controller
{

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
        if( Auth::check() && Auth::user()->permission == 2 && strpos( URL::current() , 'admin') ) {
            return view('Admin.Shop.index')->with('shops', $shops);
        } else { 
            return view('Shop.index')->with('shops', $shops);
        }
        
    }

    public function create()
    {
        return view('Shop.create');
    }

    public function store(Request $request)
    {
        $apply_id = $request->input('apply_id');
        $apply = Apply::find($apply_id);
        $apply_email = Apply::find($apply_id)->user_email;
        if( User::where('email', $apply_email)->count() != 0 ) {
            $shop_admin = User::where('email', $request->input('user_email'))->first();
            $shop_admin->permission = 1;
            $shop_admin->save();
            $apply->permission = 1;
            $apply->save();
           
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

    public function show($id)
    {
        $shop = Shop::find($id);
        return view('Shop.show')->with('shop', $shop);
    }

    public function edit($id)
    {
        $shop = Shop::find($id);

        if( $shop->user->id != Auth::user()->id && Auth::user()->permission != 2 ) {
            return back();
        }

        if( Auth::user()->permission == 2 ) {
            return view('Admin.Shop.edit')->with('shop', $shop);
        } else { 
            return view('Shop.edit')->with('shop', $shop);
        }
    }

    public function update(ShopUpdateRequest $request, $id)
    {
        $shop = Shop::find($id);
        if( Auth::user()->permission != 2 ) {
            $this->authorize('update', $shop);
        }
        $image = $request->file('image');
        if( $image != null ) { 
            $shop->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('shop',  $image, 'public');
        } 
        $request->except(['_method', '_token']);
        $shop->update($request->all());
        return redirect('shop/'.$shop->id.'/edit')->with('shop', $shop);
        
    }

    public function destroy($id)
    {
        $shop = Shop::find($id);
        if( Auth::user()->permission != 2 ) {
            $this->authorize('delete', $shop);
        }
        //shop_user delete 
        $bookmark_users = $shop->users()->get();
        foreach ($bookmark_users as $user) {
            $shop->users()->toggle( $user->id );
        }
        //category_product, category delete
        //product_user, product delete
        $products = $shop->products()->get();
        foreach ($products as $product) {
            $product = Product::find($product->id);
            $categories = $product->categories()->get();
            $favorite_users = $product->users()->get();
            foreach ($categories as $category) {
                $category->products()->toggle( $product->id );
            }
            foreach ($favorite_users as $user) {
                $product->users()->toggle( $user->id );
            }
            $product->delete();
        }
        //shop delete
        $shop->delete();
        //user permission edit 
        $shop->user->permission = 0;
        $shop->user->save();
        return redirect('/admin/shop');
    }
}
