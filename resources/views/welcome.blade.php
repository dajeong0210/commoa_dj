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
    <div class="page list hot-items">
        <h3><span>HOT PRODUCT</span></h3>
        <ul class="list-group slider recommend">
            @foreach( $products1 as $product )
            <li>
                <span class="badge recommend">추천!!</span>
                <a href="{{ url('/product') . '/' . $product->id }}">
                    <div class="img-box prod" style="background:url({{ $product->image }}); background-size:cover;">
                    </div>
                </a> 
                <div class="detail-box">
                    <a class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </a>
                    <ul class="prod_category">
                    @foreach( $product->categories as $category )
                        <li>
                        <a class="category category_{{ $category->id }}" href="{{ url('type') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    </ul>
                    <p class="prod-shop">{{ $product->shop->name }}</p>
                    <p class="prod-price">{{ number_format($product->price) }}원
                        @if( Auth::guest() )
                        @else
                        <span>
                            <a href="#" class="fav" onclick="return false;">
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
    <div class="back" style="background:url({{$banners[2]->image}}); background-attachment:fixed;">
        <p>test</p>
    </div>
    <div class="mainPage">
        <ul>
            <li class="one-layouts">
                <h3>New Product</h3>
                <div class="slider-wrap">
                    <div class="slider">
                    @foreach( $new_items as $key=>$new_item )
                        <div class="item item_0{{$key+1}}">
                            <div class="thumbnail" style="background:url({{ $new_item->image }}) center no-repeat; background-size:cover;">
                                <a href="{{ url('product').'/'.$new_item->id }}">
                                </a>
                            </div>
                            <p>{{ $new_item->name }}</p>
                            <p>{{ $new_item->shop->name }}</p>
                        </div>
                    @endforeach
                    </div>
                </div>
                <nav class="new_product">
                    <ul>
                        @foreach( $new_items as $key=>$new_item )
                            <li><a href="#" class="nav_newProduct {{ $key == 0 ? 'active' : '' }}"><i class="fa {{ $key == 0 ? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i></a></li>
                        @endforeach
                    </ul>
                </nav>
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