@extends('layouts.layout')

@section('content')
    <div class="page mypage list">
        @include('layouts.myLayout')   
        <div class="my-wrap">
            <div class="user_profile">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>기본정보</span>
                    <a href="{{ url('myinfo') }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
                </h2>
                <div class="detail">
                    <div class="thumbnail"></div>
                    <p class="name">{{ $user->name }}</p>
                    <p>E-mail : {{ $user->email }}</p>
                    <p>가입일 : {{ $user->created_at }}</p>
                </div>
            </div>
            <div class="fav-list">
                <h2>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span>찜한상품</span>
                    <a href="{{ url('favorite') }}">전체보기</a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $favorites as $fav )
                        <li>
                            <a href="{{ url('product') . '/' . $fav->id }}">
                            </a>
                            <div class="image-cover">
                                <div class="img-box" style="background:url({{ $fav->image }}) center no-repeat; background-size:cover">
                                </div>
                                <div class="detail-box">
                                    <p>{{ $fav->name }}</p>
                                    <p>{{ $fav->shop->name }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="book-list">
                <h2>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>찜한쇼핑몰</span>
                    <a href="{{ url('bookmark') }}">전체보기</a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $bookmarks as $shop )
                            <li class="shop">
                                <div class="img-box shop" style="background:url({{ $shop->image }}) center no-repeat; background-size:auto 100%">
                                </div>
                                <div class="detail-box">
                                    <p class="shop-name"> {{ $shop->name }} </p>
                                    <a href="{{ $shop->url }}" target="_blank" class="shop-url">사이트로 이동</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection