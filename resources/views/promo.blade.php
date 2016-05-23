@extends('layout')

@section('title')
	<title>MargoFoodies - Daftar Promo</title>
@stop

@section('content')

<div class="container">
  
	@if(count($promo))
		<h1 style="color : #7f756b"> DAFTAR PROMO </h1>
				<!-- test coba-coba -->
				<?php
					$count = 0;
				 ?>
		  		@foreach($promo as $pro)
		  		
	   				<div class = "col-sm-6 col-md-4">
	   					<div class="panel panel-default">
	  		<div class="panel-body res1">
	      				<div class = "thumbnail">
	      					
			            		<img class="img-responsive" src="{{url('images/promo1.png')}}" alt="{{$pro->judul}}">
			            	
	        				
	      				</div>
	      
	     				<div class = "caption">
	     					<h3 style="text-align: center"><a href="promo/{{$pro->id}}">{{$pro->judul}}</a></h3>
	         				<h4 style="text-align: center"><a href="restoran/{{$pro->id_restoran}}">{{$pro->resto}}</a></h4>
	        			</div>
	   				</div>
	   				</div>
		</div>
				@endforeach
			
	@else
		<h4><b>Tidak ada promo</b></h4>
	@endif

</div>

@stop