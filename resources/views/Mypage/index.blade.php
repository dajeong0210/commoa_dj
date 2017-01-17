@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        <nav class="tap-nav">
            <ul>
                <li><a href="#">개인정보수정</a></li>
                <li><a href="#">북마크</a></li>
                <li><a href="#">찜한상품</a></li>
                @if( Auth::user()->permission == '1' )
                <li><a href="#">Shop정보수정</a></li>
                <li><a href="#">상품관리</a></li>
                @endif
            </ul>
        </nav>
        <div class="my-wrap">
            <div class="user_profile">
                <h2>
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
                    <span>FAVORITE</span>
                    <a href="{{ url('fav/user') . '/' . Auth::user()->id }}"></a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $user->products() as $fav )
                        <li>
                            <img src="{{ $fav->image }}" alt="">
                            <span>{{ $fav->name }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="book-list">
                <h2>
                    <span>BOOKMARK</span>
                    <a href="{{ url('fav/user') . '/' . Auth::user()->id }}"></a>
                </h2>
                <div class="my-list">
                    <ul>
                        @foreach( $user->shops() as $fav )
                        <li>
                            <img src="{{ $fav->image }}" alt="">
                            <span>{{ $fav->name }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection