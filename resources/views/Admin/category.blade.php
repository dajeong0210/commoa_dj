@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu')
        <div class="wrap">
            <div class="cpu-vga category">
                <h2>카테고리편집</h2>
                <ul>
                <li><i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>컴모아</strong></li>
                @foreach( $categories as $category )
                    <li class="category">
                        <span>└</span>
                        <span class="hidden">{{ $category->id  }}</span>
                        <a href="#" class="name">{{ $category->name }}<span class="count"> ( {{ $category->products()->count() }} )  </span></a>
                        <input type="text" class="modify hidden" value="{{ $category->name }}">
                        <a href="#" class="delete">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <form name="delete" class="hidden delete{{$category->id}}" method="POST" action="{{ url('/admin/category') . '/' . $category->id }}">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endforeach
                </ul>
                <form method="POST" name="create" action="{{ url('/admin/category/create') }}">
                {{ method_field('put') }}
                {{ csrf_field() }}
                    <span>└</span>
                    <a href="#" class="create">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    </a>
                    <input type="text" name="create" class="create hidden">
                </form>
            </div>
            <div class="cpu-vga category form">
                <form method="POST" name="categoryForm" action="{{ url('category') }}">
                {{ csrf_field() }}
                    <h3>카테고리 :: 추가하기 </h3>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label for="category_name">이름</label>
                            <input type="text" name="category_name" value=""/>
                            @if($errors->has('category_name'))
                            <label class="error">
                                <strong>{{ $errors->first('category_name') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('category_image') ? ' has-error' : '' }}">
                            <label for="category_image">브랜드</label>
                            <input type="file" name="category_image"/>
                            @if($errors->has('category_image'))
                            <label class="error">
                                <strong>{{ $errors->first('category_image') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <input type="submit" class="btn submit category-edit" value="추가하기"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection