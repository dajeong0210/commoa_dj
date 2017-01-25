@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        <nav class="tab-nav apply">
            <ul>
                <form method="GET" name="sortApply">
                    <li class="{{ isset($_GET['apply'])? $_GET['apply'] == '전체'? 'active' : '' : 'active' }}"><a href="#">전체</a></li>
                    <li class="{{ isset($_GET['apply'])? $_GET['apply'] == '미승인'? 'active' : '' : '' }}"><a href="#">미승인</a></li>
                    <li class="{{ isset($_GET['apply'])? $_GET['apply'] == '승인'? 'active' : '' : '' }}"><a href="#">승인</a></li>
                    <li class="hidden">
                        <input type="hidden" name="apply" val=""/>
                    </li>
                </form>
            </ul>
        </nav>
        <div class="category">
            <ul>
            @foreach( $categories as $category )
                <li>
                    <span>└</span>{{ $category->name }}
                    <a href="#" class="delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection