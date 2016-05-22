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
		<div class="col-md-8" >
			<div class="profile-content">
				<br>

				<div class="row">
					<div class="col-md-5" style="text-align: center;margin :0 auto">
						<h2 style="color : red;">{{$menu->nama}}</h2>
						<div style="margin-left: 30px">
							<div class="star-ratings-sprite">
			                  <span class="star-ratings-sprite-rating" style="width:{{$menu->rate}}%; margin-left: 20px"></span>
			                </div>
			            </div>
		                </h4>
		                <h5><i> {{$menu->deskripsi}} </i></h5>
		                <br>
		                <h4 style="color: #EA5B4D;"> Rp.{{$menu->harga }},00</h4>
		                <h5> Jenis Masakan : {{$menu->kategori}} </h5>
		                <h5> Kategori : {{$menu->jenis}} </h5>
		                <h5> 
		                
		                <h5><b> {{$menu->jumlah_tested}} tasted </b></h5>
		            </h5>
		            </div>
		            <div class="col-md-6">

		            	@if($menu->id_photo <> "")
		            		<img class="img-responsive fotoRestoran" style="border: 5px ridge black" src="{{url('uploads/m'.$menu->id.'.png')}}" alt="">
		            	@else
		            		<img class="img-responsive fotoRestoran" style="border: 5px ridge black" src="{{url('images/default-pic.png')}}" alt="">
		            	@endif
		            </div>

		        </div>
		        <br>
		        <button class="btn btn-danger" onclick="goBack()">Go Back</button>
		        <script>
					function goBack() {
					    window.history.back();
					}
				</script>

			</div>
		</div>
	</div>
</div>
<br>
<br>
</div>
@stop