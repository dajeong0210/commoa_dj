@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu') 
        <div class="sort-group">
            <div class="sort-wrap shop">
            <ul class="sort-list">
                <li name="all" class="all {{ isset($_GET['shop-sort'])? $_GET['shop-sort'] == 'all' ? 'active' : '' : 'active' }}">최신순</li>
                <li name="nameBy" class="nameBy {{ isset($_GET['shop-sort'])? $_GET['shop-sort'] == 'nameBy'? 'active' : '' : '' }}">이름순</li>
            </ul>
            <form method="GET" class="hidden">
                <div class="sortBy">
                    <input type="text" id="sortBy" name="shop-sort" class="input" value="all"/>
                </div>
            </form>
            </div>
        </div>
        <ul class="list-group">
            @foreach( $shops as $shop )
            <li class="shop">
                <div class="img-box shop" style="background:url({{ $shop->image }}) center no-repeat; background-size:auto 100%">
                </div>
                <div class="detail-box" id="shop">
                    <p class="shop-name"> {{ $shop->name }} </p>
                    <a href="{{ url('admin/shop').'/'. $shop->id .'/edit' }}" class="shop-url" > 쇼핑몰 정보 수정 </a>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $shops->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection