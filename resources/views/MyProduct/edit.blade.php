@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form">
            <h2>상품 정보 수정</h2>
            <form class="prodEdit validate" method="POST" action="{{ url('/myproduct') . '/' . $product->id }}" enctype="multipart/form-data">
            {{ method_field('put') }}
            {{ csrf_field() }}
                <div class="shop-group group">
                    <h3>상품 정보 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                        <label for="name">상품 이름</label>
                        <input type="text" name="name" class="input product_name required" value="{{ $product->name }}"/>
                        @if( $errors->has('product_name') )
                        <label class="error">{{ $errors->first('product_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout">
                        <label for="image">상품 이미지</label>
                        <input type="file" name="image" class="input image" value=""/>
                        <div class="image-logo">
                            <img src="{{ $product->image }}" alt="">
                        </div>
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url">상품 URL</label>
                        <input type="text" name="url" class="input required" value="{{ $product->url }}"/>
                        @if( $errors->has('url') )
                        <label class="error">{{ $errors->first('url') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price">상품 가격</label>
                        <input type="text" name="price" class="input digits required" value="{{ $product->price }}"/>
                        <span>원</span>
                        @if( $errors->has('price') )
                        <label class="error">{{ $errors->first('price') }}</label>
                        @endif
                    </div>
                    <h3>상품 사양 입력</h3>
                    <div class="form-group half-layout form-group{{ $errors->has('cpu') ? ' has-error' : '' }}">
                        <h4>CPU</h4>
                        <label for="cpu" class="hidden">CPU</label>
                        <select name="cpu" class="required" required>
                            @foreach( $cpus as $cpu )
                                @if( $product->cpu_id == $cpu->id )
                                    <option value="{{ $cpu->id }}" selected>{{ $cpu->name }}</option>
                                @else
                                    <option value="{{ $cpu->id }}">{{ $cpu->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if( $errors->has('user_email') )
                        <label class="error">{{ $errors->first('cpu') }}</label>
                        @endif
                    </div>
                    <div class="form-group half-layout form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                        <h4>VGA</h4>
                        <label for="vga" class="hidden">VGA</label>
                        <select name="vga" required>
                            @foreach( $vgas as $vga )
                                @if( $product->vga_id == $vga->id )
                                    <option value="{{ $vga->id }}">{{ $vga->name }}</option>
                                @else
                                    <option value="{{ $vga->id }}">{{ $vga->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if( $errors->has('vga') )
                        <label class="error">{{ $errors->first('vga') }}</label>
                        @endif
                    </div>
                    <div class="form-group semi-layout form-group{{ $errors->has('ram') ? ' has-error' : '' }}">
                        <h4>RAM</h4>
                        <label for="ram" class="hidden">RAM</label>
                        <input type="text" name="ram" class="input digits required" value="{{ $product->ram }}"/>
                        <span>GB</span>
                        @if( $errors->has('ram') )
                        <label class="error">{{ $errors->first('ram') }}</label>
                        @endif
                    </div>
                    <div class="form-group semi-layout form-group{{ $errors->has('ssd') ? ' has-error' : '' }}">
                        <h4>SSD</h4>
                        <label for="ssd" class="hidden">SSD</label>
                        <input type="text" name="ssd" class="input digits required" value="{{ $product->ssd }}"/>
                        <span>GB</span>
                        @if( $errors->has('ssd') )
                        <label class="error">{{ $errors->first('ssd') }}</label>
                        @endif
                    </div>
                    <div class="form-group semi-layout form-group{{ $errors->has('hdd') ? ' has-error' : '' }}">
                        <h4>HDD</h4>
                        <label for="hdd" class="hidden">HDD</label>
                        <input type="text" name="hdd" class="input digits required" value="{{ $product->hdd }}"/>
                        <span>GB</span>
                        @if( $errors->has('hdd') )
                        <label class="error">{{ $errors->first('hdd') }}</label>
                        @endif
                    </div>
                    <div class="form-group semi-layout form-group{{ $errors->has('power') ? ' has-error' : '' }}">
                        <h4>POWER</h4>
                        <label for="power" class="hidden">Power</label>
                        <input type="text" name="power" class="input digits required" value="{{ $product->power }}"/>
                        <span>W</span>
                        @if( $errors->has('power') )
                        <label class="error">{{ $errors->first('power') }}</label>
                        @endif
                    </div>
                    <div class="form-group triple-layout form-group{{ $errors->has('os') ? ' has-error' : '' }}">
                        <h4>OS</h4>
                        <ul>
                            <li>
                                <label for="no-os">없음</label>
                                <input type="radio" name="os" id="no-os" class="input required" value="0" checked/>
                            </li>
                            <li>
                                <label for="yes-os">있음</label>
                                <input type="radio" name="os" id="yes-os" class="input required" value="1"/>
                            </li>
                        </ul>
                        @if( $errors->has('os') )
                        <label class="error">{{ $errors->first('os') }}</label>
                        @endif
                    </div>
                    <div class="form-group triple-layout form-group{{ $errors->has('overclock') ? ' has-error' : '' }}">
                        <h4>OVERCLOCK</h4>
                        <ul>
                            <li>
                                <label for="no-overclock">불가</label>
                                <input type="radio" name="overclock" id="no-overclock" class="input required" value="0" checked/>
                            </li>
                            <li>
                                <label for="yes-overclock">가능</label>
                                <input type="radio" name="overclock" id="yes-overclock" class="input required" value="1"/>
                            </li>
                        </ul>
                        @if( $errors->has('overclock') )
                        <label class="error">{{ $errors->first('overclock') }}</label>
                        @endif
                    </div>
                    <div class="form-group triple-layout form-group{{ $errors->has('monitor') ? ' has-error' : '' }}">
                        <h4>모니터</h4>
                        <input type="text" name="monitor" class="input digits" value="{{ $product->monitor == NULL ? '' : $product->monitor }}"/>
                        <span>inch</span>
                        @if( $errors->has('monitor') )
                        <label class="error">{{ $errors->first('monitor') }}</label>
                        @endif
                    </div>
                    <div class="form-group one-layout">
                        <h4>카테고리</h4>
                        <ul>
                            @foreach( $categories as $category )
                                @if( in_array( $category->id, $selected ) )
                                    <li>
                                        <label for="{{ 'category' . $category->id }}">{{ $category->name }}</label>
                                        <input type="checkbox" name="category[]" id="{{ 'category' . $category->id }}" value="{{ $category->id }}" checked="checked">
                                    </li>                                    
                                @else
                                    <li>
                                        <label for="{{ 'category' . $category->id }}">{{ $category->name }}</label>
                                        <input type="checkbox" name="category[]" id="{{ 'category' . $category->id }}" value="{{ $category->id }}">
                                    </li>
                                @endif
                            @endforeach
                            <p>※ 중복 선택 가능합니다.</p>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="등록하기" class="submit"/>
                </div>
            </form>
        </div>
    </div>
@endsection