@foreach($favorites as $favorite)
{{ $favorite->id }} <br>
{{ $favorite->name }} <br>
{{ $favorite->image }} <br>
{{ $favorite->url }} <br>
@endforeach