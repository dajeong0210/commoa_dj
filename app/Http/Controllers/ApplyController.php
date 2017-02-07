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
use Image;

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
/*
    public function thumbnail($image) {
        $size = getimagesize($image);
        $width = $size[0];
        $height = $size[1];
        if( $size[0] > 400 || $size[1] > 400 ) {
            $width = $size[0]/2;
            $height = $size[1]/2;
        }
        $resize_image = Image::make($image)->resize($width, $height);
        return $resize_image;      
    }
*/
    public function store(ApplyStoreRequest $request)
    {
        if( Auth::user()->apply()->count() != 0) {
            return view('apply.create');
        } else {  
            $apply = new Apply($request->all());
            $apply->user_id = Auth::user()->id;
            $business_docu = $request->file('business_docu');
            $apply->business_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply',  $business_docu, 'public');
            $sale_docu = $request->file('sale_docu');
            $apply->sale_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply',  $sale_docu, 'public');
            //thumbnail save
            // $size_b = getimagesize($business_docu);
            // $size_s = getimagesize($sale_docu);
            // $resize_b = Image::make($business_docu->getRealPath())->fit($size_b[0]/2, $size_b[1]/2);
            // $resize_s = Image::make($sale_docu->getRealPath())->fit($size_s[0]/2, $size_s[1]/2);
            // 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply-thumb',  $resize_b->__string(), 'public');
            // 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply-thumb',  $resize_s->__string(), 'public');
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
        $business_docu = $request->file('business_docu');
        $sale_docu = $request->file('sale_docu');
        $request = $request->except(['_method', '_token']);
        $apply->update($request);
        if( $business_docu != null ) {
            $apply->business_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply', $business_docu, 'public');
        }
        if( $sale_docu != null ) { 
            $apply->sale_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/'.Storage::put('apply', $sale_docu, 'public');
        }
        $apply->save();

        return redirect('apply/'.$apply->id.'/edit')->with('apply', $apply);
    }

    public function destroy($id)
    {
        $apply = Apply::find($id);
        if(Auth::user()->id == $apply->user_id)
            $apply->delete();
        return redirect('/');
    }
}
