@extends('layout')

@section('title')
	<title>MargoFoodies - Hasil Pencarian Makanan</title>
@stop

@section('content')
<div class="container">
	@foreach($data as $menu)
		<p>{{$menu->nama}} harga {{$menu->harga}}</p>
	@endforeach
</div>
@stop
