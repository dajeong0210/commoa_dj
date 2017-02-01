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

        public function rindex() {
            return view('admin.recommend');
        }
        public function recommend($id) {
            $product = Product::find($id); 
            $product->recommend = 1; 
            $product->save();
        }
    }

//Product
//Shop