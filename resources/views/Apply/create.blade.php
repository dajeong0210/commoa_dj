@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        <div class="form apply">
            <h2>입점신청</h2>
            <form class="ShopApply validate" method="POST" action="{{ url('/apply') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="user-group group">
                    <h3>계정 정보 입력</h3>
                    <div class="one-layout form-group form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
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
                        <input type="text" name="shop_name" class="input shop_name required" value="{{ old('shop_name') }}"/>
                        @if( $errors->has('shop_name') )
                        <label class="error">{{ $errors->first('shop_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('shop_url') ? ' has-error' : '' }}">
                        <label for="shop_url">Shop URL</label>
                        <input type="text" name="shop_url" class="input shop_url required" value="{{ old('shop_url') }}"/>
                        @if( $errors->has('shop_url') )
                        <label class="error">{{ $errors->first('shop_url') }}</label>
                        @endif
                    </div>
                </div>
                <div class="business-group group">
                    <h3>사업자 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                        <label for="business_name">상호(법인명)</label>
                        <input type="text" name="business_name" class="input business_name required" value="{{ old('business_name') }}"/>
                        @if( $errors->has('business_name') )
                        <label class="error">{{ $errors->first('business_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_ceo') ? ' has-error' : '' }}">
                        <label for="business_ceo">대표자명</label>
                        <input type="text" name="business_ceo" class="input business_ceo required" value="{{ old('business_ceo') }}"/>
                        @if( $errors->has('business_ceo') )
                        <label class="error">{{ $errors->first('business_ceo') }}</label>
                        @endif
                    </div>
                    <div class="form-group one-layout form-group{{ $errors->has('business_address') ? ' has-error' : '' }}">
                        <label for="business_address">사업장주소</label>
                        <input type="text" name="business_address" class="input business_address required" value="{{ old('business_address') }}"/>
                        @if( $errors->has('business_address') )
                        <label class="error">{{ $errors->first('business_address') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_no') ? ' has-error' : '' }}">
                        <label for="business_no">사업자등록번호</label>
                        <input type="text" name="business_no" class="input business_no required digits" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ old('business_no') }}"/>
                        @if( $errors->has('business_no') )
                        <label class="error">{{ $errors->first('business_no') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_sale_no') ? ' has-error' : '' }}">
                        <label for="business_sale_no">통신판매번호</label>
                        <input type="text" name="business_sale_no" class="input business_sale_no required" value="{{ old('business_sale_no') }}"/>
                        @if( $errors->has('business_sale_no') )
                        <label class="error">{{ $errors->first('business_sale_no') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('business_docu') ? ' has-error' : '' }}">
                        <label for="business_docu">사업자등록증</label>
                        <input type="file" name="business_docu" class="input business_docu required"/>
                        @if( $errors->has('business_docu') )
                        <label class="error">{{ $errors->first('business_docu') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('sale_docu') ? ' has-error' : '' }}">
                        <label for="sale_docu">통신판매업증</label>
                        <input type="file" name="sale_docu" class="input sale_docu required"/>
                        @if( $errors->has('sale_docu') )
                        <label class="error">{{ $errors->first('sale_docu') }}</label>
                        @endif
                    </div>
                </div>
                <div class="contact-group group">
                    <h3>쇼핑몰 담당자 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                        <label for="contact_name">이름</label>
                        <input type="text" name="contact_name" class="input contact_name required" value="{{ old('contact_name') }}"/>
                        @if( $errors->has('contact_name') )
                        <label class="error">{{ $errors->first('contact_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                        <label for="contact_email">이메일</label>
                        <input type="email" name="contact_email" class="input contact_email required" data-rule-required="true" data-rule-email="true" data-msg-email="이메일 형식이 옳지 않습니다!" value="{{ old('contact_email') }}"/>
                        @if( $errors->has('contact_email') )
                        <label class="error">{{ $errors->first('contact_email') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                        <label for="contact_mobile">핸드폰</label>
                        <input type="phone" name="contact_mobile" class="input contact_mobile required" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ old('contact_mobile') }}"/>
                        @if( $errors->has('contact_mobile') )
                        <label class="error">{{ $errors->first('contact_mobile') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout">
                        <label for="contact_phone">전화</label>
                        <input type="phone" name="contact_phone" class="input contact_phone" placeholder="'-'를 제외한 숫자만 입력해주세요." value="{{ old('contact_phone') }}"/>
                    </div>
                </div>
                <div class="notice-group group form-group{{ $errors->has('agree_01') || $errors->has('agree_02') ? ' has-error' : '' }}">
                    <ul>
                        <li>
                            <h3>서비스 이용약관<a href="#" onclick="return false;">∨</a></h3>
                            @if( $errors->has('agree_01') )
                            <label class="error">약관에 동의하셔야 합니다!</label>
                            @endif
                        </li>
                            <div class="slide">
                                <div class="notice notice_01"></div>
                                <div class="form-group agree">
                                    <label for="agree_01" class="agree">서비스 이용약관에 동의합니다</label>
                                    <input type="checkbox" name="agree_01" class="agree"/>
                                </div>
                            </div>
                        <li>
                            <h3>개인정보취급방침<a href="#" onclick="return false;">∨</a></h3>
                            @if( $errors->has('agree_02') )
                            <label class="error">약관에 동의하셔야 합니다!</label>
                            @endif
                        </li>
                            <div class="slide">     
                                <div class="notice notice_02"></div>
                                <div class="form-group agree">
                                    <label for="agree_02" class="agree">개인정보 취급방침에 동의합니다</label>
                                    <input type="checkbox" name="agree_02" class="agree"/> 
                                </div>
                            </div>
                        <li>
                            <h3>컴모아 입점 정책<a href="#" onclick="return false;">∨</a></h3>
                        </li>
                            <div class="slide">
                                <div class="notice policy"></div>
                            </div>
                        <li>
                            <h3>컴모아 입점 심사 기준<a href="#" onclick="return false;">∨</a></h3>
                        </li>
                            <div class="slide">
                                <div class="notice policy"></div>
                            </div>
                    </ul>
                </div>
                <div class="form-group">
                    <input type="submit" value="신청하기" class="submit"/>
                </div>
            </form>
        </div>
    </div>
@endsection