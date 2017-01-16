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
            <li class="game_01">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
            <li class="game_02">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
            <li class="game_03">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
            <li class="game_04">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
            <li class="game_05">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
            <li class="game_06">
                <div class="slider-cover">
                    <span>인기상품</span>
                    <h2>신년에도 인기는 계속 된다!<br/>
                    오버워치 게임용 PC</h2>
                    <p>
                    개나리 노란꽃 그늘 아래<br/>
                    가지런히 놓여있는 꼬까신 하나
                    </p>
                    <a href="" class="btn">바로가기</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="page list slider">
        <h3>Recommend</h3>
        <nav class="nav-slider recommend">
            <a href="#" class="left" onclick="return false;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <a href="#" class="right" onclick="return false;">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </nav>
        <ul class="list-group slider recommend">
            @foreach( $products as $product )
            <li>
                <span class="badge recommend">추천!!</span>
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
    </div>
@endsection