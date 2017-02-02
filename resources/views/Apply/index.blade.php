@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu') 
        <div class="sort-group">
            <div class="sort-wrap shop">
            <ul class="sort-list apply">
                <form method="GET" name="sortApply">
                    <li name="전체" class="{{ isset($_GET['apply'])? $_GET['apply'] == '전체'? 'active' : '' : 'active' }}">전체</li>
                    <li name="미승인" class="{{ isset($_GET['apply'])? $_GET['apply'] == '미승인'? 'active' : '' : '' }}">미승인</li>
                    <li name="승인" class="{{ isset($_GET['apply'])? $_GET['apply'] == '승인'? 'active' : '' : '' }}">승인</li>
                    <li class="hidden">
                        <input type="hidden" id="sortBy" name="apply" val=""/>
                    </li>
                </form>
            </ul>
            </div>
        </div>
 
        <div class="apply-list">
            <ul class="myProduct">
                @foreach( $applies as $apply )
                <li class="{{ $apply->permission == 1 ? 'done' : '' }}">
                    <p><span>아이디</span>{{ $apply->user_email }}</p>
                    <p><span>샵이름</span>{{ $apply->shop_name }}</p>
                    @if( $apply->permission == 0 ) 
                    <p style="color:red"><span>승인여부</span>미승인</p>
                    @else 
                    <p style="color:green"><span>승인여부</span>승인</p>
                    @endif
                    <p><a href="{{ url('/apply').'/'.$apply->id }}">보기</a></p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="pagination">
            {{ $applies->links() }}
        </div>
    </div>
@endsection