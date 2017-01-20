@extends('layouts.layout')

@section('content')
    <div class="page list">
        <div class="tab_wrap">
            <nav class="tab-nav">
                <ul>
                    <li class="{{ isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) ? '' : 'active' }}"><a href="#" class="purpose">용도별</a></li>
                    <li class="{{ isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) ? 'active' : '' }}"><a href="#" class="specification">사양별</a></li>
                </ul>
            </nav>
            <div class="filter-wrap purpose {{ isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) ? 'hidden' : '' }}">
                <form method="GET" class="filter-form">
                    <div class="filter-group purpose">
                        <h3 class="hidden">용도별</h3>
                        @foreach( $categories as $category )
                            <label for="{{ 'purpose_' . $category->id }}" class="{{ isset($_GET['purpose'])? in_array( $category->name , $_GET['purpose'])? 'active' : '' : '' }}">{{ $category->name }}</label>
                            <input type="checkbox" id="{{ 'purpose_' . $category->id }}" name="purpose[]" class="input purpose hidden" value="{{ $category->name }}" @if( isset($_GET['purpose'])) @if( in_array( $category->name , $_GET['purpose']) ) checked="checked" @endif @endif />
                        @endforeach
                    </div>
                    <div class="filter-group sortBy hidden">
                        @if( isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) )
                        @else
                            <input type="text" id="sortBy_rank" name="product-sort" class="input" value="all"/>
                        @endif
                    </div>
                    <div class="filter-group purpose">
                        <input type="submit" class="submit filter-group" value="Go">
                    </div>
                </form>
            </div>
            <div class="filter-wrap specification {{ isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) ? '' : 'hidden' }}">
                <form method="GET" class="filter-form">
                    <div class="filter-group">
                        <h3>CPU</h3>
                        <label for="cpu_level_high" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level'] == '3' ) class="active" @endif @endif>상</label>
                        <input type="radio" id="cpu_level_high" name="cpu_level" class="input specification hidden" value="3" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level'] == '3' ) checked="checked" @endif @endif/>
                        <label for="cpu_level_mid" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level'] == '2' ) class="active" @endif @endif>중</label>
                        <input type="radio" id="cpu_level_mid" name="cpu_level" class="input specification hidden" value="2" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level'] == '2' ) checked="checked" @endif @endif/>
                        <label for="cpu_level_low" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level'] == '1' ) class="active" @endif @endif>하</label>
                        <input type="radio" id="cpu_level_low" name="cpu_level" class="input specification hidden" value="1" @if( isset($_GET['cpu_level'])) @if( $_GET['cpu_level']== '1' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group">
                        <h3>VGA</h3>
                        <label for="vga_level_high" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '3' ) class="active" @endif @endif>상</label>
                        <input type="radio" id="vga_level_high" name="vga_level" class="input specification hidden" value="3" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '3' ) checked="checked" @endif @endif/>
                        <label for="vga_level_mid" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '2' ) class="active" @endif @endif>중</label>
                        <input type="radio" id="vga_level_mid" name="vga_level" class="input specification hidden" value="2" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '2' ) checked="checked" @endif @endif/>
                        <label for="vga_level_low" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '1' ) class="active" @endif @endif>하</label>
                        <input type="radio" id="vga_level_low" name="vga_level" class="input specification hidden" value="1" @if( isset($_GET['vga_level'])) @if( $_GET['vga_level'] == '1' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group">
                        <h3>OS</h3>
                        <label for="os_yes" @if( isset($_GET['os'])) @if( $_GET['os'] == '1' ) class="active" @endif @endif>있음</label>
                        <input type="radio" id="os_yes" name="os" class="input hidden" value="1" @if( isset($_GET['os'])) @if( $_GET['os'] == '1' ) checked="checked" @endif @endif/>
                        <label for="os_no" @if( isset($_GET['os'])) @if( $_GET['os'] == '0' ) class="active" @endif @endif>없음</label>
                        <input type="radio" id="os_no" name="os" class="input hidden" value="0" @if( isset($_GET['os'])) @if( $_GET['os'] == '0' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group">
                        <h3>SSD</h3>
                        <label for="ssd_yes" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '1' ) class="active" @endif @endif>있음</label>
                        <input type="radio" id="ssd_yes" name="ssd" class="input hidden" value="1" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '1' ) checked="checked" @endif @endif/>
                        <label for="ssd_no" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '0' ) class="active" @endif @endif>없음</label>
                        <input type="radio" id="ssd_no" name="ssd" class="input hidden" value="0" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '0' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group">
                        <h3>모니터</h3>
                        <label for="monitor_yes" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '1' ) class="active" @endif @endif>있음</label>
                        <input type="radio" id="monitor_yes" name="monitor" class="input hidden" value="1" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '1' ) checked="checked" @endif @endif/>
                        <label for="monitor_no" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '0' ) class="active" @endif @endif>없음</label>
                        <input type="radio" id="monitor_no" name="monitor" class="input hidden" value="0" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '0' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group sortBy hidden">
                        @if( isset($_GET['cpu_level']) || isset($_GET['vga_level']) || isset($_GET['os']) || isset($_GET['ssd']) || isset($_GET['monitor']) )
                            <input type="text" id="sortBy_rank" name="product-sort" class="input" value="all"/>
                        @endif
                    </div>
                    <div class="filter-group">
                        <input type="submit" class="submit filter-group" value="Go">
                    </div>
                </form>
            </div>
        </div>
        <div class="sort-wrap">
            <ul class="sort-list">
                <li name="all" class="all {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                <li name="priceBydesc" class="priceBydesc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceBydesc'? 'active' : '' : '' }}">높은가격순</li>
                <li name="priceByasc" class="priceByasc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceByasc'? 'active' : '' : '' }}">낮은가격순</li>
                <li name="rankBy" class="rankBy {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'rankBy'? 'active' : '' : '' }}">인기순</li>
            </ul>
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
                <div class="img-box prod">
                    <a href="{{ url('/product') . '/' . $product->id }}">
                        <img src="{{ $product->image }}" alt="">
                    </a>
                </div>
                <div class="detail-box">
                    <a class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </a>
                    <ul class="prod_category">
                    @foreach( $product->categories as $category )
                        <li>
                        <a class="category category_{{ $category->id }}" href="{{ url('category') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    </ul>
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