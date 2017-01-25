<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyStoreRequest;
use App\Http\Requests\ApplyUpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apply;
use App\User;
use Validator;

class ApplyController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('apply');
        if( !$request ){
            $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
            return view('apply.index')->with('applies', $applies);
        }else{
            if( $sortBy == '전체' ){
                $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
                return view('apply.index')->with('applies', $applies);
            }else if( $sortBy == '미승인' ){
                $applies = Apply::where('permission', 0)->orderBy('created_at', 'desc')->paginate(18);
                return view('apply.index')->with('applies', $applies);
            }else if( $sortBy == '승인' ){
                $applies = Apply::where('permission', 1)->orderBy('created_at', 'desc')->paginate(18);
                return view('apply.index')->with('applies', $applies);
            }else{
                $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
                return view('apply.index')->with('applies', $applies);
            }
        }
        

        $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
        return view('apply.index')->with('applies', $applies);
    }

    public function create()
    {
        if( Auth::user()->apply()->count() != 0) {
            $apply = Auth::user()->apply()->first();
            return redirect('apply/'.$apply->id.'/edit')->with('apply',$apply);
        } else {         
            return view('apply.create');
        }
    }

    public function store(ApplyStoreRequest $request)
    {
        if( Auth::user()->apply()->count() != 0) {
            return view('apply.create');
        } else { 
            $apply = new Apply;
            $path_b = $request->file('business_docu')->store('images');
            $path_s = $request->file('sale_docu')->store('images');
            $apply->user_email = $request->input('user_email');
            $apply->shop_name = $request->input('shop_name');
            $apply->shop_url = $request->input('shop_url');
            $apply->business_name = $request->input('business_name');
            $apply->business_ceo = $request->input('business_ceo');
            $apply->business_address = $request->input('business_address');
            $apply->business_no = $request->input('business_no');
            $apply->business_sale_no = $request->input('business_sale_no');
            $apply->business_docu = $path_b;
            $apply->sale_docu = $path_s;
            $apply->contact_name = $request->input('contact_name');
            $apply->contact_email = $request->input('contact_email');
            $apply->contact_mobile = $request->input('contact_mobile');
            $apply->contact_phone = $request->input('contact_phone');
            $apply->user_id = User::where('email', $request->input('user_email'))->first()->id;
            $apply->save();
            return redirect('/');
        } 
    }

    public function show($id)
    {
        $apply = Apply::find($id);
        return view('apply.show')->with('apply', $apply);
    }

    public function edit($id)
    {
        if( Auth::user()->apply()->first()->id != $id  ) { 
            return back();
        }
        $apply = Apply::find($id);
        return view('apply.edit')->with('apply', $apply);
    }

    public function update(ApplyUpdateRequest $request, $id)
    {
        $apply = Apply::find($id);
        if( $request->file('business_docu') != null ) { 
            $path_b = $request->file('business_docu')->store('images');
            $apply->business_docu = $path_b;
        } 
        if( $request->file('sale_docu') != null ) { 
            $path_s = $request->file('sale_docu')->store('images');
            $apply->sale_docu = $path_s;
        }
        $apply->user_email = $request->input('user_email');
        $apply->shop_name = $request->input('shop_name');
        $apply->shop_url = $request->input('shop_url');
        $apply->business_name = $request->input('business_name');
        $apply->business_ceo = $request->input('business_ceo');
        $apply->business_address = $request->input('business_address');
        $apply->business_no = $request->input('business_no');
        $apply->business_sale_no = $request->input('business_sale_no');
        $apply->contact_name = $request->input('contact_name');
        $apply->contact_email = $request->input('contact_email');
        $apply->contact_mobile = $request->input('contact_mobile');
        $apply->contact_phone = $request->input('contact_phone');
        $apply->user_id = User::where('email', $request->input('user_email'))->first()->id;
        $apply->save();
        return view('apply.edit')->with('apply', $apply);
    }

    public function destroy($id)
    {
        $apply = Apply::find($id);
        if(Auth::user()->id == $apply->user_id)
            $apply->delete();
        return redirect('/');
    }
}
