@extends('layouts.layout')

@section('content')
<div class="page mypage">
    <div class="form login">
        <h2>회원가입</h2>
        <form class="register-form validate" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="user-group group">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">이름</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">이메일 (ID)</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">비밀번호</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">비밀번호 확인</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="가입하기"/>                        
                </div>
                <div class="link-group">
                <a class="link" href="{{ url('/login') }}">
                    로그인
                </a>         
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
