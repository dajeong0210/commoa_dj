@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.mainEditMenu') 
        <div class="main-edit">
            <h2>광고배너편집</h2>
            <form name="advertisement" method="POST" action="/admin/advertisement/modify" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
            <div class="preview advertisement">
                <nav class="nav-bar">
                    <h1 class="logo">
                        <a href="#">
                            <img src="{{ url('/') . '/image/commoa_logo.png' }}" alt="컴모아"/>
                        </a>
                    </h1>
                    <ul class="nav-group">
                        <li>상품</li>
                        <li>쇼핑몰</li>
                        <li>관리자 ▼ </li>
                    </ul>
                </nav>
                <div class="advertisement-list mainPage">
                    <ul class="list-group">
                        <li class="one-layouts">
                            <div class="advertisement">
                                <ul class="list-group">
                                    @foreach( $advertisements as $i=>$ad )
                                        @if( $i<5 )
                                        <li class="{{ $i == 0 || $i == 1 ? 'half' : 'triple' }}">
                                        <a href="#" onclick="return false;" class="ad">
                                        <span>+</span>
                                        </a>
                                        <div id="ad{{$i}}" class="thumbnail img-box" style="background:url({{ $ad->image }}) center no-repeat; background-size:cover;">
                                        </div>
                                        <input type="file" class="hidden" name="image{{$i+1}}" id="image{{$i}}"/>
                                        <div class="url">
                                        <label for="url{{$i}}">URL</label>
                                        <input type="text" name="url{{$i+1}}" id="url{{$i}}" value="{{ $ad->url }}"/>
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
                                    @foreach( $advertisements as $i=>$ad )
                                        @if( $i>=5 )
                                        <li class="half">
                                        <a href="#" onclick="return false;" class="ad">
                                        <span>+</span>
                                        </a>
                                        <div id="ad{{$i}}" class="thumbnail img-box" style="background:url({{ $ad->image }}) center no-repeat; background-size:cover;">
                                        </div>
                                        <input type="file" class="hidden" name="image{{$i+1}}" id="image{{$i}}"/>
                                        <div class="url">
                                        <label for="url{{$i}}">URL</label>
                                        <input type="text" name="url{{$i+1}}" id="url{{$i}}" value="{{ $ad->url }}"/>
                                        </div>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mybutton group">
                <input type="submit" class="modify submit" value="수정">
            </div>
            </form>
        </div>
    </div>
@endsection