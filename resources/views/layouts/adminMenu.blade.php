<nav class="tab-nav">
    <ul>
        <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'user' ? 'active' : '' }}"><a href="{{ url('/admin/user') }}">유저관리</a></li>
        <li class="{{ Request::segment(1) == 'apply' ? 'active' : '' }}"><a href="{{ url('/apply') }}">입점관리</a></li>
        <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'shop' ? 'active' : '' }}"><a href="{{ url('/admin/shop') }}">SHOP관리</a></li>
        <li class="{{ Request::segment(1) == 'admin' && Request::segment(2) == 'product' ? 'active' : '' }}"><a href="{{ url('/admin/product') }}">상품관리</a></li>
        <li class="{{ Request::segment(2) == 'category' ? 'active' : '' }}"><a href="{{ url('/admin/category') }}">카테고리</a></li>
        <li class="{{ Request::segment(2) == 'cpu-vga' ? 'active' : '' }}"><a href="{{ url('/admin/cpu-vga') }}">CPU/VGA</a></li>
    </ul>
</nav>
