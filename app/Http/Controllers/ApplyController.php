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
            return view('Apply.index')->with('applies', $applies);
        }else{
            if( $sortBy == '전체' ){
                $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
                return view('Apply.index')->with('applies', $applies);
            }else if( $sortBy == '미승인' ){
                $applies = Apply::where('permission', 0)->orderBy('created_at', 'desc')->paginate(18);
                return view('Apply.index')->with('applies', $applies);
            }else if( $sortBy == '승인' ){
                $applies = Apply::where('permission', 1)->orderBy('created_at', 'desc')->paginate(18);
                return view('Apply.index')->with('applies', $applies);
            }else{
                $applies = Apply::orderBy('permission', 'asc')->orderBy('created_at', 'desc')->paginate(18);
                return view('Apply.index')->with('applies', $applies);
            }
        }
    }

    public function create()
    {
        if( Auth::user()->apply()->count() != 0) {
            $apply = Auth::user()->apply()->first();
            return redirect('apply/'.$apply->id.'/edit')->with('apply',$apply);
        } else {         
            return view('Apply.create');
        }
    }

    public function thumbnail($image, $filename) {
        $img = Image::make($image);
        //adroid mobile 480px
        /*
        if( $width * $height > 480 ) {
            $scale = sqrt( ($width * $height) / 480 );
            $width = $width / $scale;
            $height = $height / $scale;
        }
        */
        $width = $img->width();
        $height = $img->height();
        if( $width > 480 ) {
            $scale = $width / 480;
            $width = $width / $scale;
            $height = $height / $scale;
        }
        $mime = explode("/", $img->mime());
        $img = $img->resize($width, $height)->stream();  
        $directory = 'thumb/' . $filename;
        Storage::disk('s3')->put($directory, $img->__toString(), 'public');
    }

    public function store(ApplyStoreRequest $request)
    {
        if( Auth::user()->apply()->count() != 0) {
            return view('Apply.create');
        } else {  
            $apply = new Apply($request->all());
            $apply->user_id = Auth::user()->id;
            $business_docu = $request->file('business_docu');
            $store_business = Storage::put('apply',  $business_docu, 'public');
            $apply->business_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/' . $store_business;
            $store_business = explode("/", $store_business);
            $sale_docu = $request->file('sale_docu');
            $store_sale = Storage::put('apply',  $sale_docu, 'public');
            $apply->sale_docu = 'https://s3.ap-northeast-2.amazonaws.com/commoa/' . $store_sale;
            $store_sale = explode("/", $store_sale);
            //save thumbnail 
            // $this->thumbnail($business_docu, $store_business[1]);
            // $this->thumbnail($sale_docu, $store_sale[1]);
            $apply->save();
            return redirect('/');
        } 
    }

    public function show($id)
    {
        $apply = Apply::find($id);
        return view('Apply.show')->with('apply', $apply);
    }

    public function edit($id)
    {
        if( Auth::user()->apply()->first()->id != $id  ) { 
            return back();
        }
        $apply = Apply::find($id);
        return view('Apply.edit')->with('apply', $apply);
    }

    public function update(ApplyUpdateRequest $request, $id)
    {
        $apply = Apply::find($id);
        $this->authorize('update', $apply);
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
        $this->authorize('delete', $apply);
        $apply->delete();
        return redirect('/');
    }
}
