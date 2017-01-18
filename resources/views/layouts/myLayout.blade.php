<nav class="tap-nav">
    <ul>
        <li class="{{ Request::segment(1) == 'user' && !Request::segment(3) ? 'active' : '' }}"><a href="{{ url('/user') . '/' . Auth::user()->id }}">메인</a></li>
        <li class="{{ Request::segment(3) == 'edit' ? 'active' : '' }}"><a href="{{ url('/user') . '/' . Auth::user()->id . '/edit' }}">개인정보수정</a></li>
        <li class="{{ Request::segment(1) == 'bookmark' ? 'active' : '' }}"><a href="{{ url('/bookmark') }}">북마크</a></li>
        <li class="{{ Request::segment(1) == 'favorite' ? 'active' : '' }}"><a href="{{ url('/favorite') }}">찜한상품</a></li>
        @if( Auth::user()->permission == '1' )
        <li><a href="{{ url('/shop') . '/' . Auth::user()->shop()->id . '/edit' }}">Shop정보수정</a></li>
        <li><a href="{{ url('/shop') . '/' . Auth::user()->shop()->id . '/edit' }}">상품관리</a></li>
        @endif
    </ul>
</nav>
