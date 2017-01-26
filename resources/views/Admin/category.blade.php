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
                    <input type="text" class="modify hidden" value="{{ $category->name }}">
                    <a href="#" class="delete">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <form name="delete" class="hidden" method="POST" action="{{ url('/admin/category') . '/' . $category->id }}">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                    </form>
                </li>
            @endforeach
                <li>
                    <form method="POST" name="create" action="{{ url('/admin/category') }}">
                        <span>└</span>
                        <a href="#" class="create">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                        </a>
                        <input type="text" name="create" class="create hidden">
                    </form>
                </li>
            </ul>
            <form method="POST" name="modify" action="{{ url('/admin/category/edit') }}">
            {{ method_field('put') }}
            {{ csrf_field() }}
                @foreach( $categories as $category )
                <input type="hidden" class="modify hidden" name="category{{ $category->id }}" value="{{ $category->name }}">
                @endforeach
                <input type="submit" value="저장" class="modify-btn">
            </form>
        </div>
    </div>
@endsection