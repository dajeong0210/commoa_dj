<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    
    
    <!-- Scripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app" class="admin">
    <div class="page list" id="popup">
        <div class="main-edit">
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
            <ul class="myProduct" id="popup">
                @foreach( $products as $product )
                <li>
                    <div class="image-box">
                        <a href="{{ url('product') . '/' . $product->id }}">
                            <img src="{{ $product->image }}" alt="">
                        </a>
                    </div>
                    <div class="mydetail-box">
                        <a class="myprod-title" href="{{ url('product') . '/' . $product->id }}"> {{ $product->name }} </a>
                        <p class="shop-name hidden">{{ $product->shop->name }}</p>
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
                        <div class="button-group">
                            <a href="#" class="recommend recommend{{ $id }}">메인에 등록</a>
                            <span class="hidden">{{ $product->id }}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="pagination">
                {{ $products->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/additional-methods.js"></script>
<script type="text/javascript" src="/js/messages_ko.min.js"></script>
<script type="text/javascript" src="{{ url('/').'/js/adminScript.js' }}"></script>
</body>
</html>