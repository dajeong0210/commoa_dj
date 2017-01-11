@extends('layouts.layout')

@section('content')
    <div class="page list">
        <ul class="list-group">
            @foreach( $shops as $shop )
            <li class="shop">
                <a href="{{ $shop->url }}">
                <div class="img-box shop">
                    <img src="{{ $shop->image }}" alt="">
                </div>
                </a>
                <div class="bookmark">
                    @if( Auth::guest() )
                    @else
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
                    @endif
                    <span class="hidden">{{ $shop->id }}</span>
                </div>
                <div class="detail-box" id="shop">
                    <p>
                        <a class="prod-title" href="{{ $shop->url }}"> {{ $shop->name }} </a>
                    </p>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $shops->links() }}
        </div>
    </div>
@endsection