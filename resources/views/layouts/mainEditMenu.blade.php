<nav class="tab-nav">
    <ul>
        <li class="mainEdit {{ Request::segment(1) == 'admin' && Request::segment(2) == 'banner' ? 'active' : '' }}"><a href="{{ url('/admin/banner') }}">메인슬라이드</a></li>
        <li class="mainEdit {{ Request::segment(1) == 'admin' && Request::segment(2) == 'advertisement' ? 'active' : '' }}"><a href="{{ url('/admin/advertisement') }}">광고배너</a></li>
        <li class="mainEdit {{ Request::segment(1) == 'admin' && Request::segment(2) == 'recommend' ? 'active' : '' }}"><a href="{{ url('/admin/recommend') }}">추천상품</a></li>
    </ul>
</nav>
