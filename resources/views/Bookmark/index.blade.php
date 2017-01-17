@foreach($bookmarks as $bookmark)
{{ $bookmark->id }} <br>
{{ $bookmark->name }} <br>
{{ $bookmark->image }} <br>
{{ $bookmark->url }} <br>
@endforeach