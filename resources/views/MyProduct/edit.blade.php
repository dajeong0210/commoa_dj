@extends('layouts.layout')

@section('content')
    <div class="page shop-apply">
        <h1>상품 수정 페이지</h1>
        <form class="ShopApply" method="POST" action="{{ url('/myproduct') . '/' . $product->id }}" enctype="multipart/form-data">
        {{ method_field('put') }}
        {{ csrf_field() }}
            <div class="shop-group group">
                <h2>상품 정보 입력</h2>
                <div class="form-group half-layout">
                    <label for="name">상품 이름</label>
                    <input type="text" name="name" class="input product_name required" value="{{ $product->name }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="image">상품 이미지</label>
                    <input type="file" name="image" class="input product_url required" value="{{ $product->image }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="url">상품 URL</label>
                    <input type="text" name="url" class="input product_url required" value="{{ $product->url }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="price">가격</label>
                    <input type="text" name="price" class="input product_url required" value="{{ $product->price }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="cpu">CPU</label>
                    <input type="text" name="cpu" class="input product_url required" value="{{ $product->cpu_id }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="vga">VGA</label>
                    <input type="text" name="vga" class="input product_url required" value="{{ $product->vga_id }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="os">OS 유무</label>
                    <input type="text" name="os" class="input product_url required" value="{{ $product->os }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="ram">RAM</label>
                    <input type="text" name="ram" class="input product_url required" value="{{ $product->ram }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="ssd">SSD</label>
                    <input type="text" name="ssd" class="input product_url required" value="{{ $product->ssd }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="hdd">HDD</label>
                    <input type="text" name="hdd" class="input product_url required" value="{{ $product->hdd }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="overclock">Overclock</label>
                    <input type="text" name="overclock" class="input product_url required" value="{{ $product->overclock }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="power">Power</label>
                    <input type="text" name="power" class="input product_url required" value="{{ $product->power }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="monitor">모니터</label>
                    <input type="text" name="monitor" class="input product_url required" value="{{ $product->monitor }}"/>
                </div>
                <div class="form-group half-layout">
                    <label for="category">카테고리</label>
                    <input type="checkbox" name="category[]" value="1"> 사무용
                    <input type="checkbox" name="category[]" value="2"> 게임용
                    <input type="checkbox" name="category[]" value="3"> 디자인용
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="수정하기" class="submit"/>
            </div>
        </form>
         <form class="ShopApply" method="POST" action="{{ url('/myproduct') . '/' . $product->id }}" enctype="multipart/form-data">
        {{ method_field('delete') }}
        {{ csrf_field() }}
            <div class="form-group">
                <input type="submit" value="삭제하기" class="submit"/>
            </div>
        </form>
    </div>
@endsection