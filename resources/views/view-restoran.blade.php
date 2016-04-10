@extends('layout')

@yield('title')
<title> Restoran | {{$restoran->nama}} </title>

@section('content')

  @if(count($restoran))
 	<div class="container" >
 		
 		<div class="row">
 			<div class="col-xs-12 col-sm-6 col-md-6">
 			<h1 id="name"><b><a href="../restoran/{{$restoran->id}}">{{strtoupper($restoran->nama)}}</a></b></h1>
 			</div>
 			<div class="col-xs-12 col-sm-6 col-md-1 col-md-offset-5">
 			<a class="btn btn-responsive btn-singgah" href="#" role="button">Singgah</a>
 			</div>
 		</div>
 		<br>
  		<div class="row">
        	<div class="col-xs-12 col-sm-6 col-md-6">
        		<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				    <li data-target="#myCarousel" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				      <img src="../images/restoran.jpg" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
				    </div>

				    <div class="item">
				      <img src="../images/restoran.jpg" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
				    </div>

				    <div class="item">
				      <img src="../images/restoran.jpg" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
				    </div>

				    <div class="item">
				      <img src="../images/restoran.jpg" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
  				<!-- <img src="../images/restoran.jpg" class="img-responsive img-restoran" alt={{$restoran->nama}}> -->
  				<br>
  			</div>
  			<div class="col-xs-12 col-sm-6 col-md-6">
  				<div class="panel panel-default">
  					<div class="panel-body res1">
  						<h2 style="text-align:center; margin : 0 auto;"> Informasi Restoran </h2>
		  				<i><h5 id="deskripsi"> {{$restoran->deskripsi}} </h5></i>
		  				@if($restoran->lokasi == "GF")
							<h5 id="lokasi"><b>Lokasi : </b>Lantai Dasar</h5>
						@endif

						@if($restoran->lokasi == "FL1")
							<h5 id="lokasi"><b>Lokasi : </b>Lantai 1</h5>
						@endif

						@if($restoran->lokasi == "FL2")
							<h5 id="lokasi"><b>Lokasi : </b>Lantai 2</h5>
						@endif

						@if($restoran->lokasi == "LG")
							<h5 id="lokasi"><b>Lokasi : </b>Lantai Paling Dasar</h5>
						@endif


						<h5 id="no-telp">  </h5>
						<h5 id="tax"><b>Tax : </b>{{$restoran->tax}}%</h5>
						
						<h5><b>Jenis Masakan : </b></h5>
						<ul>
						@foreach($jenis_masakans as $jenis_masakan)
							<li class="check-sym">{{$jenis_masakan->jenis_masakan}} </li>
						@endforeach
						</ul>

						<h5><b> Jam Buka : </b></h5>
						<h5>Hari ini {{$hari_ini->waktu_buka}} - {{$hari_ini->waktu_tutup}} <button class="btn-singgah" onclick="$('#target').toggle();">
						Lengkap/Sedikit
						</button></h5>
						
						<div id="target" style="display: none">

						    <ul>
						@foreach($waktu_operasionals as $waktu_operasional)
							@if ($waktu_operasional->waktu_buka != null)
							<li class="check-sym"> <b>{{$waktu_operasional->hari}} :  </b>{{$waktu_operasional->waktu_buka}} - {{$waktu_operasional->waktu_tutup}} </li>
							@else
							<li class="cross-sym"> <b>{{$waktu_operasional->hari}} : </b>Tutup </li>
							@endif

						@endforeach
						</ul>

						</div>
						
						<h5><b> Fasilitas : </b></h5>
						<ul>
						@foreach($fasilitas_restorans as $fasilitas_restoran)
							<li class="check-sym"> {{$fasilitas_restoran->nama_fasilitas}} </li>

						@endforeach
						</ul>
						<h4 id="rate"> 
						
						<div class="star-ratings-sprite">
						  <span class="star-ratings-sprite-rating" style="width:{{$restoran->rate}}%"></span></div>
						</h4>
						<a href="../menus/{{$restoran->id}}"><b>Lihat Menu</b></a>
					</div>

				</div>
				
 				
 			
			</div>
		</div>
	</div>
@endif


@stop




