<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;


class InfoController extends Controller
{
    public function index()
    {
        $user = User::find( Auth::user()->id );
        return view('mypage.edit')->with('user', $user);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('myinfo/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::find($id);
        if( Hash::check( $request->input('old_password'), $user->password) ) {
            if( $request->input('password') == $request->input('password_confirmation')) {
                $user->name = $request->input('user_name');
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return redirect('/mypage');
            } else {
                //validation message!! 
                return redirect('/myinfo');
            }
        } else {
            //validation message!! 
            return redirect('/myinfo');
        }
    }

    public function destroy($id)
    {
        //
    }
}
