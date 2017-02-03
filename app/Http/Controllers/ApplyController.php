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
// use Storage;

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

    public function store(ApplyStoreRequest $request)
    {
        if( Auth::user()->apply()->count() != 0) {
            return view('apply.create');
        } else {  
            // $request->merge(['business_docu' => $request->file('business_docu')->store('images')]);
            // $request->merge(['sale_docu' => $request->file('sale_docu')->store('images')]);
            $sale_docu = $request->file('sale_docu');
            $business_docu = $request->file('business_docu');
            $request->merge(['sale_docu' => 'https://s3.ap-northeast-2.amazonaws.com/commoa/apply/'.Storage::disk("s3")->put('apply', $sale_docu, 'public')]);
            $request->merge(['business_docu' => 'https://s3.ap-northeast-2.amazonaws.com/commoa/apply/'.Storage::disk("s3")->put('apply', $business_docu, 'public')]);
            $request = $request->except(['agree_01', 'agree_02']);
            Auth::user()->apply()->create($request);
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
        // $this->authorize('update', $apply);
        if( $request->file('business_docu') != null ) {
            // $request->merge(['business_docu' => $request->file('business_docu')->store('images')]);
            
            $business_docu = $request->file('business_docu');
            $request->merge(['business_docu' => 'https://s3.ap-northeast-2.amazonaws.com/commoa/apply/'.Storage::disk("s3")->put('apply', $business_docu, 'public')]);

            // $request->merge(['business_docu' => Storage::disk("s3")->put('apply', $request->file('business_docu'), 'public')]);
            

        }
        if( $request->file('sale_docu') != null ) { 
            // $request->merge(['sale_docu' => $request->file('sale_docu')->store('images')]);
            $sale_docu = $request->file('sale_docu');
            $request->merge(['sale_docu' => 'https://s3.ap-northeast-2.amazonaws.com/commoa/apply/'.Storage::disk("s3")->put('apply', $sale_docu, 'public')]);

        }
        $request = $request->except(['_method', '_token']);
        $apply->update($request);
       
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
