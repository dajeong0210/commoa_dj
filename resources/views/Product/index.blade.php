@extends('layouts.layout')

@section('content')
    <div class="sort-group">
    </div>
    <div class="page list">
        <div class="sort-group">
            <form method="GET" class="sort-form">
            <ul class="sort-list">
                <li name="all" class="all">등록순</li>
                <li name="priceBy" class="priceBy">가격순</li>
                <li name="rankBy" class="rankBy">인기순</li>
            </ul>
            <input type="hidden" class="sort-val" name="product-sort" value=""/>
            </form>
        </div>
        <ul class="list-group">
            @foreach( $products as $product )
            <li>
                @if( Request::get('sort') == 'rankBy' )
                    @if( $product->row == 1 )
                    <span class="badge medal">1</span>
                    @else
                    <span class="badge">{{ $product->row }}</span>
                    @endif
                @endif
                <a href="{{ $product->url }}">
                <div class="img-box prod">
                    <img src="{{ $product->image }}" alt="">
                </div>
                </a>
                <div class="detail-box">
                    <a class="prod-title" href="{{ $product->url }}"> {{ $product->name }} </a>
                    <p class="prod_category">
                    @foreach( $product->categories as $category )
                        <a class="category category_{{ $category->id }}" href="{{ url('category') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                    @endforeach
                    </p>
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
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection