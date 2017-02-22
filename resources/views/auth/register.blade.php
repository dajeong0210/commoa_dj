@extends('layouts.layout')

@section('content')
<div class="page mypage">
    <div class="form login half-layout">
        <h2>이용약관 및 개인정보 취급방침</h2>
        <form class="agree-form validate" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="notice-group group form-group{{ $errors->has('agree_01') || $errors->has('agree_02') ? ' has-error' : '' }}">
                <ul>
                    <li>
                        <h3>서비스 이용약관<a href="#" onclick="return false;">∨</a></h3>
                        @if( $errors->has('agree_01') )
                        <label class="error">약관에 동의하셔야 합니다!</label>
                        @endif
                    </li>
                        <div class="slide fadein">
                            <div class="notice notice_01">
                                @include('layouts.document.document1')
                            </div>
                            <div class="form-group agree">
                                <label for="agree_01" class="agree">서비스 이용약관에 동의합니다</label>
                                <input type="checkbox" id="agree_01" name="agree_01" class="agree"/>
                            </div>
                        </div>
                    <li>
                        <h3>개인정보취급방침<a href="#" onclick="return false;">∨</a></h3>
                        @if( $errors->has('agree_02') )
                        <label class="error">약관에 동의하셔야 합니다!</label>
                        @endif
                    </li>
                        <div class="slide">     
                            <div class="notice notice_02">
                                @include('layouts.document.document2')
                            </div>
                            <div class="form-group agree">
                                <label for="agree_02" class="agree">개인정보 취급방침에 동의합니다</label>
                                <input type="checkbox" id="agree_02" name="agree_02" class="agree"/> 
                            </div>
                        </div>
                </ul>
            </div>
        </form>
    </div>
    <div class="form login half-layout">
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
                <input type="checkbox" name="agree_01" class="agree hidden"/> 
                <input type="checkbox" name="agree_02" class="agree hidden"/> 
                <input type="submit" class="btn btn-primary modify" value="이용약관 및 개인정보 취급방침에 동의해주세요." disabled/>
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
