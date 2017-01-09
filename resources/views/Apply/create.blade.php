@extends('layouts.app')

@section('content')
    <div class="page shop-apply">
        <h1>입점 신청 페이지</h1>
        <form class="ShopApply" method="POST" action="{{ url('/apply') }}">
        {{ csrf_field() }}
            <div class="user-group group">
                <h2>계정 정보 입력</h2>
                <div class="form-group">
                    <label for="user_email">이메일(아이디)</label>
                    <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                </div>
            </div>
            <div class="shop-group group">
                <h2>Shop 정보 입력</h2>
                <div class="form-group half-layout">
                    <label for="shop_name">Shop 이름</label>
                    <input type="text" name="shop_name" class="input shop_name required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="shop_url">Shop URL</label>
                    <input type="text" name="shop_url" class="input shop_url required"/>
                </div>
            </div>
            <div class="business-group group">
                <h2>사업자 정보 입력</h2>
                <div class="form-group half-layout">
                    <label for="business_name">상호(법인명)</label>
                    <input type="text" name="business_name" class="input business_name required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="business_ceo">대표자명</label>
                    <input type="text" name="business_ceo" class="input business_ceo required"/>
                </div>
                <div class="form-group">
                    <label for="business_address">사업장주소</label>
                    <input type="address" name="business_address" class="input business_address required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="business_no">사업자등록번호</label>
                    <input type="text" name="business_no" class="input business_no required digits" placeholder="'-'를 제외한 숫자만 입력해주세요."/>
                </div>
                <div class="form-group half-layout">
                    <label for="business_sale_no">통신판매번호</label>
                    <input type="text" name="business_sale_no" class="input business_sale_no required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="business_docu">사업자등록증</label>
                    <input type="file" name="business_docu" class="input business_docu required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="sale_docu">통신판매업증</label>
                    <input type="file" name="sale_docu" class="input sale_docu required"/>
                </div>
            </div>
            <div class="contact-group group">
                <h2>쇼핑몰 담당자 정보 입력</h2>
                <div class="form-group half-layout">
                    <label for="contact_name">이름</label>
                    <input type="text" name="contact_name" class="input contact_name required"/>
                </div>
                <div class="form-group half-layout">
                    <label for="contact_email">이메일</label>
                    <input type="email" name="contact_email" class="input contact_email required" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!"/>
                </div>
                <div class="form-group half-layout">
                    <label for="contact_mobile">핸드폰</label>
                    <input type="phone" name="contact_mobile" class="input contact_mobile required digits" placeholder="'-'를 제외한 숫자만 입력해주세요."/>
                </div>
                <div class="form-group half-layout">
                    <label for="contact_phone">전화</label>
                    <input type="phone" name="contact_phone" class="input contact_phone" placeholder="'-'를 제외한 숫자만 입력해주세요."/>
                </div>
            </div>
            <div class="notice-group group">
                <h2>서비스 이용약관</h2>
                <div class="notice notice_01">
                </div>
                <div class="form-group agree">
                    <label for="agree_01" class="agree">서비스 이용약관에 동의합니다</label>
                    <input type="checkbox" name="agree_01" class="agree" required/>
                </div>
                <h2>개인정보취급방침</h2>
                <div class="notice notice_02">
                </div>
                <div class="form-group agree">
                    <label for="agree_02" class="agree">개인정보 취급방침에 동의합니다</label>
                    <input type="checkbox" name="agree_02" class="agree"  required/> 
                </div>
                <h2>컴모아 입점 정책</h2>
                <div class="notice notice_01">
                </div>
                <h2>컴모아 입점 심사 기준</h2>
                <div class="notice notice_01">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="신청하기" class="submit"/>
            </div>
        </form>
    </div>
@endsection