
    {{ $user->name }}

<form name="delete" method="POST" action="{{ url('/admin/user') . '/' . $user->id }}">
    {{ method_field('delete') }}
    {{ csrf_field() }}
    <input type="submit" value="삭제" class="delete"/>
</form>
