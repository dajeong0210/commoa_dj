@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.adminMenu') 
        <div class="search-wrap">
            <form method="GET" name="searchForm">
                <div class="search-form">
                    <label for="search" class="search"><i class="fa fa-search" aria-hidden="true"></i><span class="hidden">검색</span></label>
                    <input type="text" id="search" name="search" placeholder="Search Products" @if( $search )value="{{ $search }}"@endif/>
                </div>
                <div class="sortBy hidden">
                    <input type="text" id="sortBy" name="product-sort" class="input" value="all"/>
                </div>
            </form>
        </div>
        <div class="wrap">
            <div class="sort-wrap">
                <ul class="sort-list">
                    <li name="all" class="all {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                    <li name="nameBy" class="nameBy {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'nameBy'? 'active' : '' : '' }}">이름순</li>
                    <li name="rankBy" class="rankBy {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'rankBy'? 'active' : '' : '' }}">클릭순</li>
                </ul>
            </div>
        </div>
        <ul class="myProduct">
            @foreach( $products as $product )
            <li>
                <div class="image-box">
                    <a href="{{ url('product') . '/' . $product->id }}">
                        <img src="{{ $product->image }}" alt="">
                    </a>
                </div>
                <div class="mydetail-box">
                    <a class="myprod-title" href="{{ url('product') . '/' . $product->id }}"> {{ $product->name }} </a>
                    <p class="myprod-price">\{{ number_format($product->price) }}원
                    </p>
                    <ul>
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
                                없음
                            @else
                                {{ $product->monitor }}인치
                            @endif
                        </li>
                        </tr>
                    </ul>
                </div>
                <div class="mybutton">
                    <div class="button-group">
                        <a href="{{ url('/admin/product').'/'. $product->id .'/edit' }}" class="modify">수정</a>
                        <input type="submit" value="삭제" class="delete del-submit" onclick="confirmation()"/>
                        <form class="myprod-del" method="POST" action="{{ url('/admin/product') . '/' . $product->id }}" enctype="multipart/form-data">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection