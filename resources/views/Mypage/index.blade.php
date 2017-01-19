@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout')   
        <div class="my-wrap">
            <div class="user_profile">
                <h2>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>기본정보</span>
                    <a href="{{ url('user'). '/'.Auth::user()->id . '/edit' }}"><i class="fa fa-cog" aria-hidden="true"></i></a>
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
                    <span>FAVORITE</span>
                    <a href="{{ url('favorite') }}">전체보기</a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $favorites as $fav )
                        <li>
                            <a href="{{ url('product') . '/' . $fav->id }}">
                                <img src="{{ $fav->image }}" alt="">
                            </a>
                            <div class="detail-box">
                                <p>
                                    <a href="{{ url('product') . '/' . $fav->id }}">{{ $fav->name }}</a>
                                </p>
                                <p>
                                    <a href="{{ $fav->shop->url }}" target="_blank">{{ $fav->shop->name }}</a>
                                </p>
                            </div>
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
                        @foreach( $bookmarks as $bookmark )
                        <li>
                            <div class="thumbnail">
                                <a href="{{ $bookmark->url }}" target="_blank">
                                    <img src="{{ $bookmark->image }}" alt="">
                                </a>
                            </div>
                            <a href="{{ $bookmark->url }}">{{ $bookmark->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection