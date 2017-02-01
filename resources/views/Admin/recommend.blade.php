@extends('layouts.admin')

@section('content')
<select multiple id="source">
  <option value="123">Superman</option>
  <option value="456">Batman</option>
  <option value="789">Spiderman</option>
  <option value="654">Captain America</option>
</select>

<input type='button' id='btnAllRight' value='>>'>
<input type='button' id='btnRight' value='>'>
<input type='button' id='btnLeft' value='<'>
<input type='button' id='btnAllLeft' value='<<'>

<select multiple class="form-control" id="destination">
  <option value="765">Nick Fury</option>
  <option value="698">The Hulk</option>
  <option value="856">Iron Man</option>
</select>
@endsection
