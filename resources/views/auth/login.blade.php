@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        <div class="form login">
            <h2>로그인</h2>
            <form class="login-form validate" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="user-group group">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">이메일(아이디)</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">비밀번호</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label for="remember" class="remember">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                 로그인 기억
                            </label>
                            <input type="checkbox" name="remember" class="hidden remember">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="로그인">
                </div>
            </form>
            <div class="link-group">
                <a class="link" href="{{ url('/register') }}">
                    회원가입
                </a>         
                <a class="link" href="{{ url('/password/reset') }}">
                    <i class="fa fa-question" aria-hidden="true"></i>
                    Forgot Your Password?
                </a>
            </div>
        </div>
    </div>
@endsection
