@extends('layouts.layout')

@section('content')
    <div class="page mypage admin">
        <nav class="tap-nav admin">
            <ul>
                <li class="{{ Request::segment(2) == 'user' ? 'active' : '' }}"><a href="{{ url('/admin/user') }}">유저관리</a></li>
                <li class="{{ Request::segment(2) == 'shop' ? 'active' : '' }}"><a href="{{ url('/admin/shop') }}">샵관리</a></li>
                <li class="{{ Request::segment(2) == 'product' ? 'active' : '' }}"><a href="{{ url('/admin/product') }}">상품관리</a></li>
                <li class="{{ Request::segment(1) == 'apply' ? 'active' : '' }}"><a href="{{ url('/apply') }}">입점승인</a></li>
            </ul>
        </nav>
        <div class="my-wrap">
            <div class="user_profile">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>기본정보</span>
                    <a href="{{ url('myinfo') }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </h2>
                <div class="detail">
                    <div class="thumbnail">
                    </div>
                    <p class="name">관리자모드</p>
                    <p>User : {{ $user->name }}</p>
                    <p style="text-decoration:underline"><a href="{{ url('mypage') }}">{{ $user->name }}의 마이페이지</a></p>
                </div>
            </div>
            <div class="fav-list">
                <h2>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span>입점신청리스트</span>
                    <a href="{{ url('apply') }}">전체보기</a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $applies as $apply )
                            <li>
                                <div class="detail-box">
                                    <h3>User</h3>
                                    <p>
                                        {{ $apply->user_email }}
                                    </p>
                                </div>
                                <div class="detail-box">
                                    <h3>Shop Name</h3>
                                    <p>
                                        {{ $apply->shop_name }}
                                    </p>
                                </div>
                                <div class="detail-box">
                                    <h3>Contact</h3>
                                    <p>
                                        {{ $apply->contact_mobile }}
                                    </p>
                                </div>
                                <a href="{{ url('apply') . '/' . $apply->id }}" class="apply-list">보기
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="book-list">
                <h2>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>BOOKMARK</span>
                    <a href="{{ url('bookmark') }}">전체보기</a>
                </h2>
                <div class="my-list">
                    <ul>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection