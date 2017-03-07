<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CpuRequest;
use App\Http\Requests\VgaRequest;
use App\Http\Requests\VgaCreateRequest;
use App\Http\Requests\CpuCreateRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Apply;
use App\User;
use App\Product;
use App\Shop;
use App\Cpu;
use App\Vga;
use App\Banner;
use App\Advertisement;

class AdminController extends Controller
{	
	public function index() {
		$recommends = Product::where('recommend', '<>', 0)->orderBy('recommend', 'asc')->get();
		$majorGames = Category::where('sort', '=', 1)->get();
		$products = Product::orderBy('updated_at', 'desc')->limit(5)->get();		
		$shops = Shop::orderBy('updated_at', 'desc')->limit(5)->get();
		$applies = Apply::orderBy('updated_at', 'desc')->where('permission', 0)->limit(10)->get();
		
		return view('Admin.index')->with('products', $products)->with('shops', $shops)
			->with('applies', $applies)->with('recommends', $recommends)->with('majorGames', $majorGames);
	}
	
//Category
	public function category() {	
		$categories = Category::orderBy('name', 'asc')->get();		
		$cpus = Cpu::get();
		$vgas = Vga::get();
		return view('Admin.Category.edit')->with('categories', $categories)->with('cpus', $cpus)->with('vgas', $vgas);
	}
	
	public function categoryCreate(CategoryRequest $request) {
		$category = new Category; 
		$category->name = $request->input('category_name');
		$color = $request->input('category_color');
		$image = $request->file('category_image');
		$sort = $request->input('category_sort');
		$min_cpus = $request->input('min_cpu'); 
		$min_vgas = $request->input('min_vga'); 
		$recommend_cpus = $request->input('recommend_cpu'); 
		$recommend_vgas = $request->input('recommend_vga'); 
		$min_memory = $request->input('min_memory');
		$storage = $request->input('storage');
		$recommend_memory = $request->input('recommend_memory');

		if( $color != null ) {
			$category->color = $color;
		} else {
			$category->color = null; 
		}
		if( $min_memory != null ) {
			$category->min_memory = $min_memory;
		} else {
			$category->min_memory = null; 
		}

		if( $storage != null ) {
			$category->storage = $storage;
		} else {
			$category->storage = null; 
		}

		if( $recommend_memory != null ) {
			$category->recommend_memory = $recommend_memory;
		} else {
			$category->recommend_memory = null; 
		}
		
		if( $min_cpus != null ) {
			$category->min_cpu = $min_cpus;
		} else {
			$category->min_cpu = null;
		}

		if( $min_vgas != null ) {
			$category->min_vga = $min_vgas;
		} else {
			$category->min_vga = null;
		}

		if( $recommend_cpus != null ) {
			$category->recommend_cpu = $recommend_cpus;
		} else {
			$category->recommend_cpu = null;
		}

		if( $recommend_vgas != null ) {
			$category->recommend_vga = $recommend_vgas;
		} else {
			$category->recommend_vga = null;
		}
		
		if( $sort != null ) {
			$category->sort = 1;
		} else {
			$category->sort = null;
		}
		if( $image != null ) {
			$category->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('category',  $image, 'public');
		} else {
			$category->image = null;
		}
		$category->save();
		
		return redirect('/admin/category');
	}

	public function categoryUpdate(CategoryRequest $request, $id) {
		$category = Category::find($id);
		$category->name = $request->input('category_name');
		$color = $request->input('category_color');
		$sort = $request->input('category_sort');
		$image = $request->file('category_image');
		$min_cpus = $request->input('min_cpu'); 
		$min_vgas = $request->input('min_vga'); 
		$recommend_cpus = $request->input('recommend_cpu'); 
		$recommend_vgas = $request->input('recommend_vga');
		$min_memory = $request->input('min_memory');
		$storage = $request->input('storage');
		$recommend_memory = $request->input('recommend_memory');

		if( $color != null ) {
			$category->color = $color;
		} else {
			$category->color = null; 
		}

		if( $min_memory != null ) {
			$category->min_memory = $min_memory;
		} else {
			$category->min_memory = null; 
		}

		if( $storage != null ) {
			$category->storage = $storage;
		} else {
			$category->storage = null; 
		}

		if( $recommend_memory != null ) {
			$category->recommend_memory = $recommend_memory;
		} else {
			$category->recommend_memory = null; 
		}

		if ( $min_cpus != null ) { 
			$category->min_cpu = $min_cpus;
		} else { 
			$category->min_cpu = null;
		}

		if ( $min_vgas != null ) { 
			$category->min_vga = $min_vgas;
		} else { 
			$category->min_vga = null; 
		}

		if ( $recommend_cpus != null ) { 
			$category->recommend_cpu = $recommend_cpus;
		} else { 
			$category->recommend_cpu = null;
		}

		if ( $recommend_vgas != null ) {  
			$category->recommend_vga = $recommend_vgas;
		} else { 
			$category->recommend_vga = null; 
		}

		if( $category->sort != '0') {
			if( $sort != null ) {
				$category->sort = 1;	
			} else {
				$category->sort = null;
			}
		}
		
		if( $image != null ) {
			$category->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('category',  $image, 'public');
		}
		$category->save();
		
		return redirect('/admin/category');
	}

	public function categoryDelete($id) {
		$category = Category::find($id);
		$category->delete();
		return redirect('/admin/category');
	}

	public function categoryCnt($id) {
		$category = Category::find($id);
		$productCnt = $category->products()->count();
		echo $productCnt;
	}

