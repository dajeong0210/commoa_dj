<nav class="tap-nav">
    <ul>
        <li class="{{ Request::segment(1) == 'mypage' ? 'active' : '' }}"><a href="{{ url('/mypage') }}">메인</a></li>
        <li class="{{ Request::segment(1) == 'myinfo' ? 'active' : '' }}"><a href="{{ url('/myinfo') }}">정보수정</a></li>
        @if( Auth::user()->permission == '1' || Auth::user()->permission == '0' )
        <li class="{{ Request::segment(1) == 'bookmark' ? 'active' : '' }}"><a href="{{ url('/bookmark') }}">북마크</a></li>
        <li class="{{ Request::segment(1) == 'favorite' ? 'active' : '' }}"><a href="{{ url('/favorite') }}">찜한상품</a></li>
        @endif
        @if( Auth::user()->permission == '1' && Auth::user()->shop )
            <li class="{{ Request::segment(3) == 'edit' && Request::segment(1) == 'shop' ? 'active' : '' }}"><a href="{{ url('/shop') . '/' . Auth::user()->shop->id . '/edit' }}">Shop정보수정</a></li>
            <li class="{{ Request::segment(1) == 'myproduct' ? 'active' : '' }}"><a href="{{ url('/myproduct') }}">상품관리</a></li>
        @endif
        @if( Auth::user()->permission == '2' )
            <li class="{{ Request::segment(2) == 'user' ? 'active' : '' }}"><a href="{{ url('/admin/user') }}">유저관리</a></li>
            <li class="{{ Request::segment(2) == 'shop' ? 'active' : '' }}"><a href="{{ url('/admin/shop') }}">샵관리</a></li>
            <li class="{{ Request::segment(2) == 'product' ? 'active' : '' }}"><a href="{{ url('/admin/product') }}">상품관리</a></li>
            <li class="{{ Request::segment(1) == 'apply' ? 'active' : '' }}"><a href="{{ url('/apply') }}">입점승인</a></li>
        @endif
    </ul>
</nav>
