@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">SHOP LIST</div>
                <div class="panel-body">        
                    <ul class="list-group">
                        <table class="table table-hover" style="table-layout:fixed">
                            <tr>
                                <th width="40">#</td>
                                <th>SHOP</td>
                                <th>URL</td>
                                <th width="100">BookMark</td>
                            </tr>
                            @foreach($shops as $shop)
                                <tr>
                                    <td style="color:red">{{ $shop->id}}</td>
                                    <td>
                                        {{ $shop->name }}                                
                                    </td>
                                    <td>{{ $shop->url }}</td>
                                    <td>
                                        @if( $shop->users()->get()->where('id', Auth::user()->id)->count() == 0 )
                                            <a href="#" class="fav" onclick="return false;">Like</a>
                                        @else
                                            <a href="#" class="fav active" onclick="return false;">unLike</a>
                                        @endif
                                    </ul>
                                    </td>
                                </tr>                   
                            @endforeach 
                        </table>
                    </ul>
                    {{ $shops->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection