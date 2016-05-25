@extends('layout')

@section('title')
<title> MargoFoodies - Restoran - {{$restoran->nama}} </title>
@stop

@section('content')

  @if(count($restoran))
 	<div class="container" >
 		
 		<div class="row">
 			<div class="col-xs-12 col-sm-6 col-md-6">
 			<h1 id="name"><b><a href="../restoran/{{$restoran->id}}">{{strtoupper($restoran->nama)}}</a></b></h1>
 			</div>
 			<div class="col-xs-12 col-sm-6 col-md-1 col-md-offset-5">
			
			<form id="form-horizontal-checkin" role="form" action="../restoran/{{$restoran->id}}" method="POST">
				<input type="text" name="nama" id="nama" value="">
				<input type="text" name="restoran" id="restoran" value="{{$restoran->nama}}">
			</form>
			<button class="btn btn-responsive btn-singgah" id="singgahah" onclick="change()" role="button" type="submit">Singgah</button>

 			</div>
 		</div>
 		<br>
  		<div class="row">
        	<div class="col-xs-12 col-sm-6 col-md-6">
        		<div id="restoCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicator untuk gambar restoran -->
				  <ol class="carousel-indicators">
				    <li data-target="#restoCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#restoCarousel" data-slide-to="1"></li>
				    <li data-target="#restoCarousel" data-slide-to="2"></li>
				    <li data-target="#restoCarousel" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				    <div class="item active">
				    	@if($restoran->id_photo <> "")
		            		<img src="{{url('uploads/'.$restoran->id_photo.'')}}" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
			            @else
			            	<img class="img-responsive" src="{{url('images/default-pic.png')}}" alt="{{$restoran->nama}}">
			            @endif
				      
				    </div>

				    <div class="item">
				       @if($restoran->id_photo <> "")
		            		<img src="{{url('uploads/'.$restoran->id_photo.'')}}" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
			            @else
			            	<img class="img-responsive" src="{{url('images/default-pic.png')}}" alt="{{$restoran->nama}}">
			            @endif
				    </div>

				    <div class="item">
				        @if($restoran->id_photo <> "")
		            		<img src="{{url('uploads/'.$restoran->id_photo.'')}}" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>
			            @else
			            	<img class="img-responsive" src="{{url('images/default-pic.png')}}" alt="{{$restoran->nama}}">
			            @endif
				    </div>

				    <div class="item">
				     @if($restoran->id_photo <> "")
		            		<img src="{{url('uploads/'.$restoran->id_photo.'')}}" class="img-responsive img-restoran col-xs-12" alt={{$restoran->nama}}>}>
			            @else
			            	<img class="img-responsive" src="{{url('images/default-pic.png')}}" alt="{{$restoran->nama}}">
			            @endif
				    </div>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#restoCarousel" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#restoCarousel" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
  				<br>
  			</div>
  			<!-- Menampilkan informasi restoran -->
  			<div class="col-xs-12 col-sm-6 col-md-6">
  				<div class="panel panel-default">
  					<div class="panel-body res1">
  						<h2 style="text-align:center; margin : 0 auto;"> Informasi Restoran </h2>
		  				<i><h5 id="deskripsi"> {{$restoran->deskripsi}} </h5></i>
		  				<h5 id="lokasi"><b>Lokasi : </b>{{$restoran->lokasi}}</h5>
						<?php
							if($restoran->no_telepon == null){
								echo "<h5 id='no-telp'><b> No Telepon : </b> Tidak tersedia </h5>";
							} else {
								echo "<h5 id='no-telp'><b> No Telepon : </b> $restoran->no_telepon </h5>";
							}
						?>
						
						<h5 id="tax"><b>Tax : </b>{{$restoran->tax}}%</h5>
						
						<h5><b>Jenis Masakan : </b></h5>
						<ul>
						@foreach($jenis_masakans as $jenis_masakan)
							<li class="check-sym">{{$jenis_masakan->jenis_masakan}} </li>
						@endforeach
						</ul>

						<h5><b> Jam Buka : </b></h5>
						@if ($hari_ini->waktu_buka != null)
							<h5>Hari Ini :  <b>{{$hari_ini->waktu_buka}} - {{$hari_ini->waktu_tutup}}</b>
							@else
							<h5>Hari Ini : <b>Tutup </b>
							@endif
							<button class="btn-singgah" onclick="$('#target').toggle();">
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
@else
<h1> Restoran yang Anda cari tidak tersedia </h1>
@endif


@stop




