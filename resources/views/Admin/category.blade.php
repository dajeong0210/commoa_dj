@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu')
        <div class="category">
            <h2>카테고리편집</h2>
            <ul>
            @foreach( $categories as $category )
                <li>
                    <span>└</span>
                    <span class="hidden">{{ $category->id  }}</span>
                    <em class="name">{{ $category->name }}</em>
                    <form method="POST" name="modify{{ $catrgory->id }}" action="{{ url('/admin/category') . '/' . $category->id }}">
                    <input type="text" class="modify hidden" value="{{ $category->name }}">
                    </form>
                    <a href="#" class="delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <form name="delete" class="hidden" method="POST" action="{{ url('/admin/category') . '/' . $category->id }}">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                    </form>
                </li>
            @endforeach
            </ul>
            <input type="submit" value="수정" class="modify-btn">
            <!---
            <form method="POST" name="modify" action="{{ url('/admin/category') }}">
                @foreach( $categories as $category )
                <input type="hidden" class="modify hidden" name="category{{ $category->id }}" value="{{ $category->name }}">
                @endforeach
                <input type="submit" value="수정" class="modify-btn">
            </form>
            -->
        </div>
    </div>
@endsection