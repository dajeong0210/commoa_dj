@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.mainEditMenu') 
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
                        @for( $i=1; $i<=4; $i++ )
                            @if( !in_array($i , $recommend_arr) )
                            <li>
                                <a href="#" onclick="javascript_:window.open('popup/{{$i}}','pop', 'menubar=no,status=no,scrollbars=no,resizable=no ,width=500,height=500,top=50,left=50');">
                                <span>+</span>
                                </a>
                                <div id="recommend{{$i}}" class="thumbnail">
                                </div>
                                <p id="prodName{{$i}}"></p>
                                <p id="shopName{{$i}}"></p>
                            </li>
                            @else
                            <li>
                                <a href="#" onclick="javascript_:window.open('popup/{{$i}}','pop', 'menubar=no,status=no,scrollbars=no,resizable=no ,width=500,height=500,top=50,left=50');">
                                <span>+</span>
                                </a>
                                <div id="recommend{{$i}}" class="thumbnail" style="background:url({{ $recommends->where('recommend', $i)->first()->image }}) center no-repeat; background-size:cover;">
                                </div>
                                <p id="prodName{{$i}}">{{ $recommends->where('recommend', $i)->first()->name }}</p>
                                <p id="shopName{{$i}}" class="shop">{{ $recommends->where('recommend', $i)->first()->shop->name }}</p>
                                <a class="delete rcm-delete" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <form name="recommend-del" method="POST" action="{{ url('/admin/recommend') . '/' . $i }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                </form>
                            </li>
                            @endif
                        @endfor
                    </ul>
                </div>
            </div>
            <form name="newRecommend" method="POST" action="/admin/recommend/modify">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <input type="hidden" name="productId1" id="productId1">
                <input type="hidden" name="productId2" id="productId2">
                <input type="hidden" name="productId3" id="productId3">
                <input type="hidden" name="productId4" id="productId4">
                <div class="mybutton group">
                    <input type="submit" class="modify submit" value="수정">
                </div>
            </form>
        </div>
    </div>
@endsection