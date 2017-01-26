<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Apply;
use App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //추가된 카테고리가 존재할 때 
        //create
        if( $addCategory = $request->input('create') ) { 
            for( $i=0; $i<count($addCategory); $i++ ) { 
                $newCategory = new Category;
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
    public function store(Request $request)
    {
        //
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
