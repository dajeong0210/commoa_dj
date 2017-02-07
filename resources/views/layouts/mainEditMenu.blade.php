<nav class="tab-nav">
    <ul>
        <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'banner' ? 'active' : '' }}"><a href="{{ url('/admin/banner') }}">메인슬라이드</a></li>
        <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'recommend' ? 'active' : '' }}"><a href="{{ url('/admin/recommend') }}">추천상품</a></li>
    </ul>
</nav>
