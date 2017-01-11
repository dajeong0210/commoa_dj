<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apply;
use Validator;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applies = Apply::orderBy('id', 'desc')->paginate(20);
        
        return view('apply.index')->with('applies', $applies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apply.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apply = new Apply;
        $validator = Validator::make($request->all(), [
            'user_email' => 'email',
            'shop_name' => 'required',
            'shop_url' => 'required',
            'business_name' => 'required',
            'business_ceo' => 'required',
            'business_address' => 'required',
            'business_no' => 'required|numeric',
            'business_sale_no' => 'required',
            'business_docu' => 'required',
            'sale_docu' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_mobile' => 'required|numeric',
            'contact_phone' => 'required',
            'agree_01' => 'accepted',
            'agree_02' => 'accepted',
        ]);

        $validator_phone = Validator::make($request->all(), [
            'contact_phone' => 'numeric',
        ]);

        if($validator->fails()){
            return redirect('apply/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $apply->user_email = $request->input('user_email');
        $apply->shop_name = $request->input('shop_name');
        $apply->shop_url = $request->input('shop_url');
        $apply->business_name = $request->input('business_name');
        $apply->business_ceo = $request->input('business_ceo');
        $apply->business_address = $request->input('business_address');
        $apply->business_no = $request->input('business_no');
        $apply->business_sale_no = $request->input('business_sale_no');
        $apply->business_docu = $request->input('business_docu');
        $apply->sale_docu = $request->input('sale_docu');
        $apply->contact_name = $request->input('contact_name');
        $apply->contact_email = $request->input('contact_email');
        $apply->contact_mobile = $request->input('contact_mobile');
        
        if($validator_phone->fails()){
            $apply->contact_phone = NULL;
        } else {
            $apply->contact_phone = $request->input('contact_phone');
        }
        
        $apply->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apply = Apply::find($id);

        return view('apply.show')->with('apply', $apply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apply = Apply::find($id);

        return view('apply.edit')->with('apply', $apply);
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
        $validator = Validator::make($request->all(), [

        ]);

        if($validator->fails()){
            return redirect('community/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $apply = Apply::find($id);
        $apply->user_email = $request->input('user_email');
        $apply->shop_name = $request->input('shop_name');
        $apply->shop_url = $request->input('shop_url');
        $apply->business_name = $request->input('business_name');
        $apply->business_ceo = $request->input('business_ceo');
        $apply->business_address = $request->input('business_address');
        $apply->business_no = $request->input('business_no');
        $apply->business_sale_no = $request->input('business_sale_no');
        $apply->business_docu = $request->input('business_docu');
        $apply->sale_docu = $request->input('sale_docu');
        $apply->contact_name = $request->input('contact_name');
        $apply->contact_email = $request->input('contact_email');
        $apply->contact_mobile = $request->input('contact_mobile');
        $apply->contact_phone = $request->input('contact_phone');
        $apply->save();

        return redirect('main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apply = Apply::find($id);

        if(Auth::email() == $apply->user_email)
            $apply->delete();

        return redirect('main');
    }
}
