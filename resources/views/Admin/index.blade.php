@extends('layouts.admin')

@section('content')
    <div class="page mypage admin">
        <div class="adminIndex one-layout">
            <h2>메인추천상품<a href="{{ url('admin/recommend') }}">+편집하기</a></h2>
            <ul>
            @foreach( $recommends as $product )
                <li>
                    <p>{{ $product->recommend }} . <a href="{{ url('product') .'/'. $product->id }}">{{ $product->name }}</a></p>
                    <span>{{ $product->shop->name }}</span>
                </li>
            @endforeach
            @if( $recommends->count() !=4 )
                <li class="warning"><p class="warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>메인페이지에서 추천상품은 4개까지만 나타납니다. 추천상품을 4개로 조정해주세요.</p></li>
            @endif
            </ul>
        </div>
        <div class="adminIndex one-layout">
            <h2>추천게임<a href="{{ url('admin/category') }}">+편집하기</a></h2>
            <ul>
            @foreach( $majorGames as $key=>$category )
                <li>
                    <p>{{ $key+1 }} . <a href="{{ url('category') .'/'. $category->name }}">{{ $category->name }}</a></p>
                </li>
            @endforeach
            @if( $majorGames->count() !=4 )
                <li class="warning">
                    <p class="warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>상품페이지에서 카테고리의 이미지는 4개까지만 나타납니다. 이미지 표시된 카테고리를 4개로 조정해주세요. 
                    <a href="{{ url('admin/category') }}">[자세히보기]</a>
                    </p>
                </li>
            @endif
            </ul>
        </div>
        <div class="adminIndex half-layout">
            <h2>최신 업데이트된 상품<a href="{{ url('admin/product') }}">+전체보기</a></h2>
            <ul>
            @foreach( $products as $product )
                <li>
                    <p><a href="{{ url('product') .'/'. $product->id }}">{{ $product->name }}</a></p>
                    <span>{{ $product->shop->name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="adminIndex">
            <h2>최신 업데이트된 쇼핑몰<a href="{{ url('admin/shop') }}">+전체보기</a></h2>
            <ul>
            @foreach( $shops as $shop )
                <li>
                    <p><a href="{{ url('shop') .'/'. $shop->id }}">{{ $shop->name }}</a></p>
                    <span>{{ $shop->user->name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="adminIndex one-layout">
            <h2>입점신청현황<a href="{{ url('apply') }}">+전체보기</a></h2>
            <ul>
            @foreach( $applies as $apply )
                <li>
                    <p><a href="{{ url('apply') .'/'. $apply->id }}">{{ $apply->shop_name }}</a></p>
                    <span>{{ $apply->contact_name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection