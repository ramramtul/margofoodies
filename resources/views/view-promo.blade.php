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
			      <img src="" class="img-responsive img-restoran col-xs-12" alt={{$promo->judul}}>
			    </div>
  				<br>
  			</div>
  			<!-- Menampilkan informasi promo -->
  			<div class="col-xs-12 col-sm-6 col-md-6">
  				<div class="panel panel-default">
  					<div class="panel-body res1">
  						<h2 style="margin: 0 auto;"> {{$promo->judul}} </h2>
		  				<h4 id="deskripsi"> {{$promo->deskripsi}} </h4>
		  				<h5>Berlaku dari {{$promo->tgl_berlaku_awal}} hingga {{$promo->tgl_berlaku_akhir}}</h5>
					</div>

				</div>
			</div>
		</div>
	</div>
@else
<h1> Restoran yang Anda cari tidak tersedia </h1>
@endif


@stop




