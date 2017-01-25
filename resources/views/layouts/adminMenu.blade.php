<nav class="tab-nav">
    <ul>
        <li><a href="{{ url('/admin') }}">메인</a></li>
        <li class="{{ Request::segment(1) == 'apply' && Request::segment(2) != 'create' && Request::segment(3) != 'edit'  ? 'active' : '' }}"><a href="{{ url('/apply') }}">신청관리</a></li>
        <li class="{{ Request::segment(2) == 'category' ? 'active' : '' }}"><a href="{{ url('/admin/category') }}">카테고리</a></li>
        <li class="{{ Request::segment(2) == 'cpu-vga' ? 'active' : '' }}"><a href="{{ url('/admin/cpu-vga') }}">CPU/VGA</a></li>
        @if( Auth::user()->permission == '1' && Auth::user()->shop )
            <li class="{{ Request::segment(3) == 'edit' && Request::segment(1) == 'shop' ? 'active' : '' }}"><a href="{{ url('/shop') . '/' . Auth::user()->shop->id . '/edit' }}">Shop정보수정</a></li>
            <li class="{{ Request::segment(1) == 'myproduct' ? 'active' : '' }}"><a href="{{ url('/myproduct') }}">상품관리</a></li>
        @endif
    </ul>
</nav>
