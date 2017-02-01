@extends('layouts.admin')

@section('content')
    <div class="page mypage admin">
        <div class="adminIndex half-layout">
            <h2>최신 업데이트된 상품</h2>
            <ul>
            @foreach( $products as $product )
                <li>
                    <a href="{{ url('product') .'/'. $product->id }}">{{ $product->name }}</a>
                    <span>{{ $product->shop->name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="adminIndex">
            <h2>최신 업데이트된 쇼핑몰</h2>
            <ul>
            @foreach( $shops as $shop )
                <li>
                    <a href="{{ url('shop') .'/'. $shop->id }}">{{ $shop->name }}</a>
                    <span>{{ $shop->user->name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="adminIndex">
            <h2>입점신청현황</h2>
            <ul>
            @foreach( $applies as $apply )
                <li>
                    <a href="{{ url('apply') .'/'. $apply->id }}">{{ $apply->shop_name }}</a>
                    <span>{{ $apply->contact_name }}</span>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection