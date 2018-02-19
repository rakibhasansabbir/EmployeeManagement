@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Welcome</h1>
	<h3>now value is = {{$value}} </h3>
	{{--<input type="text" v-model="value">--}}
	<form href="test/create" method="get">
		<button class="btn btn-danger" type="submit">new Button</button>
	</form>
	 <h1><a class="btn btn-success" href="/test/create">Gooo...</a></h1>
</div>
	@endsection
