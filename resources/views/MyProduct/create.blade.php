@extends('layouts.layout')

@section('content')
    <div class="page mypage">
        @include('layouts.myLayout') 
        <div class="form">
            <h2>상품 등록</h2>
            <form class="ShopApply" method="POST" action="{{ url('/myproduct') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="shop-group group">
                    <h3>상품 정보 입력</h3>
                    <div class="form-group half-layout">
                        <label for="name">상품 이름</label>
                        <input type="text" name="name" class="input product_name required" value="{{ old('name') }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="image">상품 이미지</label>
                        <input type="file" name="image" class="input required" value="{{ old('image') }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="url">상품 URL</label>
                        <input type="text" name="url" class="input required" value="{{ old('url') }}"/>
                    </div>
                    <div class="form-group half-layout">
                        <label for="price">상품 가격</label>
                        <input type="text" name="price" class="input required" value="{{ old('price') }}"/>
                        <span>원</span>
                    </div>
                    <h3>상품 사양 입력</h3>
                    <div class="form-group half-layout">
                        <h4>CPU</h4>
                        <label for="cpu" class="hidden">CPU</label>
                        <select name="cpu" class="required">
                            <option>선택</option>
                            @foreach( $cpus as $cpu )
                                <option value="{{ $cpu->name }}">{{ $cpu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group half-layout">
                        <h4>VGA</h4>
                        <label for="vga" class="hidden">VGA</label>
                        <select name="vga" class="required">
                            <option>선택</option>
                            @foreach( $vgas as $vga )
                                <option value="{{ $vga->name }}">{{ $vga->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group semi-layout">
                        <h4>RAM</h4>
                        <label for="ram" class="hidden">RAM</label>
                        <input type="text" name="ram" class="input required" value="{{ old('ram') }}"/>
                        <span>GB</span>
                    </div>
                    <div class="form-group semi-layout">
                        <h4>SSD</h4>
                        <label for="ssd" class="hidden">SSD</label>
                        <input type="text" name="ssd" class="input required" value="{{ old('ssd') }}"/>
                        <span>GB</span>
                    </div>
                    <div class="form-group semi-layout">
                        <h4>HDD</h4>
                        <label for="hdd" class="hidden">HDD</label>
                        <input type="text" name="hdd" class="input required" value="{{ old('hdd') }}"/>
                        <span>GB</span>
                    </div>
                    <div class="form-group semi-layout">
                        <h4>POWER</h4>
                        <label for="power" class="hidden">Power</label>
                        <input type="text" name="power" class="input required" value="{{ old('power') }}"/>
                        <span>W</span>
                    </div>
                    <div class="form-group triple-layout">
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
                    </div>
                    <div class="form-group triple-layout">
                        <h4>OVERCLOCK</h4>
                        <ul>
                            <li>
                                <label for="no-overclock">없음</label>
                                <input type="radio" name="overclock" id="no-overclock" class="input required" value="0" checked/>
                            </li>
                            <li>
                                <label for="yes-overclock">있음</label>
                                <input type="radio" name="overclock" id="yes-overclock" class="input required" value="1"/>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group triple-layout">
                        <h4>모니터</h4>
                        <input type="text" name="monitor" class="input" value="{{ old('power') }}"/>
                        <span>inch</span>
                    </div>
                    <div class="form-group one-layout">
                        <h4>카테고리</h4>
                        <ul>
                            @foreach( $categories as $category )
                            <li>
                                <label for="{{ 'category' . $category->id }}">{{ $category->name }}</label>
                                <input type="checkbox" name="category[]" id="{{ 'category' . $category->id }}" value="{{ $category->id }}">
                            </li>
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