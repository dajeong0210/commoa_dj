@extends('layouts.layout')

<!-- Main Content -->
@section('content')
    <div class="page mypage">
        <div class="form login">
            <h2>비밀번호찾기</h2>
            <div class="panel-body group">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="forgot-form validate" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">가입 이메일(ID)</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" value="임시 비밀번호 전송"/>
                    </div>
                </form>
            </div> 
        </div>
    </div>
@endsection
