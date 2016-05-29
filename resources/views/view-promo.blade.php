@extends('layout')

@section('title')
<title> MargoFoodies - Promo - {{$promo->judul}} </title>
@stop

@section('content')

  @if(count($promo))
 	<div class="container" >
 		
 		<div class="row">
 			<div class="col-xs-12 col-sm-6 col-md-6">
 			<h1 id="name"><a href="../promo"><b>PROMO</b></a></h1>
 			</div>
 		</div>
 		<br>
  		<div class="row">
        	<div class="col-xs-12 col-sm-6 col-md-6">
			    <div class="item active">
			      	@if($promo->id_photo <> "")
		    			<img class="img-responsive" src="{{url('uploads/'.$promo->id_photo.'')}}" alt="{{$promo->judul}}">
		        	@else
		        		<img class="img-responsive" src="{{url('images/default-pic.png')}}" alt="{{$pro->judul}}">
		        	@endif
			    </div>
  				<br>
  			</div>
  			<!-- Menampilkan informasi promo -->
  			<div class="col-xs-12 col-sm-6 col-md-6">
  				<div class="panel panel-default">
  					<div class="panel-body res1">
  						<h2 style="margin: 0 auto;"> {{$promo->judul}} </h2>
		  				<h4 id="deskripsi"> {{$promo->deskripsi}} </h4>
		  				@if($promo->tgl_berlaku_akhir <> '0000-00-00')
		  					<h5>Berlaku dari {{$promo->tgl_berlaku_awal}} hingga {{$promo->tgl_berlaku_akhir}}</h5>
		  				@else
		  					<h5>Berlaku dari {{$promo->tgl_berlaku_awal}}</h5>
		  				@endif
					</div>

				</div>
			</div>
		</div>
	</div>
@else
<h1> Restoran yang Anda cari tidak tersedia </h1>
@endif


@stop




