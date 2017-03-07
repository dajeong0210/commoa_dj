@extends('layouts.layout')

@section('content')
    <div class="slider">
        <nav class="nav-slider left">
            <a href="#" class="left" onclick="return false;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </nav>
        <nav class="nav-slider right">
            <a href="#" class="right" onclick="return false;">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </nav>
        <ul class="slider auto">
            @if( $banners )
                @foreach( $banners as $banner )
                    <li class="{{ 'game_0' . $banner->order .' main' . $banner->order }}" style="{{ 'background:url(' . $banner->image . ') no-repeat center 0; background-size:cover;' }} {{ $banner->show == 1 ? 'cursor:pointer;' : '' }}" {{ $banner->show == 1 ? 'onclick=location.href=\'' . $banner->url . '\'' : '' }} >
                        <div class="slider-cover" style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">
                            <span class="{{ $banner->type == '없음' ? 'hidden' : ''  }}">{{ $banner->type }}</span>
                            <h2 style="{{ $banner->align == 1 ? 'text-align:right;' : 'text-align:left;' }}">{!! nl2br( e($banner->title) ) !!}</h2>
                            <p>{!! nl2br( e($banner->content) ) !!}</p>
                            <a href="{{ $banner->url }}" class="btn {{ $banner->show == 1 ? 'hidden' : '' }}">바로가기</a>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="page list hot-items">
        <h3><span>오늘의 추천 PC</span></h3>
        <ul class="list-group slider recommend">
            @if( $recommends )
                @foreach( $recommends as $product )
                    <li>
                        <span class="badge recommend">추천!!</span>
                        <a href="{{ url('/product') . '/' . $product->id }}">
                            <div class="img-box prod bdbt" style="background:url({{ $product->image }}); background-size:cover;">
                            </div>
                        </a> 
                        <div class="detail-box main">
                            <p class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </a>
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
            @endif
        </ul>
    </div>
    <div class="back">
        <div class="wrap" style="background:url({{$banners[2]->image}}) center no-repeat; background-size:cover; background-attachment:fixed;">
            <p>
            </p>
        </div>
    </div>
    <div class="mainPage">
        <ul class="list-group half-layouts">
            <li class="one-layouts">
                <div class="wrap">
                    <h3>핫한 상품</h3>
                    <div class="slider-wrap">
                        <div class="slider hot">
                        @foreach( $new_items as $key=>$new_item )
                            <div class="item hot item_0{{$key+1}}">
                                <div class="thumbnail" style="background:url({{ $new_item->image }}) center no-repeat; background-size:cover;">
                                    <a href="{{ url('product').'/'.$new_item->id }}">
                                    </a>
                                </div>
                                <div class="detail">
                                    <p>{{ $new_item->name }}</p>
                                    <p class="shop-name">{{ $new_item->shop->name }}</p>
                                    <p>{{ number_format($new_item->price) }}원</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <nav class="hot_product">
                        <ul>
                            @foreach( $new_items as $key=>$new_item )
                                @if( $key<4 )
                                <li><a href="#" class="nav_newProduct {{ $key == 0 ? 'active' : '' }}"><i class="fa {{ $key == 0 ? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </li>
            <li class="one-layouts">
                <div class="wrap">
                    <h3>신상 조립PC</h3>
                    <div class="slider-wrap">
                        <div class="slider new">
                        @foreach( $hot_items as $key=>$item )
                            <div class="item new item_0{{$key+1}}">
                                <div class="thumbnail" style="background:url({{ $item->image }}) center no-repeat; background-size:cover;">
                                    <a href="{{ url('product').'/'.$item->id }}">
                                    </a>
                                </div>
                                <div class="detail">
                                    <p>{{ $item->name }}</p>
                                    <p class="shop-name">{{ $item->shop->name }}</p>
                                    <p>{{ number_format($item->price) }}원</p>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <nav class="new_product">
                        <ul>
                            @foreach( $hot_items as $key=>$item )
                                @if( $key<4 )
                                <li><a href="#" class="nav_newProduct {{ $key == 0 ? 'active' : '' }}"><i class="fa {{ $key == 0 ? 'fa-circle' : 'fa-circle-o' }}" aria-hidden="true"></i></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </li>
        </ul>
        <ul class="list-group half-layouts">
            <li class="one-layouts">
                <div class="advertisement">
                    <ul class="list-group">
                        @foreach( $advertisements as $key=>$ad )
                            @if( $key<5 )
                            <li class="{{ $key == 0 || $key == 1 ? 'half' : 'triple' }}">
                                <div class="thumbnail img-box" style="background:url({{ $ad->image }}) center no-repeat; background-size:cover;">
                                <a href="{{ $ad->url }}"></a>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="one-layouts">
                <div class="advertisement">
                    <ul class="list-group">
                        @foreach( $advertisements as $key=>$ad )
                            @if( $key>=5 )
                            <li class="half">
                                <div class="thumbnail img-box" style="background:url({{ $ad->image }}) center no-repeat; background-size:cover;">
                                <a href="{{ $ad->url }}"></a>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="shop-item">
        <h3>업체별 조립PC</h3>
        <ul class="list-group">
            @foreach( $shops as $key => $shop )
            <li><a href="#"  class="tab_shop {{ $key == '0' ? 'active' : '' }}" name="{{ 'tab_' . $shop->id }}">{{ $shop->name }}</a></li>
            @endforeach
        </ul>
        @foreach( $shops as $key => $shop )
        <div class="tab_show {{ 'tab_' . $shop->id }} {{ $key == '0' ? '' : 'hidden' }}">
            <ul>
                <li class="shop_brand">
                    <img src="{{ $shop->image }}" alt="{{ $shop->name }}"/>
                    <div class="detail-box" id="shop">
                        <p class="shop-name"> {{ $shop->name }} </p>
                        <a href="{{ $shop->url }}" target="_blank" class="shop-url">사이트로 이동</a>
                    </div>
                </li>
                @if( $shop->products()->count() == 0 )
                <li>
                    <div class="wrap">
                        <div class="img-box prod bdbt">
                        </div>
                    </div>
                    <div class="detail-box main">
                        <p class="prod-title">&nbsp;</p>
                        <p class="prod-shop">&nbsp;</p>
                        <p class="prod-price">&nbsp;</p>
                    </div>
                </li>
                @endif
                @foreach( $shop->products()->limit(4)->get() as $product )
                <li>
                    <a href="{{ url('/product') . '/' . $product->id }}">
                        <div class="wrap">
                            <div class="img-box prod bdbt" style="background:url({{ $product->image }}); background-size:cover;">
                            </div>
                        </div>
                    </a> 
                    <div class="detail-box main">
                        <p class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </p>
                        <p class="prod-shop">{{ $product->shop->name }}</p>
                        <p class="prod-price">{{ number_format($product->price) }}원
                        
                            <span class="hidden">{{ $product->id }}</span>
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
    <script>
        $(window).on('scroll', function(){
            var scrollTop = $(document).scrollTop();
            if( 160 < scrollTop && scrollTop< 200 ){
                if( $('nav.tabmenu-wrap').hasClass('active') ){
                    $('nav.tabmenu-wrap').removeClass('active');
                    $('nav.tabmenu-wrap').find('i').removeClass('fa-angle-right').addClass('fa-angle-left');
                }else{
                    $('nav.tabmenu-wrap').addClass('active');
                    $('nav.tabmenu-wrap').find('i').removeClass('fa-angle-left').addClass('fa-angle-right');
                }
            }else if( scrollTop < 160 ){
                $('nav.tabmenu-wrap').removeClass('active');
                $('nav.tabmenu-wrap').find('i').removeClass('fa-angle-right').addClass('fa-angle-left');
            }
        });
    </script>
@endsection