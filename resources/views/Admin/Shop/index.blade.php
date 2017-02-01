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
                    <input type="text" id="sortBy_rank" name="shop-sort" class="input" value="all"/>
                </div>
            </form>
        </div>
        </div>
        <ul class="list-group">
            @foreach( $shops as $shop )
            <li class="shop">
                <a href="{{ url('admin/shop') . '/' . $shop->id .'/edit' }}" >
                <div class="img-box shop">
                    <img src="{{ $shop->image }}" alt="">
                </div>
                </a>
                <div class="detail-box" id="shop">
                    <a class="prod-title shop" href="{{ url('admin/shop').'/'. $shop->id .'/edit' }}"> {{ $shop->name }} </a>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $shops->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection