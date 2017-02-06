<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CpuRequest;
use App\Http\Requests\VgaRequest;
use App\Http\Requests\VgaCreateRequest;
use App\Http\Requests\CpuCreateRequest;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Apply;
use App\User;
use App\Product;
use App\Shop;
use App\Cpu;
use App\Vga;
use App\Banner;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')->limit(5)->get();
        $shops = Shop::orderBy('updated_at', 'desc')->limit(5)->get();
        $applies = Apply::orderBy('updated_at', 'desc')->where('permission', 0)->limit(10)->get();
        return view('Admin.index')->with('products', $products)->with('shops', $shops)->with('applies', $applies);
    }

//category
    public function category()
    {
        $categories = Category::get();
        return view('Admin.category')->with('categories', $categories);
    }

    public function categoryUpdate(Request $request) {

        $categories = Category::get();
        //edit
        foreach ($categories as $category) {
            $id = $category->id;
            $category->name = $request->input('category'.$id);
            $category->save();
        }
        //create
        if( $addCategory = $request->input('create') ) { 
            for( $i=0; $i<count($addCategory); $i++ ) { 
                $newCategory = new Category;
                $name = $addCategory[$i];
                $newCategory->name = $addCategory[$i];
                $newCategory->save();
            }
        }
        return redirect('/admin/category');
    }
//cpu-vga
    public function cpuvga() {
        $cpus = Cpu::get();
        $vgas = Vga::get();
        $products = Product::get();
        return view('Admin.cpu-vga')->with('cpus', $cpus)->with('vgas', $vgas)->with('products', $products);
    }
    //cpu
    public function categoryCnt($id) { 
        $category = Category::find($id);
        $productCnt = $category->products()->count();
        echo $productCnt;
    }

    public function categoryDelete($id) {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/category');
    }

    public function cpuCreate(CpuCreateRequest $request) {
        // $cpu->create($request); 
        $cpu = new Cpu;
        $cpu->name = $request->input('cpu_name');
        $cpu->brand = $request->input('cpu_brand');
        $cpu->cores = $request->input('cpu_core');
        $cpu->level = $request->input('cpu_level');
        $cpu->save();
        return redirect('/admin/cpu-vga');
    }

    public function cpuUpdate(CpuRequest $request, $id) {
        $cpu = Cpu::find($id);
        $cpu->name = $request->input('cpu_name');
        $cpu->brand = $request->input('cpu_brand');
        $cpu->cores = $request->input('cpu_core');
        $cpu->level = $request->input('cpu_level');
        $cpu->save();
        // $cpu->update($request->all());
        return redirect('/admin/cpu-vga');
    }

    public function cpuCnt($id) { 
        $cpu = Cpu::find($id);
        $productCnt = $cpu->product()->count();
        echo $productCnt;
    }

    public function cpuDelete($id) {
        $cpu = Cpu::find($id);
        $cpu->delete();
        return redirect('/admin/cpu-vga');
    }

    public function findCpu($id) {
        $cpu = Cpu::find($id);
        $array = array( 'name' => $cpu->name, 
                        'brand' => $cpu->brand, 
                        'cores' => $cpu->cores, 
                        'level' => $cpu->level );
        echo json_encode($array);
    }
//vga
    public function vgaCreate(VgaCreateRequest $request) {
        // $vga->create($request);
        $vga = new Vga;
        $vga->name = $request->input('vga_name');
        $vga->brand = $request->input('vga_brand');
        $vga->level = $request->input('vga_level');
        $vga->save();
        return redirect('/admin/cpu-vga');
    }

    public function vgaUpdate(VgaRequest $request, $id) {
        $vga = Vga::find($id);
        $vga->name = $request->input('vga_name');
        $vga->brand = $request->input('vga_brand');
        $vga->level = $request->input('vga_level');
        $vga->save();
        // $vga->update($request->all());
        return redirect('/admin/cpu-vga');
    }

    public function vgaCnt($id) { 
        $vga = Vga::find($id);
        $productCnt = $vga->product()->count();
        echo $productCnt;
    }

    public function vgaDelete($id) {
        $vga = Vga::find($id);
        $vga->delete();
        return redirect('/admin/cpu-vga');
    }

    public function findVga($id) {
        $vga = Vga::find($id);
        $array = array( 'name' => $vga->name, 
                        'brand' => $vga->brand, 
                        'level' => $vga->level );
        echo json_encode($array);
    }


//Product
    public function recommend($id) {
        $product = Product::find($id); 
        $product->recommend = 1; 
        $product->save();
    }

//User
    public function userIndex(Request $request) {
        

        $user_sort = $request->input('user-sort');
        $search = $request->input('search');

        if( $search != '' ) { 
            $users = User::where('name', 'LIKE', '%'.$search.'%');
        } else { 
            $users = User::whereNotNull('name');
        }

        if( $user_sort == '' ) { 
            $users = $users->orderBy('id', 'desc')->paginate(20);
        } else if( $user_sort == '일반회원' ) {
            $users = $users->where('permission', 0)->orderBy('id', 'desc')->paginate(20);
        } else if( $user_sort == '쇼핑몰회원' ) {
            $users = $users->where('permission', 1)->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin.user.index')->with('users', $users)->with('search', $search);
    }

    public function userUpdate(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->input('user_name');
        $user->save();

        return redirect('/admin/user');
    }

    public function permissionUpdate($id) {
        //shop 관리자 -> 일반회원
        $user = User::find($id);
        $shop = $user->shop;
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
        return redirect('/admin/user');
    }

    public function userDelete($id) {
        $user = User::find($id);
        //자신이 bookmark, favorite 한 것! 
        $bookmarks = $user->shops;
        $favorites = $user->products;
        foreach ($bookmarks as $bookmark) {
           $user->shops()->detach($bookmark->id);
        }
        foreach ($favorites as $favorite) {
            $user->products()->detach($favorite->id);
        }
        if( $user->apply != null ) { 
            $user->apply->delete();
        }
        
        if( $user->permission == 0 ) {
            $user->delete();
        } else if ( $user->permission == 1 ) {
            //shop_user delete 
            $shop = $user->shop;
            if( $shop != null ) {
                $bookmark_users = $shop->users()->get();
                foreach ($bookmark_users as $buser) {
                    $shop->users()->detach( $buser->id );
                }     
            
                //category_product, category delete
                //product_user, product delete
                $products = $shop->products()->get();
                foreach ($products as $product) {
                    $product = Product::find($product->id);
                    $categories = $product->categories()->get();
                    $favorite_users = $product->users()->get();
                    foreach ($categories as $category) {
                        $category->products()->detach( $product->id );
                    }
                    foreach ($favorite_users as $fuser) {
                        $product->users()->detach( $fuser->id );
                    }
                    $product->delete();
                }     
                //shop delete
                $shop->delete();
            }
            //user delete
            $user->delete();
        }
        return redirect('/admin/user');

    }

    public function userShow($id)
    {
        $user = User::find($id);
        return view('admin.user.edit')->with('user', $user);
    }

//banner
    public function bannerIndex() {
        $banners = Banner::get();
        return view('admin.banner.index')->with('banners', $banners);
    }

    // public function bannerFind($order) {
    //     $banner = Banner::find($order);
    //     $array = array( 'type' => $banner->type,
    //                     'image' => $banner->image, 
    //                     'title' => $banner->title, 
    //                     'content' => $banner->content,
    //                     'url' => $banner->url );
    //     echo json_encode($array);
    // }

    // public function bannerStore(Request $request) {
    //     $banner = new Banner($request->all());
    //     $banner_img = $request->file('image');
    //     $banner->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('banner',  $banner_img, 'public');
    //     $banner->save();
    //     return redirect('/admin/banner');
    // }

    public function bannerUpdate(Request $request, $id) {
        $banner = Banner::find($id);
        $banner_img = $request->file('image');
        $request = $request->except(['_method', '_token']);
        $banner->update($request);
        if( $banner_img != null ) {
            $banner->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('banner',  $banner_img, 'public');
            $banner->save();
        }
        
        return redirect('/admin/banner');
    }
}
