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
    <div id="app">
        <nav class="nav-bar">
            <h1 class="logo">
                <a href="{{ url('/') }}">
                    <img src="../image/commoa_logo.png" alt="logo"/>
                </a>
            </h1>
            <a href="#" class="menu_btn">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <ul class="nav-group hidden">
                <li>
                    <a href="#">카테1</a>
                </li>
                <li>
                    <a href="#" class="current">카테2</a>
                </li>
                <li>
                    <a href="#" class="mypage"> {{ Auth::user()->name }} ▼ </a>
                    <div class="sub_menu hidden">
                        <ul>
                            <li><a href="#">마이페이지</a></li>
                            @if( Auth::user()->permission == 0 )
                            <li><a href="#">관리자페이지</a></li>
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
            </ul>
            
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/additional-methods.js"></script>
    <script type="text/javascript" src="/js/messages_ko.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>
