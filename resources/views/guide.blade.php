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
            <div name="pc-guide" class="{{ Request::segment(1) == 'guide' ? '' : 'hidden' }}">
                <h3>조립 PC 가이드</h3>
                <ul class="btn-list">
                    <li><a href="#cpu">프로세서</a></li>
                    <li><a href="#vga">그래픽카드</a></li>
                    <li><a href="#memory">메모리</a></li>
                    <li><a href="#storage">저장장치</a></li>
                </ul>
                <ul class="specification pc-guide">
                    <li id="cpu">
                        <h4>프로세서(CPU)</h4>
                        <p>CPU 혹은 프로세서란 컴퓨터에서 가장 중요한 두뇌와 같은 역할을 하는 부품이다. 쉽게 말하면 컴퓨터가 하는 모든 계산 처리를 CPU가 한다고 이해하면 된다. 대표적인 프로세서 제조사는 Intel 과 AMD 가 있는데 국내에 판매되는 조립 PC들에는 대부분 Intel의 제품이 사용된다. 많은 수의 코어를 포함할 수록 성능이 좋은 CPU다.</p>
                        <h5>컴모아 CPU 목록 (2017년 3월)</h5>
                        <table>
                            <tr>
                                <th>코어</th>
                                <th>모델명</th>
                                <th>사양</th>
                            </tr>
                            <tr>
                                <td rowspan="2">2</td>
                                <td>Intel® Celeron® G1840, Intel® Celeron® G1850, Intel® Celeron® G3900, Intel® Celeron® G3920, Intel® Celeron® G3930, Intel® Celeron® G3950</td>
                                <td>하</td>
                            </tr>
                            <tr>
                                <td>Intel® Pentium® G4400, Intel® Pentium® G4500, Intel® Pentium® G4560, Intel® Pentium® G4600, Intel® Pentium® G4620, Intel® Core™ i3 6100, Intel® Core™ i3 6300, Intel® Core™ i3 6320, Intel® Core™ i3 7100, Intel® Core™ i3 7300, Intel® Core™ i3 7320</td>
                                <td>중</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Intel® Core™ i5 6400, Intel® Core™ i5 6500, Intel® Core™ i5 6600, Intel® Core™ i5 6600K, Intel® Core™ i5 7400, Intel® Core™ i5 7500, Intel® Core™ i5 7600, Intel® Core™ i5 7600K, Intel® Core™ i7 6700, Intel® Core™ i7 6700K, Intel® Core™ i7 7700, Intel® Core™ i7 7700K</td>
                                <td>상</td>
                            </tr>
                        </table>
                    </li>
                    <li id="vga">
                        <h4>그래픽카드(VGA)</h4>
                        <p>그래픽카드는 CPU의 작업 현황 및 3D 게임 구동시 3D 결과물을 화면에 그려주는 장치로 그래픽 카드가 없으면 모니터는 어떤 결과도 화면에 나타낼 수 없다. 컴퓨터의 두뇌라고 할 수 있는 CPU는 컴퓨터를 구성하고 있는 각 장치에 지시를 내릴 뿐, 직접적으로 모니터에 화면을 표시할 수 있는 능력이 없기 때문에 그래픽 카드가 꼭 필요하다. 요즘에는 CPU에 내장 그래픽이 기본 장착이 되어 나온다. 고사양의 3D게임이나 디자인 작업 등이 목적인 조립 PC의 경우 중사양 이상의 그래픽 카드를 장착하는 것을 권장한다.</p>
                        <h5>컴모아 그래픽카드 목록 (2017년 3월)</h5>
                        <table>
                            <tr>
                                <th>이름</th>
                                <th>사양</th>
                            </tr>
                            <tr>
                                <td>GeForce GT 740, 내장그래픽</td>
                                <td>하</td>
                            </tr>
                            <tr>
                                <td>GeForce GTX 750, GeForce GTX 750 Ti, GeForce GTX 760, GeForce GTX 950, GeForce GTX 960, GeForce GTX 1050, GeForce GTX 1050 Ti, Radeon™ RX 460</td>
                                <td>중</td>
                            </tr>
                            <tr>
                                <td>GeForce GTX 770, GeForce GTX 780, GeForce GTX 780 Ti, GeForce GTX 970, GeForce GTX 980, GeForce GTX 980 Ti, GeForce GTX 1060, GeForce GTX 1070, GeForce GTX 1080, Radeon™ RX 470, Radeon™ RX 480</td>
                                <td>상</td>
                            </tr>
                        </table>
                    </li>
                    <li id="memory">
                        <h4>메모리(RAM)</h4>
                        <p>CPU의 작업을 임시적으로 기억하는 저장 장치이다. 저장장치의 데이터를 가져와 컴퓨터가 임시적으로 작업을 처리하는 작업장 같은 역할을 한다고 보면된다. 메모리의 용량이 클 수록 컴퓨터가 한번에 작업할 수 있는 양이 커지므로 성능이 향상된다. 요즘 판매되는 PC의 경우에는 듀얼채널로 램을 장착하는 경우가 많다. 듀얼채널이란 것은 같은 8GB 용량의 메모리여도 8GB 램을 하나 꽂는 것이 아니라 4GB 램을 두 개 꽂음으로 더 유리한 성능을 갖는 것을 말한다.</p>
                    </li>
                    <li id="storage">
                        <h4>저장장치(하드디스크, SSD)</h4>
                        <p>저장장치는 말 그대로 컴퓨터로 작업한 데이터를 저장해 놓고 그 데이터를 언제든지 꺼내서 다시 볼 수 있게 해주는 장치이다. 메모리가 작업장의 역할이라면 저장장치는 서랍장같은 역할을 한다. 최근에 많이 보급화된 SSD는 기존의 하드디스크에 비해 월등히 높은 속도를 가지고 있으나 그만큼 상대적으로 가격대가 높다. 때문에 작은 용량의 SSD와 큰 용량의 하드 디스크를 혼합하여 장착해 성능의 효율을 높이는 경우가 많다. 요즘 판매되는 조립PC는 보편적으로 1TB = 1,024GB 용량의 하드디스크가 장착된다.</p>
                    </li>
                </ul>
            </div>
            <div name="game-guide" class="{{ Request::segment(1) == 'guide' ? 'hidden' : '' }}">
                <h3>게임별 사양 가이드</h3>
                <ul class="btn-list">
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
    <script>
        $url = window.location.href;
        if( $url.indexOf('?') != -1 ){
            $('li[name="pc-guide"]').removeClass('active');
            $('div[name="pc-guide"]').addClass('hidden');
            $('li[name="game-guide"]').addClass('active');
            $('div[name="game-guide"]').removeClass('hidden');
        }
    </script>
@endsection