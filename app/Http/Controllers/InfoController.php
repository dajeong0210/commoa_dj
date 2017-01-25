<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
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

    public function update(UserUpdateRequest $request, $id)
    {
    
        $user = User::find($id);
        if( Hash::check( $request->input('old_password'), $user->password) ) {
            if( $request->input('password') != '' &&
                $request->input('password') == $request->input('password_confirmation')) {
                $user->name = $request->input('user_name');
                $user->password = bcrypt($request->input('password'));
                $user->save();
                return redirect('/mypage');
            } else if ( $request->input('password') == '' ) {
                $user->name = $request->input('user_name');
                $user->save();
                return redirect('/mypage');
            }
        } else {
            session()->flash('msg', "비밀번호가 일치하지 않습니다.");
            return back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
