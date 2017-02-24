@extends('layouts.layout')

@section('content')
    <div class="page list">
        <div class="sort-wrap">
            <ul class="sort-list guide">
                <li name="pc-guide" class="pc-guide active">조립 PC 가이드</li>
                <li name="game-guide" class="game-guide">게임별 사양 가이드</li>
            </ul>
        </div>
        <div class="tab">
            <div name="pc-guide">
                <h3>조립 PC 가이드</h3>
            </div>
            <div name="game-guide" class="hidden">
                <h3>게임별 사양 가이드</h3>
                <ul class="game-list">
                    @foreach($games as $game)
                    <li><a href="{{ '#game' . $game->id }}">{{ $game->name }}</a></li>
                    @endforeach
                </ul>
                <ul class="specification">
                    @foreach($games as $game)
                    <li id="{{ 'game' . $game->id }}">
                        <h4>{{ $game->name }}</h4>
                        <div class="wrap">
                            <div class="image-box" style="background:url({{ $game->image }}) center no-repeat;background-size:cover;"></div>
                        </div>
                        <ul>
                            <li>
                                <p class="title">최소 프로세서</p>
                                <p>{!! nl2br( e($game->min_cpu) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">최소 그래픽카드</p>
                                <p>{!! nl2br( e($game->min_vga) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">권장 프로세서</p>
                                <p>{!! nl2br( e($game->recommend_cpu) ) !!}</p>
                            </li>
                            <li>
                                <p class="title">권장 그래픽카드</p>
                                <p>{!! nl2br( e($game->recommend_vga) ) !!}</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">최소 메모리</p>
                                <p class="not-multi">{{ $game->min_memory }}GB</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">권장 메모리</p>
                                <p class="not-multi">{{ $game->recommend_memory }}GB</p>
                            </li>
                            <li class="triple-layout">
                                <p class="title">여유저장공간</p>
                                <p class="not-multi">{{ $game->storage }}GB</p>
                            </li>
                            <li>
                                <p class="title">&nbsp;</p>
                                <p></p>
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection