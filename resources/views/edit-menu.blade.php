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
				<h2 style="color : red;">{{$menu->nama}}</h2>
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
				        {!! Form::open(array('url'=>'uploadPhotoMenu/'.$menu->id.'','method'=>'POST', 'files'=>true)) !!}
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
				<h3> Edit Informasi Menu </h3>
				<br>
				<form class="form-horizontal" action="{{ url('/editMenu/'.$menu->id.'') }}" method="POST">
					{!! csrf_field() !!}
					
					<fieldset>
					<div class row>
						<div class="col-md-6">
							<!-- Nama Menu-->
							@if($errors->has('nama'))
							<div class="form-group has-error">
								<label class="col-md-4 control-label" for="nama">Nama</label>
								<div class="col-md-8 controls">
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="nama" name="nama" class="form-control input-md" type="text" value="{{ $menu->nama }}">
									@else
									<input id="nama" name="nama" class="form-control input-md" type="text" value="{{ old('nama') }}">
									@endif
									<span class="help-block">Nama terlalu panjang</span>
								</div>
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="nama">Nama</label>  
								<div class="col-md-8">
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="nama" name="nama" class="form-control input-md" type="text" value="{{ $menu->nama }}">
									@else
									<input id="nama" name="nama" class="form-control input-md" type="text" value="{{ old('nama') }}">
									@endif
								</div>
							</div>
							@endif

							<!-- Harga-->
							@if($errors->has('harga'))
							<div class="form-group has-error">
								<label class="col-md-4 control-label" for="harga">Harga</label>
								<div class="col-md-8 controls">
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="harga" name="harga" placeholder="" class="form-control input-md" type="text" value="{{ $menu->harga }}">
									@else
									<input id="harga" name="harga" placeholder="" class="form-control input-md" type="text" value="{{ old('harga') }}">
									@endif
									<span class="help-block">Masukkan nilai yang sesuai</span>
								</div>
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="harga">Harga</label>
								<div class="col-md-8">
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="harga" name="harga" class="form-control input-md" type="text" value="{{ $menu->harga }}">
									@else
									<input id="harga" name="harga" class="form-control input-md" type="text" value="{{ old('harga') }}">
									@endif
								</div>
							</div>
							@endif

							<!-- Kapasitas -->
							@if($errors->has('kapasitas'))
							<div class="form-group has-error">
								<label class="col-md-4 control-label" for="kapasitas">Kapasitas</label>
								<div class="col-md-8">     
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="kapasitas" name="kapasitas" placeholder="" class="form-control input-md" type="text" value="{{ $menu->kapasitas }}">
									@else
									<input id="kapasitas" name="kapasitas" placeholder="" class="form-control input-md" type="text" value="{{ old('kapasitas')}}">
									@endif                
									<span class="help-block">Masukkan nilai yang sesuai</span>
								</div>
								
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="kapasitas">Kapasitas</label>
								<div class="col-md-8">                     
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="kapasitas" name="kapasitas" placeholder="" class="form-control input-md" type="text" value="{{ $menu->kapasitas }}">
									@else
									<input id="kapasitas" name="kapasitas" placeholder="" class="form-control input-md" type="text" value="{{ old('kapasitas')}}">
									@endif   
								</div>
							</div>
							@endif


							<!-- Jenis Masakan -->
							@if($errors->has('jenis'))
							<div class="form-group has-error">
								<label class="col-md-4 control-label" for="kapasitas">Jenis Masakan</label>
								<div class="col-md-8">     
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="jenis" name="jenis" placeholder="contoh : Indonesian" class="form-control input-md" type="text" value="{{ $menu->kategori }}">
									@else
									<input id="jenis" name="jenis" placeholder="contoh : Indonesian" class="form-control input-md" type="text" value="{{ old('jenis')}}">
									@endif                
									<span class="help-block">Masukkan nilai yang sesuai</span>
								</div>
								
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="kapasitas">Jenis Masakan</label>
								<div class="col-md-8">                     
									@if($errors->isEmpty() && !Session::has('passErr'))
									<input id="jenis" name="jenis" placeholder="contoh : Indonesian" class="form-control input-md" type="text" value="{{ $menu->kategori }}">
									@else
									<input id="jenis" name="jenis" placeholder="contoh : Indonesian" class="form-control input-md" type="text" value="{{ old('kategori')}}">
									@endif   
								</div>
							</div>
							@endif



							<!-- Deskripsi -->
							@if($errors->has('deskripsi'))
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
								<div class="col-md-8"> 
									@if($errors->isEmpty() && !Session::has('passErr'))
									<textarea class="form-control" id="desc" name="desc">{{ $menu->deskripsi }}</textarea>
									@else
									<textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
									@endif                  
									
								</div>
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="textarea">Deskripsi</label>
								<div class="col-md-8">                     
									@if($errors->isEmpty() && !Session::has('passErr'))
									<textarea class="form-control" id="desc" name="desc">{{ $menu->deskripsi }}</textarea>
									@else
									<textarea class="form-control" id="desc" name="desc">{{ old('desc') }}</textarea>
									@endif     
								</div>
							</div>
							@endif
						</div>

						<div class="col-md-6">

							<!-- Kategori -->
							<?php
								$kat = array("Makanan Utama", "Makanan Penutup", "Makanan Pelengkap", "Cemilan", "Minuman", "Other");
								$pak = array("Bukan Paket", "Paket Dengan Minuman", "Paket Tanpa Minuman");
							?>
							@if($errors->isEmpty() && !Session::has('passErr'))
							<div class="form-group">
								<label class="col-md-4 control-label" for="kategori">Kategori</label>
								<div class="col-md-8 controls">
									    <select class="form-control" id="kategori" name="kategori">
								      	<?php
								      		foreach ($kat as $k) {
											    if($menu->jenis == $k){
								      				echo "<option selected='true'>$k</option>";
									      		} else {
									      			echo "<option>$k</option>";
									      		}
								      		}
								      	?>
								      </select>
								</div>
							</div>
							@else
							<div class="form-group">
								<label class="col-md-4 control-label" for="kategori">Kategori</label>
								<div class="col-md-8 controls">
								      <select class="form-control" id="kategori" name="kategori">
								      	<?php
								      		foreach ($kat as $k) {
											    if(old('kategori') == $k){
								      				echo "<option selected='true'>$k</option>";
								      			} else {
								      				echo "<option>$k</option>";
								      			}
								      		}
								      	?>
								      </select>
								</div>
							</div>
							@endif

							<!-- Paket -->
							@if($errors->isEmpty() && !Session::has('passErr'))
							<div>
								<label class="col-md-4 control-label" for="paket">Jenis Paket</label>
								<div class="col-md-8 controls">
								      	<?php
										    if(!($menu->Is_Paket_Tanpa_Minum || $menu->Is_Paket_Dgn_Minum)){
										    	echo "<input type='radio' name='paket' value='Bukan Paket' checked>Bukan Paket<br>";
										    	echo "<input type='radio' name='paket' value='Paket Dengan Minuman'>Paket Dengan Minuman<br>";
										    	echo "<input type='radio' name='paket' value='Paket Tanpa Minuman' >Paket Tanpa Minuman<br>";
								      		} else if ($menu->Is_Paket_Dgn_Minum) {
								      			echo "<input type='radio' name='paket' value='Bukan Paket'>Bukan Paket<br>";
								      			echo "<input type='radio' name='paket' value='Paket Dengan Minuman' checked>Paket Dengan Minuman<br>";
								      			echo "<input type='radio' name='paket' value='Paket Tanpa Minuman'>";
								      		} else {
								      			echo "<input type='radio' name='paket' value='Bukan Paket'>Bukan Paket<br>";
								      			echo "<input type='radio' name='paket' value='Paket Dengan Minuman'>Paket Dengan Minuman<br>";
								      			echo "<input type='radio' name='paket' value='Paket Tanpa Minuman' checked>Paket Tanpa Minuman<br>";
								      		}
								      	?>
								     
								</div>
							</div>
							@else
								<div>
								<label class="col-md-4 control-label" for="paket">Jenis Paket</label>
								<div class="col-md-8 controls">
								      	<?php
								      		if(old('paket') == 'Bukan Paket'){
										    	echo "<input type='radio' name='paket' value='Bukan Paket' checked>Bukan Paket<br>";
										    	echo "<input type='radio' name='paket' value='Paket Dengan Minuman'>Paket Dengan Minuman<br>";
										    	echo "<input type='radio' name='paket' value='Paket Tanpa Minuman' >Paket Tanpa Minuman<br>";
								      		} else if (old('paket') == 'Paket Dengan Minuman') {
								      			echo "<input type='radio' name='paket' value='Bukan Paket'>Bukan Paket<br>";
								      			echo "<input type='radio' name='paket' value='Paket Dengan Minuman' checked>Paket Dengan Minuman<br>";
								      			echo "<input type='radio' name='paket' value='Paket Tanpa Minuman'>Paket Dengan Minuman<br>";
								      		} else {
								      			echo "<input type='radio' name='paket' value='Bukan Paket'>Bukan Paket<br>";
								      			echo "<input type='radio' name='paket' value='Paket Dengan Minuman'>Paket Dengan Minuman<br>";
								      			echo "<input type='radio' name='paket' value='Paket Tanpa Minuman' checked>Paket Tanpa Minuman<br>";
								      		}
								      	?>

								     
								</div>
							</div>

							@endif

							<br>
							<br>
							<br>
							
							<hr>
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
								<div class="col-md-8">
									<input id="currPass" name="currPass" placeholder="required" required class="form-control input-md" type="password">
								</div>
							</div>
							@endif
							<!-- Image Button -->
							<input type="file" id="pic-btn" name="pic-btn" style="display:none;">

							<!-- Button -->
							<div class="form-group">
								<label class="col-md-5 control-label" for="singlebutton"></label>
								<div class="col-md-7">
									<button id="submit" name="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</div>

					</fieldset>
				</form>
	        <button class="btn btn-danger" onclick="goBack()">Go Back</button>
	        </div>
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