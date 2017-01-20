@extends('layouts.layout')

@section('content')
    <div class="page list mypage">
        <div class="mydetail-box">
            <table class="table">
                <tr>
                    <td>#</td>
                    <td>이메일</td>
                    <td>Shop이름</td>
                    <td></td>
                </tr>
                @foreach( $applies as $apply )
                <tr>
                    <td>{{ $apply->id }}</td>
                    <td>{{ $apply->user_email }}</td>
                    <td>{{ $apply->shop_name }}</td>
                    <td>
                        <div class="mybutton">
                            <div class="button-group">
                                <a href="{{ url('apply').'/'. $apply->id }}" class="modify">보기</a>
                            </div>
                        </div>  
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="pagination">
            {{ $applies->links() }}
        </div>
    </div>
@endsection