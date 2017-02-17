@extends('layouts.layout')

@section('content')
<div class="page mypage">
    <div class="form login">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h2>비밀번호설정</h2>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="user_edit validate" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="user-group group">
                            <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">이메일(아이디)</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group one-layout form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">바꿀 비밀번호</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group one-layout form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">비밀번호 확인</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="submit" value="비밀번호 재설정" class="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
