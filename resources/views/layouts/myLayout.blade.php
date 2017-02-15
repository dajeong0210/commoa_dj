<nav class="tab-nav mypage">
    <ul>
        <li class="{{ Request::segment(1) == 'mypage' ? 'active' : '' }}"><a href="{{ url('/mypage') }}">메인</a></li>
        <li class="{{ Request::segment(1) == 'myinfo' ? 'active' : '' }}"><a href="{{ url('/myinfo') }}">정보수정</a></li>
        <li class="{{ Request::segment(1) == 'bookmark' ? 'active' : '' }}"><a href="{{ url('/bookmark') }}">찜한쇼핑몰</a></li>
        <li class="{{ Request::segment(1) == 'favorite' ? 'active' : '' }}"><a href="{{ url('/favorite') }}">찜한상품</a></li>
        @if( Auth::user()->permission == '1' && Auth::user()->shop )
            <li class="{{ Request::segment(3) == 'edit' && Request::segment(1) == 'shop' ? 'active' : '' }}"><a href="{{ url('/shop') . '/' . Auth::user()->shop->id . '/edit' }}">Shop정보수정</a></li>
            <li class="{{ Request::segment(1) == 'myproduct' ? 'active' : '' }}"><a href="{{ url('/myproduct') }}">상품관리</a></li>
        @endif
    </ul>
</nav>
