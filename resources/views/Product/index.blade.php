@extends('layouts.layout')

@section('content')
    <div class="page list">
        <div class="tab_wrap">
            <nav class="tab-nav">
                <ul>
                    <li class="active"><a href="#">FILTER</a></li>
                </ul>
            </nav>
            @if( Request::segment(1)=='game' )
            <div class="filter-wrap purpose">
                <form method="GET" class="filter-form">
                    <div class="filter-group purpose">
                        <h3 class="hidden">용도별</h3>
                        @foreach( $categories as $key=>$category )
                            @if( $category->sort == 1 && $key<4 )
                                <label for="{{ 'purpose_' . $category->id }}" class="major_game {{ isset($_GET['purpose'])? in_array( $category->name , $_GET['purpose'])? 'active' : '' : '' }}">
                                    <div class="img-box" style="background:url({{ $category->image }}) center; background-size:cover;"></div>
                                    <p>{{ $category->name }}</p>
                                </label>
                                <input type="checkbox" id="{{ 'purpose_' . $category->id }}" name="purpose[]" class="input purpose hidden" value="{{ $category->name }}" @if( isset($_GET['purpose'])) @if( in_array( $category->name , $_GET['purpose']) ) checked="checked" @endif @endif />
                            @elseif( $category->sort == '0' )
                            @else
                                @if( $category->products()->count() != 0 )
                                <label for="{{ 'purpose_' . $category->id }}" class="{{ isset($_GET['purpose'])? in_array( $category->name , $_GET['purpose'])? 'active' : '' : '' }}">{{ $category->name }}</label>
                                <input type="checkbox" id="{{ 'purpose_' . $category->id }}" name="purpose[]" class="input purpose hidden" value="{{ $category->name }}" @if( isset($_GET['purpose'])) @if( in_array( $category->name , $_GET['purpose']) ) checked="checked" @endif @endif />
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="group">
                        <div class="os half-layout">
                            <strong>OS</strong>
                            <label for="os_yes">있음</label>
                            <input type="radio" id="os_yes" name="os" class="input" value="1" @if( isset($_GET['os'])) @if( $_GET['os'] == '1' ) checked="checked" @endif @endif/>
                            <label for="os_no">없음</label>
                            <input type="radio" id="os_no" name="os" class="input" value="0" @if( isset($_GET['os'])) @if( $_GET['os'] == '0' ) checked="checked" @endif @endif/>
                            <label for="os_uncheck" class="uncheck">선택해제</label>
                            <input type="radio" id="os_uncheck" name="os" class="hidden">
                        </div>
                        <div class="monitor half-layout">
                            <strong>모니터</strong>
                            <label for="monitor_yes">있음</label>
                            <input type="radio" id="monitor_yes" name="monitor" class="input" value="1" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '1' ) checked="checked" @endif @endif/>
                            <label for="monitor_no">없음</label>
                            <input type="radio" id="monitor_no" name="monitor" class="input" value="0" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '0' ) checked="checked" @endif @endif/>
                            <label for="monitor_uncheck" class="uncheck">선택해제</label>
                            <input type="radio" id="monitor_uncheck" name="monitor" class="hidden">
                        </div>
                    </div>
                    <div class="filter-group sortBy hidden">
                        <input type="text" id="sortBy" name="product-sort" class="input" {{ isset($_GET['product-sort']) ? 'value=' . $_GET['product-sort'] : 'disabled' }} />
                    </div>
                    <div class="filter-group purpose">
                        <input type="submit" class="submit filter-group" value="Go">
                    </div>
                </form>
            </div>
            @else
            <div class="filter-wrap specification {{ Request::segment(1)=='home' || Request::segment(1) == 'office' || Request::segment(1) == 'graphic' ||Request::segment(1)=='product' && !Request::segment(2) ? '' : 'hidden' }} {{ Request::segment(1)=='home' || Request::segment(1)=='office' || Request::segment(1) == 'graphic' ? 'small-layout' : '' }}">
                <form method="GET" class="filter-form">
                    <div class="filter-group {{ Request::segment(1)=='product' && !Request::segment(2) ? 'quatro-layout' : 'hidden' }}">
                        <h3>CPU</h3>
                        <label for="cpu_level_high" @if( isset($_GET['cpu_level'])) @if( in_array('3' , $_GET['cpu_level']) ) class="active" @endif @endif>상</label>
                        <input type="checkbox" id="cpu_level_high" name="cpu_level[]" class="input specification hidden" value="3" @if( isset($_GET['cpu_level'])) @if( in_array('3' , $_GET['cpu_level']) ) checked="checked" @endif @endif/>
                        <label for="cpu_level_mid" @if( isset($_GET['cpu_level'])) @if( in_array('2' , $_GET['cpu_level']) ) class="active" @endif @endif>중</label>
                        <input type="checkbox" id="cpu_level_mid" name="cpu_level[]" class="input specification hidden" value="2" @if( isset($_GET['cpu_level'])) @if( in_array('2' , $_GET['cpu_level']) ) checked="checked" @endif @endif/>
                        <label for="cpu_level_low" @if( isset($_GET['cpu_level'])) @if( in_array('1' , $_GET['cpu_level']) ) class="active" @endif @endif>하</label>
                        <input type="checkbox" id="cpu_level_low" name="cpu_level[]" class="input specification hidden" value="1" @if( isset($_GET['cpu_level'])) @if( in_array('1' , $_GET['cpu_level']) ) checked="checked" @endif @endif/>
                        <div class="info_group">
                            <a href="#" class="cpu_info"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="cpu_info popup hidden">
                        <strong>CPU 사양 기준</strong>
                        <p>상 : 인텔 코어 i5, 인텔 코어 i7</p>
                        <p>중 : 인텔 팬티엄, 인텔 코어 i3</p>
                        <p>하 : 인텔 셀러론</p>
                    </div>
                    <div class="filter-group {{ Request::segment(1)=='product' && !Request::segment(2) ? 'quatro-layout' : 'hidden' }}">
                        <h3>VGA</h3>
                        <label for="vga_level_high" @if( isset($_GET['vga_level'])) @if( in_array('3' , $_GET['vga_level']) ) class="active" @endif @endif>상</label>
                        <input type="checkbox" id="vga_level_high" name="vga_level[]" class="input specification hidden" value="3" @if( isset($_GET['vga_level'])) @if( in_array('3' , $_GET['vga_level']) ) checked="checked" @endif @endif/>
                        <label for="vga_level_mid" @if( isset($_GET['vga_level'])) @if( in_array('2' , $_GET['vga_level']) ) class="active" @endif @endif>중</label>
                        <input type="checkbox" id="vga_level_mid" name="vga_level[]" class="input specification hidden" value="2" @if( isset($_GET['vga_level'])) @if( in_array('2' , $_GET['vga_level']) ) checked="checked" @endif @endif/>
                        <label for="vga_level_low" @if( isset($_GET['vga_level'])) @if( in_array('1' , $_GET['vga_level']) ) class="active" @endif @endif>하</label>
                        <input type="checkbox" id="vga_level_low" name="vga_level[]" class="input specification hidden" value="1" @if( isset($_GET['vga_level'])) @if( in_array('1' , $_GET['vga_level']) ) checked="checked" @endif @endif/>
                        <div class="info_group">
                            <a href="#" class="vga_info"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="vga_info popup hidden">
                        <strong>VGA 사양 기준</strong>
                        <p>상 : <u>[GeForce]</u> GTX 770, GTX 780, GTX 780 Ti, GTX 970, GTX 980, GTX 980 Ti, GTX 1060, GTX 1070, GTX 1080<br/><u>[Radeon™]</u> RX470, RX480</p>
                        <p>중 :  <u>[GeForce]</u> GTX 750, GTX 750 Ti, GTX 760, GTX 950, GTX 960, GTX 1050, GTX 1050 Ti<br/><u>[Radeon™]</u> RX460</p>
                        <p>하 : GeForce GT 740, 내장그래픽</p>
                    </div>
                    <div class="filter-group storage {{ Request::segment(1)=='product' && !Request::segment(2) ? 'quatro-layout' : 'hidden' }}">
                        <h3>저장장치</h3>
                        <div class="wrap">
                            <span>HDD</span>
                            <label for="hdd_yes" @if( isset($_GET['hdd'])) @if( $_GET['hdd'] == '1' ) class="active" @endif @endif>있음</label>
                            <input type="radio" id="hdd_yes" name="hdd" class="input hidden" value="1" @if( isset($_GET['hdd'])) @if( $_GET['hdd'] == '1' ) checked="checked" @endif @endif/>
                            <label for="hdd_no" @if( isset($_GET['hdd'])) @if( $_GET['hdd'] == '0' ) class="active" @endif @endif>없음</label>
                            <input type="radio" id="hdd_no" name="hdd" class="input hidden" value="0" @if( isset($_GET['hdd'])) @if( $_GET['hdd'] == '0' ) checked="checked" @endif @endif/>
                        </div>
                        <div class="wrap">
                            <span>SSD</span>
                            <label for="ssd_yes" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '1' ) class="active" @endif @endif>있음</label>
                            <input type="radio" id="ssd_yes" name="ssd" class="input hidden" value="1" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '1' ) checked="checked" @endif @endif/>
                            <label for="ssd_no" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '0' ) class="active" @endif @endif>없음</label>
                            <input type="radio" id="ssd_no" name="ssd" class="input hidden" value="0" @if( isset($_GET['ssd'])) @if( $_GET['ssd'] == '0' ) checked="checked" @endif @endif/>
                        </div>
                    </div>
                    <div class="filter-group os {{ Request::segment(1)=='product' && !Request::segment(2) ? 'quatro-layout' : 'half-layout' }}">
                        <h3>OS</h3>
                        <label for="os_yes" @if( isset($_GET['os'])) @if( $_GET['os'] == '1' ) class="active" @endif @endif>있음</label>
                        <input type="radio" id="os_yes" name="os" class="input hidden" value="1" @if( isset($_GET['os'])) @if( $_GET['os'] == '1' ) checked="checked" @endif @endif/>
                        <label for="os_no" @if( isset($_GET['os'])) @if( $_GET['os'] == '0' ) class="active" @endif @endif>없음</label>
                        <input type="radio" id="os_no" name="os" class="input hidden" value="0" @if( isset($_GET['os'])) @if( $_GET['os'] == '0' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group monitor {{ Request::segment(1)=='product' && !Request::segment(2) ? 'quatro-layout' : 'half-layout' }}">
                        <h3>모니터</h3>
                        <label for="monitor_yes" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '1' ) class="active" @endif @endif>있음</label>
                        <input type="radio" id="monitor_yes" name="monitor" class="input hidden" value="1" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '1' ) checked="checked" @endif @endif/>
                        <label for="monitor_no" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '0' ) class="active" @endif @endif>없음</label>
                        <input type="radio" id="monitor_no" name="monitor" class="input hidden" value="0" @if( isset($_GET['monitor'])) @if( $_GET['monitor'] == '0' ) checked="checked" @endif @endif/>
                    </div>
                    <div class="filter-group sortBy hidden">
                        <input type="text" id="sortBy" name="product-sort" class="input" {{ isset($_GET['product-sort']) ? 'value=' . $_GET['product-sort'] : 'disabled' }} />
                    </div>
                    <div class="filter-group one-layout purpose">
                        <input type="submit" class="submit filter-group" value="Go">
                    </div>
                </form>
            </div>
            @endif
        </div>
        <div class="sort-wrap">
            <ul class="sort-list product-sort">
                <li name="all" class="all {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                <li name="priceBydesc" class="priceBydesc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceBydesc'? 'active' : '' : '' }}">높은 가격순</li>
                <li name="priceByasc" class="priceByasc {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'priceByasc'? 'active' : '' : '' }}">낮은 가격순</li>
                <li name="rankBy" class="rankBy {{ isset($_GET['product-sort'])? $_GET['product-sort'] == 'rankBy'? 'active' : '' : '' }}">인기순</li>
            </ul>
        </div>
        @if( $products->count() != 0 )
            <ul class="list-group grid">
                @foreach( $products as $product )
                <li class="grid-item">
                    @if( Request::get('sort') == 'rankBy' )
                        @if( $product->row == 1 )
                        <span class="badge medal">1</span>
                        @else
                        <span class="badge">{{ $product->row }}</span>
                        @endif
                    @endif
                    <a href="{{ url('/product') . '/' . $product->id }}">
                        <div class="img-box prod bdbt" style="background:url({{ $product->image }}); background-size:cover;">
                        </div>
                    </a> 
                    <div class="detail-box">
                        <a class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </a>
                        <ul class="prod_category">
                        @foreach( $product->categories as $category )
                            @if($category->name != '게임용')
                                <li>
                                <a class="category" style="background:{{ $category->color }}" href="{{ url('type') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        </ul>
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
        @else
            <div class="non-item">
                <strong>조건을 모두 만족하는 상품이 없습니다!</strong>
            </div>
            @if( Request::segment(1) == 'game' && $or_products != NULL )
            <div class="non-item-recommend">
                <h4>이런 상품을 찾으셨나요?</h4>
                <ul class="list-group grid">
                    @foreach( $or_products as $product )
                    <li class="grid-item">
                        @if( Request::get('sort') == 'rankBy' )
                            @if( $product->row == 1 )
                            <span class="badge medal">1</span>
                            @else
                            <span class="badge">{{ $product->row }}</span>
                            @endif
                        @endif
                        <a href="{{ url('/product') . '/' . $product->id }}">
                            <div class="img-box prod bdbt" style="background:url({{ $product->image }}); background-size:cover;">
                            </div>
                        </a> 
                        <div class="detail-box">
                            <a class="prod-title" href="{{ url('/product') . '/' . $product->id }}"> {{ $product->name }} </a>
                            <ul class="prod_category">
                            @foreach( $product->categories as $category )
                                @if($category->name != '게임용')
                                    <li>
                                    <a class="category" style="background:{{ $category->color }}" href="{{ url('type') . '/' . str_replace(' ','_',$category->name) }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                            </ul>
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
                    {{ $or_products->appends(request()->except('page'))->links() }}
                </div>
            </div>
            @endif
        @endif
    </div>
@endsection