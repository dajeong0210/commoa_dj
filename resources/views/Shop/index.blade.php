@extends('layouts.app')

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
                                <td width="40">#</td>
                                <td>SHOP</td>
                                <td>URL</td>
                                <td width="100">BookMark</td>
                            </tr>
                            @foreach($shops as $shop)
                                <tr bgcolor="#EEEEEE">
                                    <td style="color:red">{{ $shop->id}}</td>
                                    <td>
                                        {{ $shop->name }}                                
                                    </td>
                                    <td>{{ $shop->url }}</td>
                                    <td>
                                    <ul class="nav nav-pills" role="tablist">
                                    @if( $shop->users()->get()->where('id', Auth::user()->id)->count() == 0 )
                                        <li role="presentation" class="bookmark" name="{{ $shop->id }}"><a href="" >Like</a></li>
                                    @else
                                        <li role="presentation" class="bookmark active" name="{{ $shop->id }}"><a href="" onclick="return false;">Like</a></li>
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
<script type="text/javascript">
    $(".bookmark").click(function(e) {
        e.preventDefault();
        bookmark( this );
    });

    function bookmark(target) {
        var bookmark = $(target).hasClass('active');
        var shop_id = $(target).attr('name');
        alert(shop_id);
        var formData = {'bookmark': bookmark, 'shop_id': shop_id};
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url(''). '/bookmark' }}",
            type: "POST",
            data: formData,
            success: function(data){
                if( target.attr('class') == 'active' ) {
                    target.attr('class', '');
                } else {
                    target.attr('class', 'active');
                }
            },
            error: function(responseData, textStatus){
                console.log(textStatus);
            }
        });
    }
</script>
@endsection