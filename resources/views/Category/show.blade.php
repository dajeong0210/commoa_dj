@extends('layouts.layout')

@section('content')
    <div class="category_main">
        <div class="image-cover"></div>
        <div class="category_name">
            <h2># {{ $category_name }}</h2>
        </div>
    </div>
    <div class="page list">
        <ul class="list-group">
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
                        <a class="category category_{{ $category->id }}" href="{{ url('category') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
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