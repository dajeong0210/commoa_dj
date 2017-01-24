
@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        <div class="form apply">
            <h2>입점신청</h2>
            <form class="ShopApply validate" method="POST" action="{{ url('/apply') . '/' . $apply->id }}" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="user-group group">
                    <h3>계정 정보 입력</h3>
                    <div class="form-group {{ $errors->has('user_email') ? 'warning' : '' }}">
                        <label for="user_email">이메일(아이디)</label>
                        <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                    @if( $errors->has('user_email') )
                        <label class="error">이미 등록된 이메일입니다!</label>
                    @endif
                    </div>
                </div>
                <div class="shop-group group">
                    <h3>Shop 정보 입력</h3>
                    <div class="form-group half-layout">
                        <label for="shop_name">Shop 이름</label>
                        <input type="text" name="shop_name" class="input shop_name required" value="{{ $apply->shop_name }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="shop_url">Shop URL</label>
                        <input type="text" name="shop_url" class="input shop_url required" value="{{ $apply->shop_url }}"/>
                    </div>
                </div>
            
                <div class="business-group group">
                    <h3>사업자 정보 입력</h3>
                    <div class="form-group half-layout">
                        <label for="business_name">상호(법인명)</label>
                        <input type="text" name="business_name" class="input business_name required" value="{{ $apply->business_name }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="business_ceo">대표자명</label>
                        <input type="text" name="business_ceo" class="input business_ceo required" value="{{ $apply->business_ceo }}"/>
                    </div>
                    <div class="form-group one-layout">
                        <label for="business_address">사업장주소</label>
                        <input type="text" name="business_address" class="input business_address required" value="{{ $apply->business_address }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="business_no">사업자등록번호</label>
                        <input type="text" name="business_no" class="input business_no required digits" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->business_no }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="business_sale_no">통신판매번호</label>
                        <input type="text" name="business_sale_no" class="input business_sale_no required" value="{{ $apply->business_sale_no }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="business_docu">사업자등록증</label>
                        <input type="file" name="business_docu" class="input business_docu"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="sale_docu">통신판매업증</label>
                        <input type="file" name="sale_docu" class="input sale_docu"/>
                    </div>
                </div>
                <div class="contact-group group">
                    <h3>쇼핑몰 담당자 정보 입력</h3>
                    <div class="form-group half-layout">
                        <label for="contact_name">이름</label>
                        <input type="text" name="contact_name" class="input contact_name required" value="{{ $apply->contact_name }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_email">이메일</label>
                        <input type="email" name="contact_email" class="input contact_email required" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!" value="{{ $apply->contact_email }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_mobile">핸드폰</label>
                        <input type="phone" name="contact_mobile" class="input contact_mobile required digits" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->contact_mobile }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_phone">전화</label>
                        <input type="phone" name="contact_phone" class="input contact_phone" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->contact_phone }}"/>
                    </div>
                </div>
                <div class="form-group half-layout">
                    <input type="submit" value="수정하기" class="submit"/>
                </div>
                <div class="form-group half-layout">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <input type="submit" value="삭제" class="delete"/>
                </div>
            </form>
        </div>
    </div>
@endsection
