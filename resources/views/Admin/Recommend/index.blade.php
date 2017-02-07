@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.adminMenu') 
        <div class="main-edit">
            <h2>추천상품편집</h2>
            <div class="preview recommend">
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
                <div class="recommend-list">
                    <ul>
                        @foreach($recommends as $recommend)
                        <li>
                            <a href="#" onclick="javascript_:window.open('popup/{{$recommend->recommend}}','pop', 'menubar=no,status=no,scrollbars=no,resizable=no ,width=500,height=500,top=50,left=50');">
                            </a>
                            <div class="thumbnail">
                                <img id="recommend{{$recommend->recommend}}" src="{{ $recommend->image }}">
                            </div>
                            <p id="prodName{{$recommend->recommend}}">{{ $recommend->name }}</p>
                            <p id="shopName{{$recommend->recommend}}">{{ $recommend->shop->name }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mybutton group">
                <a href="#" class="recommend rcm-submit">수정</a>
            </div>
            <form name="newRecommend" method="POST" action="/admin/recommend/modify">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <input type="hidden" name="productId1" id="productId1">
                <input type="hidden" name="productId2" id="productId2">
                <input type="hidden" name="productId3" id="productId3">
                <input type="hidden" name="productId4" id="productId4">
            </form>
        </div>
    </div>
@endsection