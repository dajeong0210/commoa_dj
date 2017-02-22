@extends('layouts.admin')

@section('content')
    <div class="page mypage list admin">
        @include('layouts.adminMenu')
        <div class="wrap">
            <div class="cpu-vga category">
                <h2>CPU/VGA편집</h2>
                <ul>
                    <li>
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>컴모아</strong>
                    </li>
                    <li>
                        <span>└</span>
                        <a href="#" class="folder">
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>CPU</strong>
                        </a>
                    </li>
                    <li>
                        <ul>
                            @foreach( $cpus as $cpu )
                            <li class="cpu">
                                <span>└</span>
                                <span class="hidden">{{ $cpu->id  }}</span>
                                <a href="#" class="name">{{ $cpu->name }}</a>
                                <span class="count"> ( {{ $products->where('cpu_id', $cpu->id)->count() }} )  </span>
                                <a href="#" class="del">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <form name="delete" class="hidden cpu{{$cpu->id}}" method="POST" action="{{ url('/cpu') . '/' . $cpu->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endforeach
                            <li class="cpu"><span>└</span><a href="#" class="create {{ $errors->has('vga_name') || $errors->has('vga_brand') || $errors->has('vga_level') ? '' : 'active' }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 추가</a></li>
                        </ul>
                    </li>
                    <li>
                        <span>└</span>
                        <a href="#" class="folder">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i> <strong>VGA</strong>
                        </a>
                    </li>
                    <li>
                        <ul>
                            @foreach( $vgas as $vga )
                            <li class="vga">
                                <span>└</span>
                                <span class="hidden">{{ $vga->id }}</span>
                                <a href="#" class="name">{{ $vga->name }}</a>
                                <span class="count"> ( {{ $products->where('vga_id', $vga->id)->count() }} )  </span>
                                <a href="#" class="del">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <form name="delete" class="hidden vga{{$vga->id}}" method="POST" action="{{ url('/vga') . '/' . $vga->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endforeach
                            <li class="vga"><span>└</span><a href="#" class="create {{ $errors->has('vga_name') || $errors->has('vga_brand') || $errors->has('vga_level') ? 'active' : '' }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 추가</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="cpu-vga category form">
                <form method="POST" name="cpuForm" action="{{ url('cpu') }}" class="{{ $errors->has('vga_name') || $errors->has('vga_brand') || $errors->has('vga_level') ? 'hidden' : '' }} validate">
                {{ csrf_field() }}
                    <h3>CPU :: 추가하기 </h3>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('cpu_name') ? ' has-error' : '' }}">
                            <label for="cpu_name">이름</label>
                            <input type="text" name="cpu_name" value="" required/>
                            @if($errors->has('cpu_name'))
                            <label class="error">
                                <strong>{{ $errors->first('cpu_name') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('cpu_brand') ? ' has-error' : '' }}">
                            <label for="cpu_brand">브랜드</label>
                            <input type="text" name="cpu_brand" value="" required/>
                            @if($errors->has('cpu_brand'))
                            <label class="error">
                                <strong>{{ $errors->first('cpu_brand') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('cpu_core') ? ' has-error' : '' }}">
                            <label for="cpu_core">코어</label>
                            <input type="text" name="cpu_core" value="" required/>
                            @if($errors->has('cpu_core'))
                            <label class="error">
                                <strong>{{ $errors->first('cpu_core') }}</strong>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout form-group{{ $errors->has('cpu_level') ? ' has-error' : '' }}">
                            <label for="cpu_level">사양</label>
                            <select name="cpu_level" required>
                                <option selected disabled>선택해주세요</option>
                                <option value="3">상</option>
                                <option value="2">중</option>
                                <option value="1">하</option>
                            </select>
                            @if ($errors->has('cpu_level'))
                                <label class="error">
                                    <strong>{{ $errors->first('cpu_level') }}</strong>
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <input type="submit" class="btn submit cpu-edit modify" value="추가하기"/>
                    </div>
                </form>
                <form method="POST" name="vgaForm" class="{{ $errors->has('vga_name') || $errors->has('vga_brand') || $errors->has('vga_level') ? '' : 'hidden' }} validate">
                {{ csrf_field() }}
                    <h3>VGA</h3>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_name">이름</label>
                            <input type="text" name="vga_name" value="" required/>
                            @if ($errors->has('vga_name'))
                                <label class="error">
                                    <strong>{{ $errors->first('vga_name') }}</strong>
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_brand">브랜드</label>
                            <input type="text" name="vga_brand" value="" required/>
                            @if ($errors->has('vga_brand'))
                                <label class="error">
                                    <strong>{{ $errors->first('vga_brand') }}</strong>
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_level">사양</label>
                            <select name="vga_level" required>
                                <option selected disabled>선택해주세요</option>
                                <option value="3">상</option>
                                <option value="2">중</option>
                                <option value="1">하</option>
                            </select>
                            @if ($errors->has('vga_level'))
                                <label class="error">
                                    <strong>{{ $errors->first('vga_level') }}</strong>
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="group">
                        <input type="submit" class="btn submit vga-edit modify" value="수정하기"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection