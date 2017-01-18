@extends('layouts.layout')
@section('content')
    <div class="page list mypage">
        @include('layouts.myLayout')   
        <div class="sort-group">
            <div class="sort-wrap shop">
            <ul class="sort-list">
                <li name="all" class="all {{ isset($_GET['shop-sort'])? $_GET['shop-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                <li name="nameBy" class="nameBy {{ isset($_GET['shop-sort'])? $_GET['shop-sort'] == 'nameBy'? 'active' : '' : '' }}">이름순</li>
            </ul>
            <form method="GET" class="hidden">
                <div class="sortBy">
                    <input type="text" id="sortBy_rank" name="shop-sort" class="input" value="all"/>
                </div>
            </form>
            </div>
        </div>
        <ul class="list-group">
            @foreach( $shops as $shop )
            <li class="shop">
                <a href="{{ $shop->url }}">
                <div class="img-box shop">
                    <img src="{{ $shop->image }}" alt="">
                </div>
                </a>
                @if( Auth::guest() )
                <div class="bookmark guest">
                @else
                <div class="bookmark">
                    <span>
                        <a href="#" class="bookmark" onclick="return false;">
                            @if( $shop->users()->get()->where('id', Auth::user()->id)->count() == 0 )
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                <i class="fa fa-star hidden" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-star-o hidden" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @endif
                        </a>
                    </span>    
                    <span class="hidden">{{ $shop->id }}</span>
                @endif
                </div>
                <div class="detail-box" id="shop">
                    <a class="prod-title shop" href="{{ $shop->url }}"> {{ $shop->name }} </a>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $shops->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection