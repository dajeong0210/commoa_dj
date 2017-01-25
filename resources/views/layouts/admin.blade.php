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
        <nav class="nav-bar admin-nav">
            <h1>
                <a href="{{ url('/') }}">
                    <img src="{{ url('/') . '/image/commoa_logo.png' }}" alt="컴모아">
                </a>
            </h1>
            <a href="#" class="menu_btn">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
            <p>
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/mypage') }}">Mypage</a>
            </p>
            <ul class="nav-group admin">
                <li>
                    <a href="{{ url('/apply') }}">쇼핑몰신청관리</a>
                </li>
                <li>
                    <a href="{{ url('/admin/category') }}">카테고리편집</a>
                </li>
                <li>
                    <a href="{{ url('/admin/cpu-vga') }}">CPU/VGA편집</a>
                </li>
            </ul>
        </nav>
        <nav class="user-nav">
            <ul>
                <li>관리자페이지</li>
                <li>{{ Auth::user()->name }}님</li>
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
        </nav>
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/adminScript.js"></script>
</body>
</html>