@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form">
            <h2>회원정보수정</h2>
            <form class="user_edit" method="POST" action="{{ url('/myinfo') . '/' . Auth::user()->id }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="user_email">이메일(아이디)</label>
                    <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" disabled/>
                </div>
                <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                    <label for="user_name">이름</label>
                    <input type="text" name="user_name" class="input user_name" value="{{ Auth::user()->name }}"/>
                </div>
                <div class="form-group">
                    <label for="old_password">전 비밀번호</label>
                    <input type="password" name="old_password" class="input old_password" value="" />
                </div>
                <div class="form-group half-layout{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="new_password">바꿀 비밀번호</label>
                    <input type="password" name="password" class="input password" value=""/>
                </div>
                <div class="form-group half-layout">
                    <label for="password-confirm">비밀번호 재입력</label>
                    <input type="password" name="password_confirmation" class="input password-confirm" value=""/>
                </div>
                <div class="form-group">
                    <input type="submit" value="수정하기" class="submit"/>
                </div>
            </form>
        </div>
    </div>
@endsection