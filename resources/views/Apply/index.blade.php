@extends('layouts.layout')

@section('content')
    <div class="page list admin">
        <div class="apply-list">
            <ul class="myProduct">
                @foreach( $applies as $apply )
                <li class="{{ $apply->permission == 1 ? 'done' : '' }}">
                    <p><span>아이디</span>{{ $apply->user_email }}</p>
                    <p><span>샵이름</span>{{ $apply->shop_name }}</p>
                    @if( $apply->permission == 0 ) 
                    <p style="color:red"><span>승인여부</span>미승인</p>
                    @else 
                    <p style="color:green"><span>승인여부</span>승인</p>
                    @endif
                    <p><a href="{{ url('/apply').'/'.$apply->id }}">보기</a></p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="pagination">
            {{ $applies->links() }}
        </div>
    </div>
@endsection