	public function findCategory($id) {
		$category = Category::find($id);
	 
		$array = array( 'name' => $category->name, 
						'image' => $category->image,
						'sort' => $category->sort,
						'color' => $category->color,
						'min_cpu' => $category->min_cpu,
						'min_vga' => $category->min_vga,
						'min_memory' => $category->min_memory,
						'storage' => $category->storage,
						'recommend_cpu' => $category->recommend_cpu,
						'recommend_vga' => $category->recommend_vga,
						'recommend_memory' => $category->recommend_memory );
		
		echo json_encode($array);
	}
	
//cpu-vga
	public function cpuvga() {
		$cpus = Cpu::get();
		$vgas = Vga::get();
		$products = Product::get();
		return view('Admin.cpu-vga')->with('cpus', $cpus)->with('vgas', $vgas)->with('products', $products);
	}
	
    //cpu	
	public function cpuCreate(CpuCreateRequest $request) {
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
	
//Recommend
	public function recommendIndex() {
		$recommends = Product::whereIn('recommend', [1, 2, 3, 4])->orderBy('recommend', 'asc')->get();
		$recommend_arr = array();
		for( $i=0; $i<$recommends->count(); $i++ ) {
			array_push($recommend_arr, $recommends[$i]->recommend);
		}
		return view('Admin.Recommend.index')->with('recommends', $recommends)->with('recommend_arr', $recommend_arr);
	}
	
	public function recommendPopup(Request $request, $id) {
		$products = Product::where('recommend', 0);
		$search = $request->input('search');
		$product_sort = $request->input('product-sort');
		$products = $products->where('name', 'LIKE', '%'.$search.'%');

		if( $product_sort == '' ) {
			$products = $products->orderBy('updated_at', 'desc')->paginate(6);
		}
		else {
			if ( $product_sort == 'rankBy' ) {
				$products = $products->orderBy('views', 'desc')->paginate(6);
			}
			else if ( $product_sort == 'priceBydesc' ) {
				$products = $products->orderBy('price', 'desc')->paginate(6);
			}
			else if ( $product_sort == 'priceByasc' ) {
				$products = $products->orderBy('price', 'asc')->paginate(6);
			}
			else if ( $product_sort == 'nameBy' ) {
				$products = $products->orderBy('name', 'asc')->paginate(6);
			}
			else {
				$products = $products->orderBy('updated_at', 'desc')->paginate(6);
			}
		}
		
        return view('Admin.Recommend.popup')->with('products', $products)->with('search', $search)->with('id', $id);
	}
	
	public function recommendUpdate(Request $request) {
		
		for( $i=1; $i<=4; $i++ ) {
			$id = $request->input('productId'.$i);
			if( $id != '' ) {
				$before = Product::where('recommend', $i)->first();
				if( $before != null ) {
					$before->recommend = 0;
					$before->save();
				}
				$product = Product::find($id);
				$product->recommend = $i;
				$product->save();
			}
		}
		
		return redirect('/admin/recommend');
	}

	public function recommendDelete($id) {
		$product = Product::where('recommend', $id)->first();
		$product->recommend = 0;
		$product->save();

		return redirect('/admin/recommend');
	}
		
	//User
	public function userIndex(Request $request) {

		$user_sort = $request->input('user-sort');
		$search = $request->input('search');
		if( $search != '' ) {	
			$users = User::where('name', 'LIKE', '%'.$search.'%');		
		}
		else {		
			$users = User::whereNotNull('name');		
		}		
		if( $user_sort == '' ) {	
			$users = $users->orderBy('id', 'desc')->paginate(20);		
		}
		else if( $user_sort == '일반회원' ) {	
			$users = $users->where('permission', 0)->orderBy('id', 'desc')->paginate(20);	
		}
		else if( $user_sort == '쇼핑몰회원' ) {	
			$users = $users->where('permission', 1)->orderBy('id', 'desc')->paginate(20);	
		}
		
		return view('Admin.User.index')->with('users', $users)->with('search', $search);
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

		if( Auth::user()->permission == 2 ) {
			return redirect('/admin/user');
		} else {
			return redirect('/');
		}
		
	}
	
	public function userShow($id) {
		$user = User::find($id);
		return view('Admin.User.edit')->with('user', $user);
	}
	
	//banner
	public function bannerIndex() {
		$banners = Banner::get();
		return view('Admin.Banner.index')->with('banners', $banners);
	}
	
	public function bannerUpdate(Request $request, $id) {
		$banner = Banner::find($id);
		$banner_img = $request->file('image');
		$show = $request->input('btn_check');

		if( $show != null ) {
			$banner->show = $show;
		} else {
			$banner->show = 0;
		}

		$request = $request->except(['_method', '_token']);
		$banner->update($request);
		
		if( $banner_img != null ) {
			$banner->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('banner',  $banner_img, 'public');
			$banner->save();
		}
		return redirect('/admin/banner');
	}

//Advertisement
	public function advertisementIndex() {
		$advertisements = Advertisement::orderBy('id', 'asc')->limit(9)->get();

		return view('Admin.Advertisement.index')->with('advertisements', $advertisements);
	}

	public function advertisementUpdate(Request $request) {
		for($i=1; $i<10; $i++) {
			$advertisement = Advertisement::find($i);
			$advertisement_img = $request->file('image'.$i);
			if( $advertisement_img != null ) {
				$advertisement->image = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('advertisement',  $advertisement_img, 'public');
			} 
			$advertisement->url = $request->input('url'.$i);
			$advertisement->save();	
		}
		return redirect('/admin/advertisement');
	}
}