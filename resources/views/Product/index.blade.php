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
                    <p class="prod_category">
                    @foreach( $product->categories as $category )
                        <a class="category category_{{ $category->id }}" href="{{ url('category') . '/' . $category->name }}">{{ $category->name }}</a>
                    @endforeach
                    </p>
                    <p class="prod-shop">{{ $product->shop->name }}</p>
                    <p class="prod-price">{{ $product->price }}원
                        @if( Auth::guest() )
                        @else
                        <span>
                            <a href="#" class="fav">
                                @if( $product->users()->get()->where('id', Auth::user()->id)->count() == 0 )
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <i class="fa fa-heart hidden" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-heart-o hidden" aria-hidden="true"></i>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                @endif
                            </a>
                        </span>
                        @endif
                        <span class="hidden">{{ $product->id }}</span>
                    </p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endsection