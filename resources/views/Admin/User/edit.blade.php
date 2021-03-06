@extends('layouts.admin')

@section('content')
    <div class="page mypage admin">
        @include('layouts.adminMenu') 
        <div class="form user-edit">
            <h2>회원정보</h2>
            <form class="user_edit validate" method="POST" action="{{ url('/admin/user') . '/' . $user->id }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="user-group group">
                <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                    <label for="user_email">이메일(아이디)</label>
                    <input type="email" name="user_email" class="input user_email" value="{{ $user->email }}" readonly/>
                    @if( $errors->has('user_email') )
                        <label class="error">{{ $errors->first('user_email') }}</label>
                    @endif
                </div>
                <div class="one-layout form-group form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                    <label for="user_name">이름</label>
                    <input type="text" name="user_name" class="input user_name required" value="{{ $user->name }}" required/>
                    @if( $errors->has('user_name') )
                        <label class="error">{{ $errors->first('user_name') }}</label>
                    @endif
                </div>
            </div>
            <div class="group">
                    <div class="form-group one-layout button">
                        <input type="submit" value="수정" class="submit modify"/>
                    </div>
                </div>
            </form>
            <div class="group">
                <div class="form-group one-layout button del">
                    <input type="submit" value="삭제" class="delete del-submit"/>
                    <form class="ShopApply delete" method="POST" action="{{ url('/admin/user') . '/' . $user->id }}">   
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    </form>
                </div>
            </div>
            @if( $user->permission == 1 )
                <div class="group permission">
                    <input type="submit" value="일반회원으로" class="permission"/>
                    <form class="ShopApply permission" method="POST" action="{{ url('/admin/permission') . '/' . $user->id }}">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection