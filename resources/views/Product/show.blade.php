@extends('layouts.layout')

@section('content')
    <div class="page list detail">        
        <div class="product-name">
            <p class="myprod-title"> {{ $product->name }} </p>
        </div>
        <div class="product-shop">
            <p class="prod-url">{{ $product->shop->name }}</p>
        </div>
        <div class="image-box detail">
            <a href="{{ $product->url }}">
                <img src="{{ $product->image }}" alt="">
            </a>
        </div>
        @if( Auth::guest() )
        <div class="fav-group not-show">
        </div>
        @else
        <div class="fav-group">
            <span>
                <a href="#" class="fav-detail" onclick="return false;">
                    @if( $product->users()->get()->where('id', Auth::user()->id)->count() == 0 )
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        <em><br/>좋아요</em>
                        <i class="fa fa-heart hidden" aria-hidden="true"></i>
                        <em class="hidden"><br/>좋아요취소</em>
                    @else
                        <i class="fa fa-heart-o hidden" aria-hidden="true"></i>
                        <em class="hidden"><br/>좋아요</em>
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <em><br/>좋아요취소</em>
                    @endif
                </a>
            </span>
            <span class="hidden">{{ $product->id }}</span>
        </div>
        @endif
        <div class="mydetail-box detail">
            <p class="myprod-price">\{{ number_format($product->price) }}원
            </p>
            <ul class="detail">
                <li><span>cpu</span> {{ $product->cpu->name }}<span></span></li>
                <li><span>vga</span> {{ $product->vga->name }}<span></span></li>
                <li><span>ram</span> {{ $product->ram }}<span>GB</span></li>
                <li>
                    @if( $product->ssd == '' )
                    <span>ssd</span> 별도구매<span></span>
                    @else
                    <span>ssd</span> {{ $product->ssd }}<span>GB</span>
                    @endif
                </li>
                <li>
                    @if( $product->hdd == '' )
                    <span>hdd</span> 별도구매<span></span>
                    @else
                    <span>hdd</span> {{ $product->hdd }}<span>GB</span>
                    @endif
                </li>
                <li><span>power</span> {{ $product->power }}<span>W</span></li>
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
                        별도구매
                    @else
                        {{ $product->monitor }}인치
                    @endif
                </li>
                </tr>
            </ul>
            <div class="link-group">
                <a href="{{ $product->url }}" class="go_url" target="_blank">사이트로 이동</a>
                <input type="hidden" class="product-id" value="{{ $product->id }}">
            </div>
        </div>
    </div>
    <div class="page list mypage">
        <ul class="myProduct similar">
            <h3>이런 상품은 어떠세요?</h3>
            @foreach( $similar as $similar )
            <li>
                <div class="image-box">
                    <a href="{{ url('product') . '/' . $similar->id }}">
                        <img src="{{ $similar->image }}" alt="">
                    </a>
                </div>
                <div class="mydetail-box">
                    <a class="myprod-title" href="{{ url('product') . '/' . $similar->id }}"> {{ $similar->name }} </a>
                    <p class="myprod-price">\{{ number_format($similar->price) }}원
                    </p>
                    <ul>
                        <li class="{{ $similar->cpu->id == $product->cpu->id ? 'same' : '' }}"><span>cpu</span> {{ $similar->cpu->name }}<span></span></li>
                        <li class="{{ $similar->vga->id == $product->vga->id ? 'same' : '' }}"><span>vga</span> {{ $similar->vga->name }}<span></span></li>
                        <li><span>ram</span> {{ $similar->ram }}<span>GB</span></li>
                        <li>
                            @if( $similar->ssd == '' )
                            <span>ssd</span> 별도구매<span></span>
                            @else
                            <span>ssd</span> {{ $similar->ssd }}<span>GB</span>
                            @endif
                        </li>
                        <li>
                            @if( $similar->hdd == '' )
                            <span>hdd</span> 별도구매<span></span>
                            @else
                            <span>hdd</span> {{ $similar->hdd }}<span>GB</span>
                            @endif
                        </li>
                        <li><span>power</span> {{ $similar->power }}<span>W</span></li>
                        <li>
                            <span>os</span>
                            @if( $similar->os == 1 )
                                Windows설치
                            @else
                                없음
                            @endif
                        </li>
                        <li>
                            <span>overclock</span>
                            @if( $similar->overclock == 1 )
                                가능
                            @else
                                불가능
                            @endif
                        </li>
                        <li>
                            <span>monitor</span>
                            @if( $similar->monitor == '' )
                                별도구매
                            @else
                                {{ $similar->monitor }}인치
                            @endif
                        </li>
                        </tr>
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <script type="text/javascript">
        var cookieList = $.fn.cookieList("recent");
        var obj = new Object();
        obj.idx = '{{ $product->id }}';
        obj.name = '{{ $product->name }}';
        obj.url = '{{ $product->url }}';
	    obj.img = '{{ $product->image }}';
        cookieList.add(obj);
    </script>
@endsection