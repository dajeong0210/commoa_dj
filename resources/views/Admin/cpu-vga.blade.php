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
                                <a href="#" class="delete">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <form name="delete" class="hidden" method="POST" action="{{ url('/admin/cpu') . '/' . $cpu->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endforeach
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
                                <span class="hidden">{{ $vga->id  }}</span>
                                <a href="#" class="name">{{ $vga->name }}</a>
                                <span class="count"> ( {{ $products->where('vga_id', $vga->id)->count() }} )  </span>
                                <a href="#" class="delete">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <form name="delete" class="hidden" method="POST" action="{{ url('/admin/vga') . '/' . $vga->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="cpu-vga category form">
                <form method="POST" name="cpuForm" action="">
                    <h3>CPU :: {{ $cpu->name }} </h3>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="cpu_name">이름</label>
                            <input type="text" name="cpu_name" value="{{ $cpu->name }}"/>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="cpu_brand">브랜드</label>
                            <input type="text" name="cpu_brand" value="{{ $cpu->brand }}"/>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="cpu_core">코어</label>
                            <input type="text" name="cpu_core" value="{{ $cpu->cores }}"/>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="cpu_level">사양</label>
                            <select name="cpu_level">
                                <option value="3">상</option>
                                <option value="2">중</option>
                                <option value="1">하</option>
                            </select>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <input type="submit" class="btn submit" value="수정하기"/>
                        </div>
                    </div>
                </form>
                <form method="POST" name="vgaForm" class="hidden">
                    <h3>VGA :: {{ $vga->name }}</h3>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_name">이름</label>
                            <input type="text" name="vga_name" value="{{ $vga->name }}"/>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_brand">브랜드</label>
                            <input type="text" name="vga_brand" value="{{ $vga->brand }}"/>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <label for="vga_level">사양</label>
                            <select name="vga_level">
                                <option value="3">상</option>
                                <option value="2">중</option>
                                <option value="1">하</option>
                            </select>
                        </div>
                    </div>
                    <div class="group">
                        <div class="form-group one-layout">
                            <input type="submit" class="btn submit" value="수정하기"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection