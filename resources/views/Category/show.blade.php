@extends('layouts.layout')

@section('content')
    <div class="category_main">
        <div class="image-cover"></div>
        <div class="category_name">
            <h2># {{ $category_name }}</h2>
        </div>
    </div>
    <div class="page list">
        <div class="tab">
            <div name="game-guide" class="no-pd">
                <ul class="specification">
                    <li id="{{ 'game' . $game->id }}">
                        <h4>{{ $game->name }} 사양정보</h4>
                        <div class="wrap">
                            <div class="image-box" style="background:url({{ $game->image }}) center no-repeat;background-size:cover;"></div>
                        </div>
                        <ul>
                            <li>
                                <p class="title">최소 프로세서</p>
                                <p>{!! nl2br( e($game->min_cpu) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">최소 그래픽카드</p>
                                <p>{!! nl2br( e($game->min_vga) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">권장 프로세서</p>
                                <p>{!! nl2br( e($game->recommend_cpu) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">권장 그래픽카드</p>
                                <p>{!! nl2br( e($game->recommend_vga) ) !!}</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">최소 메모리</p>
                                <p class="not-multi">{{ $game->min_memory }}GB</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">권장 메모리</p>
                                <p class="not-multi">{{ $game->recommend_memory }}GB</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">여유저장공간</p>
                                <p class="not-multi">{{ $game->storage }}GB</p>
                            </li>
                            <li>
                                <p class="title">&nbsp;</p>
                                <p></p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <form method="GET" class="hidden">
            <div class="filter-group sortBy hidden">
                <input type="text" id="sortBy" name="product-sort" class="input" {{ isset($_GET['product-sort']) ? 'value=' . $_GET['product-sort'] : 'disabled' }} />
            </div>
        </form>
        <div class="sort-wrap">
            <ul class="sort-list product-sort">
                <li name="all" class="all {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                <li name="priceBydesc" class="priceBydesc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceBydesc'? 'active' : '' : '' }}">높은 가격순</li>
                <li name="priceByasc" class="priceByasc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceByasc'? 'active' : '' : '' }}">낮은 가격순</li>
                <li name="rankBy" class="rankBy {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'rankBy'? 'active' : '' : '' }}">인기순</li>
            </ul>
        </div>
        <ul class="list-group game-product">
            <h4>{{ $category_name }} 상품목록</h4>
            @foreach( $products as $product )
            <li>
                <a href="{{ url('/product') . '/' . $product->id }}">
                    <div class="img-box prod" style="background:url({{ $product->image }}); background-size:cover;">
                    </div>
                </a> 
                <div class="detail-box">
                    <a class="prod-title" href="{{ $product->url }}"> {{ $product->name }} </a>
                    <ul class="prod_category">
                    @foreach( $product->categories as $category )
                        <li>
                        <a class="category" style="background:{{ $category->color }}" href="{{ url('type') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
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
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection