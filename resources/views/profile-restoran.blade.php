@extends('layout')

@section('title')
<title> MargoFoodies - Edit Restoran</title>
@stop

@section('content')
<div class="container">
 	<div class="row profileResto">
		<div class="col-md-4">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-restopic">
					<div class="hovereffect">
						<img class="img-responsive fotoRestoran" src="{{url('uploads/r'.$restoran->id.'.png')}}" alt="">
				        <br>
					</div>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ $restoran->nama }}
					</div>
					<div class="profile-usertitle-email">
						{{ $user }}
					</div>
					<div class="profile-usertitle-desc">
						{{ $restoran->deskripsi }}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<!-- <div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div> -->
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="{{ URL::to('/profileRestoran') }}"><i class="glyphicon glyphicon-home"></i> My Profile </a>
						</li>
						<li>
							<a href="{{ URL::to('/editMenuRestoran') }}"><i class="glyphicon glyphicon-tasks"></i> Edit Menu </a>
						</li>
						<li>
							<a href="{{ URL::to('/editRestoran') }}"><i class="glyphicon glyphicon-grain"></i> Edit Restoran </a>
						</li>
						<li>
							<a href="{{ URL::to('/editWaktuOperasional') }}"><i class="glyphicon glyphicon-grain"></i> Edit Waktu Operasional </a>
						</li>
						<li>
							<a href="{{ URL::to('/editFasilitasRestoran') }}"><i class="glyphicon glyphicon-grain"></i> Edit Fasilitas Restoran </a>
						</li>
						<li>
							<a href="{{ URL::to('/helpRestoran') }}"><i class="glyphicon glyphicon-flag"></i> Help </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-8">
			<div class="profile-content">
				<h2 style="color: red;">{{$restoran->nama}}</h2>
				<h4 id="rate"> 
				<div class="star-ratings-sprite">
				  <span class="star-ratings-sprite-rating" style="width:{{$restoran->rate}}%"></span></div>
				</h4>
				<div class="panel panel-default">
					<div class="panel-body">
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
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<br>
</div>
@stop