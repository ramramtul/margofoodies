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
						@if($restoran->id_photo <> "")
		            		<img class="img-responsive fotoRestoran" src="{{url('uploads/r'.$restoran->id.'.jpg')}}" alt="">
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
						<li class="active">
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
				<h2 style="color : red;">Edit Restoran</h2>
				<hr>
				<div class="about-section">
				   <div class="text-content">
				     <div class="span7 offset1">
				        @if(Session::has('success'))
				        <div class="alert-box success">
				        	<script>
								alert({!! Session::get('success') !!});
							</script>
				        </div>
				        @endif
				        <h4>Change Picture</h4>
				        {!! Form::open(array('url'=>'uploadPhotoResto','method'=>'POST', 'files'=>true)) !!}
				        <div class="control-group">
				          	<div class="controls">
				        		{!! Form::file('image') !!}
					  			<p class="errors">{!!$errors->first('image')!!}</p>
								@if(Session::has('error'))
								<script>
								alert({!! Session::get('error') !!});
								</script>
								@endif
				        	</div>
				        </div>
				        <div id="success"> </div>
					      {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
					      {!! Form::close() !!}
				      	</div>
		  			</div>
				</div>
				<hr>

				<form class="form-horizontal" action="{{ url('/editRestoran') }}" method="POST">
					{!! csrf_field() !!}
					@if(isset($passErr)) {{$restoran }} {{ $passErr }}
					@endif
					@if(isset($dbErr)) {{ $dbErr }}
					@endif
					<fieldset>
						<!-- Nama Restoran-->
						@if($errors->has('nama'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="nama">Nama</label>
							<div class="col-md-4 controls">
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ $restoran->nama }}">
								@else
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ old('nama') }}">
								@endif
								<span class="help-block">Nama terlalu pendek</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="nama">Nama</label>  
							<div class="col-md-4">
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ $restoran->nama }}">
								@else
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ old('nama') }}">
								@endif
							</div>
						</div>
						@endif

						<!-- Nomor Telepon-->
						@if($errors->has('telepon'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="telepon">No Telepon</label>
							<div class="col-md-4 controls">
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="telepon" name="telepon" placeholder="" class="form-control input-md" type="text" value="{{ $restoran->no_telepon }}">
								@else
								<input id="telepon" name="telepon" placeholder="" class="form-control input-md" type="text" value="{{ old('telepon') }}">
								@endif
								<span class="help-block">Masukkan format yang sesuai</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="telepon">No Telepon</label>
							<div class="col-md-4">
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="telepon" name="telepon" placeholder="021xxxxxxx" class="form-control input-md" type="text" value="{{ $restoran->no_telepon }}">
								@else
								<input id="telepon" name="telepon" placeholder="021xxxxxxx" class="form-control input-md" type="text" value="{{ old('telepon') }}">
								@endif
							</div>
						</div>
						@endif

						<!-- Lokasi -->
						<?php
								$lok = array("Lantai 2", "Lantai 1", "Lantai Dasar", "Lantai Paling Dasar");
							?>
						@if($errors->has('lokasi'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="lokasi">Lokasi</label>
							<div class="col-md-4 controls">
								    <select class="form-control" id="lokasi" name="lokasi">
							      	<?php
								      		foreach ($lok as $l) {
											    if($restoran->lokasi == $l){
								      				echo "<option selected='true'>$l</option>";
									      		} else {
									      			echo "<option>$l</option>";
									      		}
								      		}
								      	?>
							      </select>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="lokasi">Lokasi</label>
							<div class="col-md-4">
							      <select class="form-control" id="lokasi" name="lokasi">
							      	<?php
								      		foreach ($lok as $l) {
											    if($restoran->lokasi == $l){
								      				echo "<option selected='true'>$l</option>";
									      		} else {
									      			echo "<option>$l</option>";
									      		}
								      		}
								      	?>
							      </select>
							</div>
						</div>
						@endif

						<!-- Deskripsi -->
						@if($errors->has('deskripsi'))
						<div class="form-group">
							<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
							<div class="col-md-4"> 
								@if($errors->isEmpty() && !Session::has('passErr'))
								<textarea class="form-control" id="desc" name="desc">{{ $restoran->deskripsi }}</textarea>
								@else
								<textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
								@endif                  
								
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
							<div class="col-md-4">                     
								@if($errors->isEmpty() && !Session::has('passErr'))
								<textarea class="form-control" id="desc" name="desc">{{ $restoran->deskripsi }}</textarea>
								@else
								<textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
								@endif     
							</div>
						</div>
						@endif

						<!-- Tax -->
						@if($errors->has('tax'))
						<div class="form-group">
							<label class="col-md-4 control-label" for="tax">Tax</label>
							<div class="col-md-4">     
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="tax" name="tax" placeholder="" class="form-control input-md" type="text" value="{{ $restoran->tax }}">
								@else
								<input id="tax" name="tax" placeholder="" class="form-control input-md" type="text" value="{{ old('tax')}}">
								@endif                
								
							</div>
							<span class="help-block">Masukkan tax yang benar</span>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="tax">Tax</label>
							<div class="col-md-4">                     
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="tax" name="tax" placeholder="" class="form-control input-md" type="text" value="{{ $restoran->tax }}">
								@else
								<input id="tax" name="tax" placeholder="" class="form-control input-md" type="text" value="{{ old('tax')}}">
								@endif   
							</div>
						</div>
						@endif

						<!-- Password input-->
						@if(Session::has('passErr'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="currPass">Password sekarang</label>
							<div class="col-md-4 controls">
								<input id="currPass" name="currPass" placeholder="required" required class="form-control input-md" type="password">
								<span class="help-block">Password salah!</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="passwordinput">Password sekarang</label>
							<div class="col-md-4">
								<input id="currPass" name="currPass" placeholder="required" required class="form-control input-md" type="password">
							</div>
						</div>
						@endif

						<!-- Image Button -->
						<input type="file" id="pic-btn" name="pic-btn" style="display:none;">

						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="singlebutton"></label>
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