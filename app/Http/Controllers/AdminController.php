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

    public function categoryUpdate(Request $request, $id) {
        $category = Category::find($id);
        $category->name = $request->input('category');
        $category->save();
        // $categories = Category::get();
        // foreach ($categories as $category) {
        //     $id = $category->id;
        //     $category->name = $request->input('category'.$id);
        //     $category->save();
        // }
        return redirect('/admin/category');
    }

    public function categoryDelete($c_id) {

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
