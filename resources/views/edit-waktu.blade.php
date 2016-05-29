@extends('layout')

@section('title')
<title> MargoFoodies - Edit Restoran</title>
@stop

@section('content')
<div class="container">
 	<h1> Edit Restoran </h1>
 	<div class="row profileResto">
		<div class="col-md-4">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-restopic">
					<div class="hovereffect">
						@if($restoran->id_photo <> "")
		            		<img class="img-responsive fotoRestoran" src="{{url('uploads/'.$restoran->id_photo.'')}}" alt="">
		            	@else
		            		<img class="img-responsive fotoRestoran" src="{{url('images/default-pic.png')}}" alt="">
		            	@endif
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
						<li>
							<a href="{{ URL::to('/profileRestoran') }}"><i class="glyphicon glyphicon-home"></i> My Profile </a>
						</li>
						<li>
							<a href="{{ URL::to('/editMenuRestoran') }}"><i class="glyphicon glyphicon-tasks"></i> Edit Menu </a>
						</li>
						<li >
							<a href="{{ URL::to('/editRestoran') }}"><i class="glyphicon glyphicon-grain"></i> Edit Restoran </a>
						</li>
						<li>
							<a href="{{ URL::to('/seePromo') }}"><i class="glyphicon glyphicon-grain"></i> Lihat Promo </a>
						</li>
						<li class="active">
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
				<h2 style="color : red;">Edit Waktu Operasional</h2>
				<hr>
				<form class="form-horizontal" action="{{ url('/editWaktuOperasional') }}" method="POST">
					{!! csrf_field() !!}
					@if(isset($passErr)) {{$restoran }} {{ $passErr }}
					@endif
					@if(isset($dbErr)) {{ $dbErr }}
					@endif
					<fieldset>
						<div class="form-group">
								<label class="col-md-2 control-label" for="nama"></label>
								<div class="col-md-10 controls">
									<div class="row">
										<div class="col-md-5">
											<b><p style="text-align: center;"> Waktu buka </p></b>
										</div>
										
										<div class="col-md-5">
											<b><p style="text-align: center;"> Waktu tutup </p></b>
										</div>
										<div class="col-md-1">
											<b><p style="text-align: center;"> Ubah </p></b>
										</div>
									</div>
								</div>
						</div>
						@foreach($waktu_operasionals as $waktu)
							<script type="text/javascript">
								$(document).ready(function() {

									var a = document.getElementById("btn{{$waktu->hari}}");
									var b = document.getElementById("b{{$waktu->hari}}");
									var t = document.getElementById("t{{$waktu->hari}}");

									if (b.value == "" && t.value == ""){
										a.value = "Buka";
									} else {
										a.value = "Tutup";
									}

									if (a.value == "Buka") {
										t.disabled = true;
										b.disabled = true; 
									}

									a.onclick = function() {
										if(a.value == "Tutup") {
											b.disabled = true; 
											b.value = "";
											t.disabled = true; 
											t.value = "";
											a.value = "Buka";
										} else {
											document.getElementById("b{{$waktu->hari}}").disabled = false; 
											document.getElementById("t{{$waktu->hari}}").disabled = false; 
											if ("{{$waktu->waktu_buka}}" != "" && "{{$waktu->waktu_tutup}}" != ""){
												b.value = "{{$waktu->waktu_buka}}";
												t.value = "{{$waktu->waktu_tutup}}";
											} else {
												b.value = "00:00:00";
												t.value = "00:00:00";
											}
											
											a.value = "Tutup";
										
										}
									}
								});
							</script>
							<?php
								$status = "Tutup";
								if($waktu->waktu_buka == ""){
									$status = "Buka";
								}
								$cekT = "t".$waktu->hari;
								$cekB = "b".$waktu->hari;
							?>

							@if($errors->has($cekT) || $errors->has($cekB))
								<div class="form-group has-error">
								<label class="col-md-2 control-label" for="$waktu->hari">{{$waktu->hari}}</label>
								<div class="col-md-10 controls">
									@if(Session::has($waktu->hari."Err"))
									<div class="row">
										<div class="col-md-5">
											<input id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('b'.$waktu->hari.'') }}">
										</div>
										
										<div class="col-md-5">
											<input  id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('t'.$waktu->hari.'') }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary"/>
										</div>
									</div>
									<span class="help-block">{{Session::get($waktu->hari."Err")}}</span>
									@elseif($errors->isEmpty() && !Session::has('passErr'))
									<div class="row">
										<div class="col-md-5">
											<input id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ $waktu->waktu_buka }}">
										</div>
										
										<div class="col-md-5">
											<input id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ $waktu->waktu_tutup }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary"/>
										</div>
									</div>
									@else
									<div class="row">
										<div class="col-md-5">
											<input id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('b'.$waktu->hari.'') }}">
										</div>
						
										<div class="col-md-5">
											<input id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('t'.$waktu->hari.'') }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary"/>
										</div>
									</div>
									@endif
									<span class="help-block">Masukkan format yang sesuai</span>

								</div>
							</div>
							@elseif(Session::has($waktu->hari."Err"))
							<div class="form-group has-error">
								<label class="col-md-2 control-label" for="$waktu->hari">{{$waktu->hari}}</label>  
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-5">
											<input id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('b'.$waktu->hari.'') }}">
										</div>
										
										<div class="col-md-5">
											<input  id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('t'.$waktu->hari.'') }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary"/>
										</div>
									</div>
									<span class="help-block">{{Session::get($waktu->hari."Err")}}</span>
									
								</div>
							</div>

							@else
							<div class="form-group">
								<label class="col-md-2 control-label" for="$waktu->hari">{{$waktu->hari}}</label>  
								<div class="col-md-10">
									@if($errors->isEmpty() && !Session::has('passErr'))
									<div class="row">
										<div class="col-md-5">
											<input id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ $waktu->waktu_buka }}">
										</div>
										
										<div class="col-md-5">
											<input  id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ $waktu->waktu_tutup }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary"/>

										</div>
									</div>
									@else
									<div class="row">
										<div class="col-md-5">
											<input  id="b{{$waktu->hari}}" name="b{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('b'.$waktu->hari.'') }}">
										</div>
							
										<div class="col-md-5">
											<input  id="t{{$waktu->hari}}" name="t{{$waktu->hari}}" placeholder="" class="form-control input-md" type="time" value="{{ old('t'.$waktu->hari.'') }}">
										</div>
										<div class="col-md-1">
											<input id="btn{{$waktu->hari}}" name ="btn{{$waktu->hari}}" type="button" value="{{$status}}" class="btn btn-primary" />
										</div>
									</div>
									@endif
									
								
								</div>
							</div>
							@endif
						@endforeach



						<!-- Password input-->
						@if(Session::has('passErr'))
						<div class="form-group has-error">
							<label class="col-md-3 control-label" for="currPass">Password sekarang</label>
							<div class="col-md-4 controls">
								<input id="currPass" name="currPass" placeholder="required" required class="form-control input-md" type="password">
								<span class="help-block">Password salah!</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-3 control-label" for="passwordinput">Password sekarang</label>
							<div class="col-md-4">
								<input id="currPass" name="currPass" placeholder="required" required class="form-control input-md" type="password">
							</div>
						</div>
						@endif

						<!-- Image Button -->
						<input type="file" id="pic-btn" name="pic-btn" style="display:none;">

						<!-- Button -->
						<div class="form-group">
							<label class="col-md-6 control-label" for="singlebutton"></label>
							<div class="col-md-4">
								<button id="submit" name="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</fieldset>
				</form>

			</div>
		</div>
	</div>
</div>
<br>
<br>
</div>

@stop