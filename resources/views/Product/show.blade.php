@extends('layouts.layout')

@section('content')
    <div class="page list mypage">
        <ul class="myProduct">
            <li>
                <div class="image-box">
                    <a href="{{ $product->url }}">
                        <img src="{{ $product->image }}" alt="">
                    </a>
                </div>
                <div class="mydetail-box">
                    <a class="myprod-title" href="{{ $product->url }}"> {{ $product->name }} </a>
                    <p class="myprod-price">\{{ number_format($product->price) }}원
                    </p>
                    <ul>
                        <li><span>cpu</span> {{ $product->cpu->name }}<span></span></li>
                        <li><span>vga</span> {{ $product->vga->name }}<span></span></li>
                        <li><span>ram</span> {{ $product->ram }}<span></span></li>
                        <li><span>ssd</span> {{ $product->ssd }}<span></span></li>
                        <li><span>hdd</span> {{ $product->hdd }}<span></span></li>
                        <li><span>power</span> {{ $product->power }}<span></span></li>
                        <li>
                            <span>os</span>
                            @if( $product->os == 1 )
                                Windows설치
                            @else
                                없음
                            @endif
                        </li>
                        <li>
                            <span>overclock</span>
                            @if( $product->overclock == 1 )
                                가능
                            @else
                                불가능
                            @endif
                        </li>
                        <li>
                            <span>monitor</span>
                            @if( $product->monitor == '' )
                                없음
                            @else
                                {{ $product->monitor }}인치
                            @endif
                        </li>
                        </tr>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="button-group">
            <a href="{{ $product->url }}" class="url" target="_blank">사이트 이동</a>
            <input type="hidden" class="product-id" value="{{ $product->id }}">
        </div>
    </div>
    <script type="text/javascript">
        //Product view count
        $('a.url').on('click',function() {
            var productId = $('.product-id').val();
            alert(productId);
            viewcount( productId );
        });

        function viewcount( product_id) {
            
            var formData = { 'product_id' : product_id };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "viewcount/" + product_id,
                type: "POST",
                data: formData, 
                success: function(data){
                    alert(data);
                },
                error: function(responseData, textStatus){
                    alert(textStatus);
                }
            });
        }
    </script>
@endsection