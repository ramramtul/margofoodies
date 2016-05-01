@extends('layout')

@section('title')
	<title>MargoFoodies - Daftar Restoran</title>
@stop

@section('content')

<div class="container">
  
	@if(count($restoran))
		<h1 style="color : #7f756b"> DAFTAR RESTORAN </h1>
		<div class="row">
	  		<div class="col-xs-12 col-sm-6 col-md-12 ">
			  {!! $restoran->links() !!}
			</div>
	 	</div>
		<div class="panel panel-default">
	  		<div class="panel-body res1">
				<!-- test coba-coba -->
				<?php
					$count = 0;
				 ?>
		  		@foreach($restoran as $res)
		  			<?php $count = $count + 1 ?>
		 			@if($count%3 == 0)
		 				<div class = "row">
		  			@endif
	   				<div class = "col-sm-6 col-md-4">
	      				<div class = "thumbnail">
	        				<img src = "images/restoran.jpg" alt = "Generic placeholder thumbnail">
	      				</div>
	      
	     				<div class = "caption">
	         				<h3 style="text-align: center"><a href="restoran/{{$res->id}}">{{$res->nama}}</a></h3>
	         				<p>{{$res->deskripsi}}</p>
	        			</div>
	   					</div>
				   	
				   	@if($count%3 == 0)
					  </div>
					@endif 
				@endforeach
			</div>
		</div>
	@endif

</div>

@stop