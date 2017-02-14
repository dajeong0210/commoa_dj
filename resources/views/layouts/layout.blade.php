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
    <script>
        window.onload = function(){
            $('div.loading').fadeOut('slow');
        }
    </script>
</head>
<body>
    <div class="loading" style="{{ 'background:url(' . url('/') . '/image/loading_icon.gif) center no-repeat #fff;'}}">
    </div>
    <div id="app">
        <nav class="nav-bar">
            <h1 class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ url('/') . '/image/commoa_logo.png' }}" alt="컴모아"/>
                </a>
            </h1>
            <a href="#" class="menu_btn">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <ul class="nav-group menu">
                <li>
                    <a href="{{ url('product/')}}" class="{{ Request::segment(1) == 'product' ? 'active' : ''}}">사양별</a>
                </li>
                <li class="submenu">
                    <a href="{{ url('game/')}}" class="{{ Request::segment(1) == 'game' ? 'active' : ''}}">게임용</a>
                </li>
                <li class="submenu">
                    <a href="{{ url('home/')}}" class="{{ Request::segment(1) == 'home' ? 'active' : ''}}">가정용</a>
                </li>
                <li class="submenu">
                    <a href="{{ url('office/')}}" class="{{ Request::segment(1) == 'office' ? 'active' : ''}}">사무용</a>
                </li>
                <li class="submenu">
                    <a href="{{ url('graphic/')}}" class="{{ Request::segment(1) == 'graphic' ? 'active' : ''}}">디자인용</a>
                </li>
                <li>
                    <a href="{{ url('shop/') }}" class="{{ Request::segment(1) == 'shop' && !Request::segment(2) ? 'active' : ''}}">쇼핑몰</a>
                </li>
                @if( Auth::guest() )
                    <li><a href="{{ url('/login') }}">로그인</a></li>
                    <li><a href="{{ url('/register') }}">회원가입</a></li>
                @else
                <li>
                    <a href="#" class="mypage"> {{ Auth::user()->name }} ▼ </a>
                    <div class="sub_menu hidden">
                        <ul>
                            <li><a href="{{ url('/mypage') }}">마이페이지</a></li>
                            @if( Auth::user()->permission == 2 )
                                <li><a href="{{ url('/admin') }}">관리자페이지</a></li>
                            @elseif( Auth::user()->permission == 1 )
                                <li><a href="{{ url('/myproduct') }}">상품관리</a></li>
                            @else
                                <li><a href="{{ url('/apply/create') }}">입점신청</a></li>
                            @endif
                            <li>
                                <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            로그아웃
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
            
        </nav>
        @yield('content')
    
        <div class="footer">
            <div class="wrap-footer">
                <div>
                    <h2 class="logo">
                        <img src="{{ url('/') . '/image/commoa_logo_inverted.png'}}" alt="컴모아">
                    </h2>
                    <p>국내 조립 컴퓨터들 다모여</p>
                </div>
                <div>
                    <h2>CONTACT</h2>
                    <p>Email : <a href="#" class="contact_mail">ivly@platformstory.com</a></p>
                    <p>문의사항은 메일 부탁드립니다.</p>
                </div>
                <div class="site-link">
                    <h2>SITE LINK</h2>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                </div>
                <div class="site-link">
                    <h2>SITE LINK</h2>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                    <p><a href="#">www</a></p>
                </div>
                <em class="footer-copy"><a href="{{url('')}}">ⓒCommoa</a> 2017 All rights reserved</em>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/additional-methods.js"></script>
    <script type="text/javascript" src="/js/messages_ko.min.js"></script>
    <script src="/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
