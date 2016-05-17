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
						<img class="img-responsive fotoRestoran" src="uploads/{{$restoran->nama}}.png" alt="">
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
						<li class="active">
							<a href="{{ URL::to('/editMenu') }}"><i class="glyphicon glyphicon-tasks"></i> Edit Menu </a>
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
		<div class="col-md-8">
			<div class="profile-content">
				<h2>Edit Fasilitas Restoran</h2>
				<div class="panel-body">
			        <!-- Display Validation Errors -->

			        <!-- New Task Form -->
			        <form action="/editFasilitasRestoran" method="POST" class="form-horizontal">
			            {{ csrf_field() }}

			            <!-- Task Name -->
			            <div class="form-group">
			                <label for="fasilitas" class="col-sm-3 control-label">Task</label>

			                <div class="col-sm-6">
			                    <input type="text" name="fasilitas" id="fasilitas" class="form-control">
			                </div>
			            </div>

			            <!-- Add Task Button -->
			            <div class="form-group">
			                <div class="col-sm-offset-3 col-sm-6">
			                    <button type="submit" class="btn btn-default">
			                        <i class="fa fa-plus"></i> Tambah Fasilitas
			                    </button>
			                </div>
			            </div>
			        </form>
			    </div>
			</div>
		</div>
	</div>
</div>
@stop