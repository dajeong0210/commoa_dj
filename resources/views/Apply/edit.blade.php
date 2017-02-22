
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
                    <div class="form-group one-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                        <label for="user_email">이메일(아이디)</label>
                        <input type="email" name="user_email" class="input user_email" value="{{ Auth::user()->email }}" readonly/>
                    @if( $errors->has('user_email') )
                        <label class="error">{{ $errors->first('user_email') }}</label>
                    @endif
                    </div>
                </div>
                <div class="shop-group group">
                    <h3>Shop 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                        <label for="shop_name">Shop 이름</label>
                        <input type="text" name="shop_name" class="input shop_name required" value="{{ $apply->shop_name }}"/>
                        @if( $errors->has('shop_name') )
                        <label class="error">{{ $errors->first('shop_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('shop_url') ? ' has-error' : '' }}">
                        <label for="shop_url">Shop URL</label>
                        <input type="text" name="shop_url" class="input shop_url required" value="{{ $apply->shop_url }}"/>
                        @if( $errors->has('shop_url') )
                        <label class="error">{{ $errors->first('shop_url') }}</label>
                        @endif
                    </div>
                </div>
            
                <div class="business-group group">
                    <h3>사업자 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                        <label for="business_name">상호(법인명)</label>
                        <input type="text" name="business_name" class="input business_name required" value="{{ $apply->business_name }}"/>
                        @if( $errors->has('business_name') )
                        <label class="error">{{ $errors->first('business_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_ceo') ? ' has-error' : '' }}">
                        <label for="business_ceo">대표자명</label>
                        <input type="text" name="business_ceo" class="input business_ceo required" value="{{ $apply->business_ceo }}"/>
                        @if( $errors->has('business_ceo') )
                        <label class="error">{{ $errors->first('business_ceo') }}</label>
                        @endif
                    </div>
                    <div class="form-group one-layout form-group{{ $errors->has('business_address') ? ' has-error' : '' }}">
                        <label for="business_address">사업장주소</label>
                        <input type="text" name="business_address" class="input business_address required" value="{{ $apply->business_address }}"/>
                        @if( $errors->has('business_address') )
                        <label class="error">{{ $errors->first('business_address') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_no') ? ' has-error' : '' }}">
                        <label for="business_no">사업자등록번호</label>
                        <input type="text" name="business_no" class="input business_no required digits" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->business_no }}"/>
                        @if( $errors->has('business_no') )
                        <label class="error">{{ $errors->first('business_no') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_sale_no') ? ' has-error' : '' }}">
                        <label for="business_sale_no">통신판매번호</label>
                        <input type="text" name="business_sale_no" class="input business_sale_no required" value="{{ $apply->business_sale_no }}"/>
                        @if( $errors->has('business_sale_no') )
                        <label class="error">{{ $errors->first('business_sale_no') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_docu') ? ' has-error' : '' }}">
                        <label for="business_docu">사업자등록증</label>
                        <input type="file" name="business_docu" class="input business_docu"/>
                        @if( $errors->has('business_docu') )
                        <label class="error">{{ $errors->first('business_docu') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('sale_docu') ? ' has-error' : '' }}">
                        <label for="sale_docu">통신판매업증</label>
                        <input type="file" name="sale_docu" class="input sale_docu"/>
                        @if( $errors->has('sale_docu') )
                        <label class="error">{{ $errors->first('sale_docu') }}</label>
                        @endif
                    </div>
                </div>
                <div class="contact-group group">
                    <h3>쇼핑몰 담당자 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                        <label for="contact_name">이름</label>
                        <input type="text" name="contact_name" class="input contact_name required" value="{{ $apply->contact_name }}"/>
                        @if( $errors->has('contact_name') )
                        <label class="error">{{ $errors->first('contact_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                        <label for="contact_email">이메일</label>
                        <input type="email" name="contact_email" class="input contact_email required" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!" value="{{ $apply->contact_email }}"/>
                        @if( $errors->has('contact_email') )
                        <label class="error">{{ $errors->first('contact_email') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_mobile">핸드폰</label>
                        <input type="phone" name="contact_mobile" class="input contact_mobile required" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->contact_mobile }}"/>
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                        <label for="contact_phone">전화</label>
                        <input type="phone" name="contact_phone" class="input contact_phone" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ $apply->contact_phone }}"/>
                        @if( $errors->has('contact_phone') )
                        <label class="error">{{ $errors->first('contact_phone) }}</label>
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
                    <form class="ShopApply delete" method="POST" action="{{ url('/apply') . '/' . $apply->id }}">   
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
