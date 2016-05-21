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
		            		<img class="img-responsive fotoRestoran" src="{{url('uploads/r'.$restoran->id.'.png')}}" alt="">
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
						<li class="active">
							<a href="{{ URL::to('/editMenuRestoran') }}"><i class="glyphicon glyphicon-tasks"></i> Edit Menu </a>
						</li>
						<li>
							<a href="{{ URL::to('/editRestoran') }}"><i class="glyphicon glyphicon-grain"></i> Edit Restoran </a>
						</li>
						<li>
							<a href="{{ URL::to('/seePromo') }}"><i class="glyphicon glyphicon-grain"></i> Lihat Promo </a>
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
				<h2 style="color : red;">Edit Fasilitas Restoran</h2>
				<hr>
				<div class="panel-body">
			        <!-- Display Validation Errors -->
			        <!-- New Task Form -->
			        <form action="{{ url('editFasilitasRestoran')}}" method="POST" class="form-horizontal">
			            {{ csrf_field() }}

			            <!-- Task Name -->
			            <div class="form-group">
			                <label for="fasilitas" class="col-sm-3 control-label">Fasilitas</label>

			                <div class="col-sm-6">
			                    <input type="text" name="fasilitas" id="fasilitas" class="form-control">
			                </div>
			            </div>

			            <!-- Add Task Button -->
			            <div class="form-group">
			                <div class="col-sm-offset-3 col-sm-6">
			                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">
			                        <i class="fa fa-plus"></i> Tambah Fasilitas
			                    </button>
			                </div>
			            </div>
			        </form>


			        @if (count($fasilitas_restorans) > 0)
			        	<br>
				        <div class="panel panel-default">
				            <div class="panel-heading">
				                Daftar Fasilitas Restoran
				            </div>

				            <div class="panel-body">
				                <table class="table table-striped task-table">

				                    <!-- Table Headings -->
				                    <thead>
				                        <th>Nama Fasilitas</th>
				                        <th>&nbsp;</th>
				                    </thead>

				                    <!-- Table Body -->
				                    <tbody>
				                        @foreach ($fasilitas_restorans as $fasilitas)
				                            <tr>
				                                <!-- Task Name -->
				                                <td class="table-text">
				                                    <div>{{ $fasilitas->nama_fasilitas }}</div>
				                                </td>

				                                <td>
				                                    <!-- TODO: Delete Button -->
				                                    <!-- Delete Button -->
												    <td>
												        <form action={{URL::to('editFasilitasRestoran', array($restoran->id,$fasilitas->nama_fasilitas), false)}} method="POST">
												            {{ csrf_field() }}
												            {{ method_field('DELETE') }}

												            <button type="submit" name="fasilitas" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger">
												            	<i class="fa fa-trash-o"></i> Hapus 
												            </button>
												        </form>
												    </td>
				                                </td>
				                            </tr>
				                        @endforeach
				                    </tbody>
				                </table>
				            </div>
				        </div>
				    @endif
			    </div>
			</div>
		</div>
	</div>
</div>
@stop