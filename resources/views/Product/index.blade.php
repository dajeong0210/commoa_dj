@extends('layouts.layout')

@section('content')
    <div class="page list">
        <div class="tap_wrap">
            <nav class="tap-nav">
                <ul>
                    <li><a href="#" class="purpose">용도별</a></li>
                    <li><a href="#" class="specification">사양별</a></li>
                </ul>
            </nav>
            <div class="filter-wrap purpose">
                <form method="GET" class="filter-form">
                    <div class="filter-group purpose">
                        <h3>용도별</h3>
                        <label for="purpose_office">사무용</label>
                        <input type="checkbox" id="purpose_office" name="purpose[office]" class="input purpose hidden" value="사무용" @if( isset($_GET['purpose'])) @if( in_array('사무용', $_GET['purpose']) ) checked="checked" @endif @endif />
                        <label for="purpose_game">게임용</label>
                        <input type="checkbox" id="purpose_game" name="purpose[game]" class="input purpose hidden" value="게임용" @if( isset($_GET['purpose'])) @if( in_array('게임용', $_GET['purpose']) ) checked="checked" @endif @endif/>
                        <label for="purpose_design">디자인용</label>
                        <input type="checkbox" id="purpose_design" name="purpose[design]" class="input purpose hidden" value="디자인용" @if( isset($_GET['purpose'])) @if( in_array('디자인용', $_GET['purpose']) ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group hidden">
                        <input type="text" id="sortBy_rank" name="product-sort" class="input" value="all"/>
                    </div>
                    <div class="filter-group purpose">
                        <input type="submit" class="submit filter-group" value="보기">
                    </div>
                </form>
            </div>
            <div class="filter-wrap specification hidden">
                <form method="GET" class="filter-form">
                    <div class="filter-group">
                        <h3>CPU</h3>
                        <label for="cpu_level_high">상</label>
                        <input type="radio" id="cpu_level_high" name="cpu_level" class="input specification hidden" value="3"/>
                        <label for="cpu_level_mid">중</label>
                        <input type="radio" id="cpu_level_mid" name="cpu_level" class="input specification hidden" value="2"/>
                        <label for="cpu_level_low">하</label>
                        <input type="radio" id="cpu_level_low" name="cpu_level" class="input specification hidden" value="1"/>
                    </div>
                    <div class="filter-group">
                        <h3>VGA</h3>
                        <label for="vga_level_high">상</label>
                        <input type="radio" id="vga_level_high" name="vga_level" class="input specification hidden" value="3"/>
                        <label for="vga_level_mid">중</label>
                        <input type="radio" id="vga_level_mid" name="vga_level" class="input specification hidden" value="2"/>
                        <label for="vga_level_low">하</label>
                        <input type="radio" id="vga_level_low" name="vga_level" class="input specification hidden" value="1"/>
                    </div>
                    <div class="filter-group">
                        <h3>OS포함</h3>
                        <label for="os_yes">있음</label>
                        <input type="radio" id="os_yes" name="os" class="input hidden" value="1"/>
                        <label for="os_no">없음</label>
                        <input type="radio" id="os_no" name="os" class="input hidden" value="0"/>
                    </div>
                    <div class="filter-group">
                        <h3>SSD여부</h3>
                        <label for="ssd_yes">있음</label>
                        <input type="radio" id="ssd_yes" name="ssd" class="input hidden" value="1"/>
                        <label for="ssd_no">없음</label>
                        <input type="radio" id="ssd_no" name="ssd" class="input hidden" value="0"/>
                    </div>
                    <div class="filter-group">
                        <h3>모니터포함</h3>
                        <label for="monitor_yes">있음</label>
                        <input type="radio" id="monitor_yes" name="monitor" class="input hidden" value="1"/>
                        <label for="monitor_no">없음</label>
                        <input type="radio" id="monitor_no" name="monitor" class="input hidden" value="0"/>
                    </div>
                    <div class="filter-group hidden">
                        <input type="text" id="sortBy_rank" name="product-sort" class="input" value="all"/>
                    </div>
                    <div class="filter-group">
                        <input type="submit" class="submit filter-group" value="보기">
                    </div>
                </form>
            </div>
        </div>
        <div class="sort-wrap">
            <ul class="sort-list">
                <li name="all" class="all">최신순</li>
                <li name="priceBydesc" class="priceBydesc">높은가격순</li>
                <li name="priceByasc" class="priceByasc">낮은가격순</li>
                <li name="rankBy" class="rankBy">인기순</li>
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
        <div class="pagination">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection