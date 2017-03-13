@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form myinfo">
            <h2>회원탈퇴하기</h2>
            <form class="user_edit validate" name="user-delete" method="POST" action="{{ url('myinfo') . '/' . Auth::user()->id }}">
            {{ method_field('delete') }}
            {{ csrf_field() }}
                <div class="user-group group">
                    <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                        <label for="user_email">이메일(아이디)</label>
                        <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                        @if( $errors->has('user_email') )
                            <label class="error">{{ $errors->first('user_email') }}</label>
                        @endif
                    </div>
                    <div class="form-group one-layout form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                        <label for="old_password">전 비밀번호</label>
                        <input type="password" name="old_password" class="input old_password required" value="" required/>
                        @if( Session::has('msg') )
                            <label class="error">{{ Session::get('msg') }}</label>
                        @endif
                    </div>
                </div>
                <div class="group">
                    <input type="submit" value="탈퇴하기" class="submit delete user-delete"/>
                </div>
            </form>
        </div>
    </div>
@endsection