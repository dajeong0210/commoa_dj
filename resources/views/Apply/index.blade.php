@extends('layouts.layout')

@section('content')
    <div class="page list mypage">
        @include('layouts.myLayout') 
        <ul class="myProduct">
            @foreach( $applies as $apply )
            <li>
                <div class="image-box">
                    <a href="{{ $product->url }}">
                        <img src="{{ $product->image }}" alt="">
                    </a>
                </div>
                <div class="mydetail-box">
                    <a class="myprod-title" href="{{ $product->url }}"> {{ $product->name }} </a>
                    <p class="myprod-price">\{{ number_format($product->price) }}원
                    </p>
                    <ul>
                        <li><span>cpu</span> {{ $product->cpu->name }}<span></span></li>
                        <li><span>vga</span> {{ $product->vga->name }}<span></span></li>
                        <li><span>ram</span> {{ $product->ram }}<span></span></li>
                        <li><span>ssd</span> {{ $product->ssd }}<span></span></li>
                        <li><span>hdd</span> {{ $product->hdd }}<span></span></li>
                        <li><span>power</span> {{ $product->power }}<span></span></li>
                        <li>
                            <span>os</span>
                            @if( $product->os == 1 )
                                Windows설치
                            @else
                                없음
                            @endif
                        </li>
                        <li>
                            <span>overclock</span>
                            @if( $product->overclock == 1 )
                                가능
                            @else
                                불가능
                            @endif
                        </li>
                        <li>
                            <span>monitor</span>
                            @if( $product->monitor == '' )
                                없음
                            @else
                                {{ $product->monitor }}인치
                            @endif
                        </li>
                        </tr>
                    </ul>
                </div>
                <div class="mybutton">
                    <form class="myprod-del" method="POST" action="{{ url('/myproduct') . '/' . $product->id }}" enctype="multipart/form-data">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                        <div class="button-group">
                            <a href="{{ url('myproduct').'/'. $product->id .'/edit' }}" class="modify">수정</a>
                            <input type="submit" value="삭제" class="delete"/>
                        </div>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection