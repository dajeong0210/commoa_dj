@extends('layouts.admin')

@section('content')
    <div class="page list mypage admin">
        @include('layouts.adminMenu') 
        <div class="search-wrap">
            <form method="GET" name="searchForm">
                <div class="search-form">
                    <label for="search" class="search"><i class="fa fa-search" aria-hidden="true"></i><span class="hidden">검색</span></label>
                    <input type="text" id="search" name="search" placeholder="Search users By name" @if( $search )value="{{ $search }}"@endif/>
                </div>
                <div class="sortBy hidden">
                    <input type="text" id="sortBy" name="user-sort" class="input" value=""/>
                </div>
            </form>
        </div>
        <div class="wrap">
            <div class="sort-wrap">
                <ul class="sort-list">
                    <li name="" class="{{ isset($_GET['user-sort'])? $_GET['user-sort'] == '' ? 'active' : '' : 'active' }}">전체</li>
                    <li name="일반회원" class="{{ isset($_GET['user-sort'])? $_GET['user-sort'] == '일반회원' ? 'active' : '' : '' }}">일반회원</li>
                    <li name="쇼핑몰회원" class="{{ isset($_GET['user-sort'])? $_GET['user-sort'] == '쇼핑몰회원'? 'active' : '' : '' }}">쇼핑몰회원</li>
                </ul>
            </div>
        </div>
        <div class="user-list">
            <table>
                <colgroup>
                    <col style="width:4%">
                    <col span="2" style="width:35%">
                    <col span="2" style="width:13%">
                </colgroup>
                <tr>
                    <th></th>
                    <th>이름</th>
                    <th>이메일</th>
                    <th>가입일</th>
                    <th>권한</th>
                </tr>
            @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ url('/admin/user'). '/' . $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ explode( " ", $user->created_at)[0] }}</td>
                    @if( $user->permission == 0 ) 
                        <td>일반</td>
                    @elseif( $user->permission == 1 )
                        @if( $user->shop )
                        <td class="shop">{{ $user->shop->name }}</td>
                        @else
                        <td>권한▼</td>
                        @endif
                    @else 
                        <td class="admin">관리자</td>
                    @endif
                </tr>
            @endforeach
            </table>
        </div>
        <div class="pagination">
            {{ $users->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection