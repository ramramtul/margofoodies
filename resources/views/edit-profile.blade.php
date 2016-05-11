@extends('layout')

@section('title')
<title>MargoFoodies - Home</title>
@stop

@section('content')
<?php $user = Session::get('user'); ?>
<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<div class="container">
	<div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<div class="hovereffect">
						<img class="img-responsive" src="images/default_pp.png" class="img-responsive" alt="">
						<div class="overlay">
							<a id="browse" class="info" onclick="browse()">Upload</a>
						</div>
					</div>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ $user->nama_lengkap }}
					</div>
					<div class="profile-usertitle-email">
						{{ $user->email }}
					</div>
					<div class="profile-usertitle-desc">
						{{ $user->deskripsi }}
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
							<a href="{{ URL::to('/profile') }}"><i class="glyphicon glyphicon-home"></i> My Profile </a>
						</li>
						<li class="active">
							<a href="{{ URL::to('/editProfile') }}"><i class="glyphicon glyphicon-user"></i> Account Settings </a>
						</li>
						<!-- <li>
							<a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i>Tasks </a>
						</li>
						<li>
							<a href="#"><i class="glyphicon glyphicon-flag"></i>Help </a>
						</li> -->
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
			<div class="profile-content">
				<h2>Edit Profile</h2>
				<form class="form-horizontal" action="{{ url('/editProfile') }}" method="POST">
					{!! csrf_field() !!}
					@if(isset($passErr)) {{ $passErr }}
					@endif
					@if(isset($dbErr)) {{ $dbErr }}
					@endif
					<fieldset>
						<!-- Text input-->
						@if($errors->has('nama'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="nama">Nama</label>
							<div class="col-md-4 controls">
								@if($errors->isEmpty() && !Session::has('passErr'))
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ $user->nama_lengkap }}">
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
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ $user->nama_lengkap }}">
								@else
								<input id="nama" name="nama" placeholder="nama lengkap" class="form-control input-md" type="text" value="{{ old('nama') }}">
								@endif
							</div>
						</div>
						@endif

						<!-- Password input-->
						@if($errors->has('newPass'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="newPass">Password baru</label>
							<div class="col-md-4 controls">
								<input id="newPass" name="newPass" placeholder="" class="form-control input-md" type="password">
								<span class="help-block">Password terlalu pendek</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="newPass">Password baru</label>
							<div class="col-md-4">
								<input id="newPass" name="newPass" placeholder="" class="form-control input-md" type="password">
							</div>
						</div>
						@endif


						<!-- Password input-->
						@if($errors->has('confirmNewPass'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="confirmNewPass">Konfirmasi Password baru</label>
							<div class="col-md-4 controls">
								<input id="confirmNewPass" name="confirmNewPass" placeholder="" class="form-control input-md" type="password">
								<span class="help-block">Password tidak sama</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="ConfirmNewPass">Konfirmasi Password baru</label>
							<div class="col-md-4">
								<input id="confirmNewPass" name="confirmNewPass" placeholder="" class="form-control input-md" type="password">

							</div>
						</div>
						@endif

						<!-- Textarea -->
						@if($errors->isEmpty() && !Session::has('passErr'))
						<div class="form-group">
							<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
							<div class="col-md-4">                     
								<textarea class="form-control" id="desc" name="desc">{{ $user->deskripsi }}</textarea>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
							<div class="col-md-4">                     
								<textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
							</div>
						</div>
						@endif

						<!-- Password input-->
						@if(Session::has('passErr'))
						<div class="form-group has-error">
							<label class="col-md-4 control-label" for="currPass">Password sekarang</label>
							<div class="col-md-4 controls">
								<input id="currPass" name="currPass" placeholder="required" class="form-control input-md" type="password">
								<span class="help-block">Password salah!</span>
							</div>
						</div>
						@else
						<div class="form-group">
							<label class="col-md-4 control-label" for="passwordinput">Password sekarang</label>
							<div class="col-md-4">
								<input id="currPass" name="currPass" placeholder="required" class="form-control input-md" type="password">

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
<script type="text/javascript">
	$(document).ready(function() {

		var a = document.getElementById("browse");
		a.onclick = function() {
			var btn = document.getElementById("pic-btn");
			btn.click();
		}
	});
</script>
@stop