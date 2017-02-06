@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.adminMenu') 
        <div class="main-edit">
            <h2>메인배너수정</h2>
            <div class="select nth">
                <label for="main1">메인1</label>
                <input type="radio" id="main1" name="main" checked>
                <label for="main2">메인2</label>
                <input type="radio" id="main2" name="main">
                <label for="main3">메인3</label>
                <input type="radio" id="main3" name="main">
            </div>
            <div class="preview">
                <nav class="nav-bar">
                    <h1 class="logo">
                        <a href="#">
                            <img src="{{ url('/') . '/image/commoa_logo.png' }}" alt="컴모아"/>
                        </a>
                    </h1>
                    <ul class="nav-group">
                        <li>상품</li>
                        <li>쇼핑몰</li>
                        <li>{{ Auth::user()->name }} ▼ </li>
                    </ul>
                </nav>
                <div class="slider">
                    <nav class="nav-slider">
                        <a href="#" class="left" onclick="return false;">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="right" onclick="return false;">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </nav>
                    <ul class="slider auto">
                        @foreach( $banners as $banner )
                        <li class="{{ 'game_0' . $banner->order .' main' . $banner->order }}" style="{{ 'background:url(' . $banner->image . ') no-repeat; background-size:cover;' }}">
                            <div class="slider-cover" style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">
                                <span>{{ $banner->type }}</span>
                                <h3 style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">{!! nl2br( e($banner->title) ) !!}</h3>
                                <p>{!! nl2br( e($banner->content) ) !!}</p>
                                <a href="#" class="btn" onclick="return false;">바로가기</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <form method="POST" name="main-edit" action="{{ url('/admin/banner/1') }}" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="group">
                    <label>종류</label>
                    <div class="select type">
                        <label for="type1">인기상품</label>
                        <input type="radio" id="type1" name="type" value="인기상품" checked>
                        <label for="type2">이벤트</label>
                        <input type="radio" id="type2" name="type" value="이벤트">
                        <label for="type3">공지사항</label>
                        <input type="radio" id="type3" name="type" value="공지사항">
                    </div>
                </div>
                <div class="group">
                    <div class="form-group half-layout">
                        <label for="image" class="top-align">메인이미지</label>
                        <input type="file" name="image" class="main-image image">
                    </div>
                </div>
                <div class="group">
                    <div class="form-group half-layout">
                        <label for="title" class="top-align">메인타이틀</label>
                        <textarea name="title" rows="2"></textarea>
                    </div>
                </div>
                <div class="group">
                    <div class="form-group one-layout">
                        <label for="content" class="top-align">메인글</label>
                        <textarea name="content" rows="5"></textarea>
                    </div>
                </div>
                <div class="group">
                    <div class="form-group one-layout">
                        <label for="url" class="top-align">URL</label>
                        <input type="text" name="url"/>
                    </div>
                </div>
                <div class="align">
                    <div class="form-group one-layout">
                        <label for="left-align">왼쪽정렬</label>
                        <input type="radio" id="left-align" name="align" value="0">
                        <label for="right-align">오른쪽정렬</label>
                        <input type="radio" id="right-align" name="align" value="1">
                    </div>
                </div>
                <div class="group">
                    <a href="#" class="preview">미리보기</a>
                    <input type="submit" class="submit" value="수정">
                </div>
            </form>
        </div>
    </div>
@endsection