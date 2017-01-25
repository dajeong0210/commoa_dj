@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form">
            <h2>회원정보수정</h2>
            <form class="user_edit validate" method="POST" action="{{ url('/myinfo') . '/' . Auth::user()->id }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="user-group group">
                <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                    <label for="user_email">이메일(아이디)</label>
                    <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                    @if( $errors->has('user_email') )
                        <label class="error">{{ $errors->first('user_email') }}</label>
                    @endif
                </div>
                <div class="one-layout form-group form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                    <label for="user_name">이름</label>
                    <input type="text" name="user_name" class="input user_name required" value="{{ Auth::user()->name }}" required/>
                    @if( $errors->has('user_name') )
                        <label class="error">{{ $errors->first('user_name') }}</label>
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
                <div class="form-group half-layout form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="new_password">바꿀 비밀번호</label>
                    <input id="password" type="password" name="password" class="input password" value=""/>
                    @if( $errors->has('password') )
                        <label class="error">{{ $errors->first('password') }}</label>
                    @endif
                </div>
                <div class="form-group half-layout form-group{{ $errors->has('password-confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">비밀번호 재입력</label>
                    <input id="password-confirm" type="password" name="password_confirmation" class="input password-confirm" value=""/>
                </div>
                <input type="submit" value="수정하기" class="submit"/>
            </div>
            </form>
        </div>
    </div>
@endsection