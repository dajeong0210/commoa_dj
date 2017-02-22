@extends('layouts.layout')

@section('content')
    <div class="page mypage" style="text-align:center;">
        <div style="height:400px;">
            <img src="{{ url('image/errorPage.png') }}" alt="페이지를 찾을 수 없습니다. 시스템 이용에 불편을 드려 죄송합니다.">
        </div>
        <div class="button-group" style="position:relative;top:-60px;">
            <a href="{{ url('') }}" class="error btn">메인으로 가기</a>
            <a href="javascript:history.back()" class="error btn">이전으로 가기</a>
        </div>
    </div>
@endsection