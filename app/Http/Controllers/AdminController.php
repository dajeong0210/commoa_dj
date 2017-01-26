<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Apply;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::find( Auth::user()->id );
        $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
        return view('Admin.index')->with('applies', $applies)->with('user', $user);
    }

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

    public function cpuCreate(Request $request) {
        $cpu->create($request); 
        return redirect('/admin/cpu-vga');
    }

    public function cpuUpdate(Request $request, $id) {
        $cpu = Cpu::find($id);
        $cpu->update($request->all());
        return redirect('/admin/cpu-vga');
    }

    public function cpuDelete($id) {
        $cpu = Cpu::find($id);
        $cpu->delete();
        return redirect('/admin/cpu-vga');
    }

    public function vgaCreate(Request $request) {
        $vga->create($request); 
        return redirect('/admin/cpu-vga');
    }

    public function vgaUpdate(Request $request, $id) {
        $vga = Vga::find($id);
        $vga->update($request->all());
        return redirect('/admin/cpu-vga');
    }

    public function vgaDelete($id) {
        $vga = Vga::find($id);
        $vga->delete();
        return redirect('/admin/cpu-vga');
    }
    
}
