@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu')
        <div class="category">
            <h2>카테고리편집</h2>
                <ul>
                @foreach( $categories as $category )
                    <li>
                        <form method="POST" name="modify" action="{{ url('/admin/category') . '/' . $category->id }}">
                            <span>└</span><em class="name">{{ $category->name }}</em>
                            <input type="text" class="modify hidden" value="{{ $category->name }}">
                            <a href="#" class="delete">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </form>
                        <form name="delete" class="hidden" method="POST" action="{{ url('/admin/category') . '/' . $category->id }}">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endforeach
                </ul>
                <button class="modify">수정</button>
        </div>
    </div>
@endsection