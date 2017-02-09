@extends('layouts.layout')

@section('content')
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
            <li class="{{ 'game_0' . $banner->order .' main' . $banner->order }}" style="{{ 'background:url(' . $banner->image . ') no-repeat center 0; background-size:cover;' }}">
                <div class="slider-cover" style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">
                    <span>{{ $banner->type }}</span>
                    <h2 style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">{!! nl2br( e($banner->title) ) !!}</h2>
                    <p>{!! nl2br( e($banner->content) ) !!}</p>
                    <a href="{{ $banner->url }}" class="btn" onclick="return false;">바로가기</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="mainPage">
        <ul>
            <li class="one-layouts">
                <h3>New Product</h3>
                <div class="thumbnail" style="background:url({{ $products->first()->image }}) center no-repeat; background-size:cover;">
                    <a href="{{ url('product').'/'.$products->first()->id }}">
                    </a>
                </div>
                <p>{{ $products->first()->name }}</p>
                <p>{{ $products->first()->shop->name }}</p>
            </li>    
            @foreach($recommends as $recommend)
            <li class="half-layouts">
                <a href="{{ url('product').'/'.$recommend->id }}">
                    <div class="thumbnail" style="background:url({{ $recommend->image }}) center no-repeat; background-size:cover;">
                    </div>
                </a>
                <p>{{ $recommend->name }}</p>
                <p>{{ $recommend->shop->name }}</p>
            </li>
            @endforeach   
        </ul>
    </div>
@endsection