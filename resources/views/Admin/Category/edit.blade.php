@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu')
        <div class="wrap">
            <div class="cpu-vga category">
                <h2>카테고리편집</h2>
                <ul>
                <li>
                    <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>컴모아</strong>
                </li>
                <li>
                    <span>└</span>
                    <a href="#" class="folder">
                    <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>용도별</strong>
                    </a>
                </li>
                <li>
                    <ul>
                        @foreach( $categories->where('sort', '=', '0') as $category )
                            <li class="category">
                                <span>└</span>
                                <span class="hidden">{{ $category->id  }}</span>
                                <a href="#" class="name">{{ $category->name }}<span class="count"> ( {{ $category->products()->count() }} )  </span></a>
                                <input type="text" class="modify hidden" value="{{ $category->name }}">
                                <a href="#" class="del">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <form name="delete" class="hidden category{{$category->id}}" method="POST" action="{{ url('/category') . '/' . $category->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <span>└</span>
                    <a href="#" class="folder">
                    <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>게임별분류</strong>
                    </a>
                </li>
                <li>
                    <ul>
                        @foreach( $categories->where('sort', '<>', '0') as $category )
                            @if( $category->sort != NULL )
                                <li class="category">
                                    <span>└</span>
                                    <span class="hidden">{{ $category->id  }}</span>
                                    <a href="#" class="name">
                                        <i class="fa fa-star major" aria-hidden="true"></i> {{ $category->name }}<span class="count"> ( {{ $category->products()->count() }} )  </span></a>
                                    <input type="text" class="modify hidden" value="{{ $category->name }}">
                                    <a href="#" class="del">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    <form name="delete" class="hidden category{{$category->id}}" method="POST" action="{{ url('/category') . '/' . $category->id }}">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        @endforeach
                        @foreach( $categories->where('sort', '<>', '0') as $category )
                            @if( $category->sort == NULL )
                                <li class="category">
                                    <span>└</span>
                                    <span class="hidden">{{ $category->id  }}</span>
                                    <a href="#" class="name">{{ $category->name }}<span class="count"> ( {{ $category->products()->count() }} )  </span></a>
                                    <input type="text" class="modify hidden" value="{{ $category->name }}">
                                    <a href="#" class="del">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    <form name="delete" class="hidden category{{$category->id}}" method="POST" action="{{ url('/category') . '/' . $category->id }}">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                </ul>
                <li class="folder">
                    <span>└</span>
                    <a href="#" class="create">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> 추가
                    </a>
                    <input type="text" name="create" class="create hidden">
                </li>
            </div>
            <div class="cpu-vga category form">
                <form method="POST" class="validate" name="categoryForm" action="{{ url('category') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <h3>카테고리 :: 추가하기 </h3>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label for="category_name">이름</label>
                            <input type="text" id="category_name" name="category_name" value="{{ old('category_name') }}" required/>
                            @if($errors->has('category_name'))
                            <label class="error">
                                <strong>{{ $errors->first('category_name') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group image">
                        <div class="form-group one-layout form-group{{ $errors->has('category_image') ? ' has-error' : '' }}">
                            <label for="category_image">이미지</label>
                            <input type="file" name="category_image" id="category_image" class="image"/>
                            <div class="img-preview hidden">
                                <div class="img-box"></div>
                            </div>
                            @if($errors->has('category_image'))
                            <label class="error">
                                <strong>{{ $errors->first('category_image') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group image">
                        <div class="form-group one-layout form-group{{ $errors->has('category_sort') ? ' has-error' : '' }}">
                            <label for="category_sort">이미지 표시</label>
                            <input type="checkbox" name="category_sort" class="category_sort"/>
                            <p class="warning">※상품페이지에 총 4개까지만 보입니다.</p>
                            @if($errors->has('category_sort'))
                            <label class="error">
                                <strong>{{ $errors->first('category_sort') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group color">
                        <div class="form-group one-layout form-group{{ $errors->has('category_color') ? ' has-error' : '' }}">
                            <label for="category_color">색상코드</label>
                            <input type="text" name="category_color" id="category_color" placeholder="6자리 색상코드를 입력해주세요. (ex.#000000)"/>
                            @if($errors->has('category_color'))
                            <label class="error">
                                <strong>{{ $errors->first('category_color') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group game">
                        <div class="form-group one-layout form-group{{ $errors->has('min_cpu') ? ' has-error' : '' }}">
                            <label for="min_cpu">최소 프로세서</label>
                            <input type="text" name="min_cpu" id="min_cpu" class="multiple" value=""/>
                                @if($errors->has('min_cpu'))
                            <label class="error">
                                <strong>{{ $errors->first('min_cpu') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('min_vga') ? ' has-error' : '' }}">
                            <label for="min_vga">최소 그래픽카드</label>
                            <textarea name="min_vga" id="min_vga" class="multiple" rows="2"/>
                            </textarea>
                            @if($errors->has('min_vga'))
                            <label class="error">
                                <strong>{{ $errors->first('min_vga') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('min_memory') ? ' has-error' : '' }}">
                            <label for="min_memory">최소 메모리</label>
                            <input type="text" name="min_memory" id="min_memory" class="digits" placeholder="숫자만 입력해주세요."/>
                            <span>GB</span>
                            @if($errors->has('min_memory'))
                            <label class="error">
                                <strong>{{ $errors->first('min_memory') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('storage') ? ' has-error' : '' }}">
                            <label for="storage">여유 저장 공간</label>
                            <input type="text" name="storage" id="storage" class="digits" placeholder="숫자만 입력해주세요."/>
                            <span>GB</span>
                            @if($errors->has('storage'))
                            <label class="error">
                                <strong>{{ $errors->first('storage') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('recommend_cpu') ? ' has-error' : '' }}">
                            <label for="recommend_cpu">권장 프로세서</label>
                            <input type="text" name="recommend_cpu" id="recommend_cpu" class="multiple"/>
                            @if($errors->has('recommend_cpu'))
                            <label class="error">
                                <strong>{{ $errors->first('recommend_cpu') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('recommend_vga') ? ' has-error' : '' }}">
                            <label for="recommend_vga">권장 그래픽카드</label>
                            <textarea name="recommend_vga" id="recommend_vga" class="multiple" rows="2"/>
                            </textarea>
                            @if($errors->has('recommend_vga'))
                            <label class="error">
                                <strong>{{ $errors->first('recommend_vga') }}</strong>
                            </label>
                            @endif
                        </div>
                        <div class="form-group one-layout form-group{{ $errors->has('recommend_memory') ? ' has-error' : '' }}">
                            <label for="recommend_memory">권장 메모리</label>
                            <input type="text" name="recommend_memory" id="recommend_memory" class="digits" placeholder="숫자만 입력해주세요."/>
                            <span>GB</span>
                            @if($errors->has('recommend_memory'))
                            <label class="error">
                                <strong>{{ $errors->first('recommend_memory') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <input type="submit" class="btn submit category-edit modify" value="추가하기"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection