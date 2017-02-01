@extends('layouts.admin')

@section('content')
    <div class="page mypage admin">
        @include('layouts.adminMenu') 
        <div class="form">
            <h2>Shop정보수정</h2>
            <form class="ShopApply validate" method="POST" action="{{ url('/admin/shop') . '/' . $shop->id }}" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="user-group group">
                    <h3>계정 정보 입력</h3>
                    <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                        <label for="user_email">이메일(아이디)</label>
                        <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                        @if ($errors->has('user_email'))
                            <label class="error">{{ $errors->first('user_email') }}</label>
                        @endif
                    </div>
                </div>
                <div class="shop-group group">
                    <h3>Shop 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Shop 이름</label>
                        <input type="text" name="name" class="input name required" value="{{ $shop->name }}"/>
                        @if ($errors->has('name'))
                            <label class="error">{{ $errors->first('name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url">Shop URL</label>
                        <input type="text" name="url" class="input required" value="{{ $shop->url }}"/>
                        @if ($errors->has('url'))
                            <label class="error">{{ $errors->first('url') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout">
                        <label for="image">Shop 로고</label>
                        <div class="image-logo">
                        @if( $shop->image == NULL )
                        @else
                            <img src="{{ $shop->image }}" alt=""/>
                        @endif
                        </div>
                        <input type="file" name="image" class="input image shop_image"/>
                    </div>
                </div>
                <div class="contact-group group">
                    <h3>쇼핑몰 담당자 정보</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                        <label for="contact_name">이름</label>
                        <input type="text" name="contact_name" class="input contact_name required" value="{{ $shop->contact_name }}"/>
                        @if ($errors->has('contact_name'))
                            <label class="error">{{ $errors->first('contact_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group form-group{{ $errors->has('contact_email') ? 'has-error' : '' }} half-layout">
                        <label for="contact_email">이메일</label>
                        <input type="email" name="contact_email" class="input contact_email required" value="{{ $shop->contact_email}}" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!"/>
                        @if ($errors->has('contact_email'))
                            <label class="error">{{ $errors->first('contact_email') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                        <label for="contact_mobile">핸드폰</label>
                        <input type="phone" name="contact_mobile" class="input contact_mobile required" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $shop->contact_mobile }}"/>
                        @if ($errors->has('contact_mobile'))
                            <label class="error">{{ $errors->first('contact_mobile') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_phone">전화</label>
                        <input type="phone" name="contact_phone" class="input contact_phone" value="{{ $shop->contact_phone }}" placeholder="'-'를 제외한 숫자만 입력해주세요."/>
                    </div>
                    <div class="form-group one-layout form-group{{ $errors->has('contact_address') ? ' has-error' : '' }}">
                        <label for="contact_address">주소</label>
                        <input type="address" name="contact_address" class="input contact_address required" value="{{ $shop->contact_address }}"/>
                        @if ($errors->has('contact_address'))
                            <label class="error">{{ $errors->first('contact_address') }}</label>
                        @endif
                    </div>
                </div>
                <div class="group">
                    <div class="form-group one-layout button">
                        <input type="submit" value="수정" class="submit"/>
                    </div>
                </div>
            </form>
             <form class="ShopApply delete" method="POST" action="{{ url('/admin/shop') . '/' . $shop->id }}">   
            {{ method_field('delete') }}
            {{ csrf_field() }}
                <div class="group">
                    <div class="form-group one-layout button del">
                        <input type="submit" value="삭제" class="delete"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection