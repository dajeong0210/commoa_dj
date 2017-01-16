@extends('layouts.layout')

@section('content')
    <div class="page list">
        <div class="sort-group">
            <ul class="sort-list">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
            </ul>
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