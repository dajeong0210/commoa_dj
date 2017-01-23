@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form">
            <h2>Shop정보수정</h2>
            <form class="ShopApply" method="POST" action="{{ url('/shop') . '/' . $shop->id }}" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="user-group group">
                    <h3>계정 정보 입력</h3>
                    <div class="form-group">
                        <label for="user_email">이메일(아이디)</label>
                        <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" disabled/>
                    </div>
                </div>
                <div class="shop-group group">
                    <h3>Shop 정보 입력</h3>
                    <div class="form-group half-layout">
                        <label for="shop_name">Shop 이름</label>
                        <input type="text" name="shop_name" class="input shop_name required" value="{{ $shop->name }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="shop_url">Shop URL</label>
                        <input type="text" name="shop_url" class="input shop_url required" value="{{ $shop->url }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="image">Shop 로고</label>
                        @if( $shop->image == NULL )
                        @else
                        <div class="image-logo">
                            <img src="{{ $shop->image }}" alt=""/>
                        </div>
                        @endif
                        <input type="file" name="image" class="input image shop_image"/>
                    </div>
                </div>
                <div class="contact-group group">
                    <h3>쇼핑몰 담당자 정보</h3>
                    <div class="form-group half-layout">
                        <label for="contact_name">이름</label>
                        <input type="text" name="contact_name" class="input contact_name required" value="{{ $shop->contact_name }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_email">이메일</label>
                        <input type="email" name="contact_email" class="input contact_email required" value="{{ $shop->contact_email}}" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_phone">전화</label>
                        <input type="phone" name="contact_phone" class="input contact_phone" value="{{ $shop->contact_phone }}" placeholder="'-'를 제외한 숫자만 입력해주세요."/>
                    </div>
                    <div class="form-group">
                        <label for="business_address">주소</label>
                        <input type="address" name="business_address" class="input business_address required" value="{{ $shop->contact_address }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="수정하기" class="submit"/>
                </div>
            </form>
        </div>
    </div>
@endsection