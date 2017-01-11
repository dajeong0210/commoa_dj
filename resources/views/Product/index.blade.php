@extends('layouts.layout')

@section('content')
    <div class="page product">
        <ul class="product-list">
            @foreach( $products as $product )
            <li>
                <a href="{{ $product->url }}">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                </a>
                <div class="detail-box">
                    <p>
                        <a class="prod-title" href="{{ $product->url }}"> {{ $product->name }} </a>
                    </p>
                    @foreach( $product->categories as $category )
                        {{ $category->name }}
                    @endforeach
                    <p class="prod-shop">{{ $product->shop->name }}</p>
                    <p class="prod-price">{{ $product->price }}<span>원</span></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endsection