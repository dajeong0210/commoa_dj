@extends('layouts.layout')

@section('content')
    <div class="page list mypage">
        @include('layouts.myLayout') 
        <ul class="myProduct">
            @foreach( $applies as $apply )
            <li>
                <div class="mydetail-box">
                    <table>
                        <tr>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="mybutton">
                    <form class="myprod-del" method="POST" action="{{ url('/myproduct') . '/' . $product->id }}" enctype="multipart/form-data">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                        <div class="button-group">
                            <a href="{{ url('myproduct').'/'. $product->id .'/edit' }}" class="modify">수정</a>
                            <input type="submit" value="삭제" class="delete"/>
                        </div>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="pagination">
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection