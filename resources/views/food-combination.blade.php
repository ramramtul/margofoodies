<div class="container">
	@foreach($data as $menu)
		<p>{{$menu->nama}} harga {{$menu->harga}}</p>
	@endforeach
</div>
