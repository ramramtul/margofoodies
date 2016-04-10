@extends('layout')

@section('title')
	<title>MargoFoodies - Home</title>
@stop

@section('daftar')
<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<?php echo Session::get('user'); ?>
					<h4 class="modal-title">Daftar</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" action="{{url('/home')}}" method="POST">
					{!! csrf_field() !!}
					<div class="form-group">
							<label class="control-label col-sm-2" for="nama">Nama:</label>
							<div class="col-sm-10">
							<input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama Anda">
							</div>
							@if ($errors->has('nama_lengkap'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('nama_lengkap') }}</strong></br>
			                </span>
			            @endif
					</div>
					<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email:</label>
							<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
							</div>
							@if ($errors->has('email'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('email') }}</strong></br>
			                </span>
			            @endif
					</div>
					<div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Password:</label>
							<div class="col-sm-10">          
							<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
							</div>
							@if ($errors->has('password'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('password') }}</strong></br>
			                </span>
			            @endif
					</div>
					<!-- <div class="form-group">        
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label><input type="checkbox"> Remember me</label>
							</div>
							</div>
					</div> -->
					<div class="modal-footer">
			          	<button type="submit" class="btn btn-default">Daftar</button>
			        </div>
				</form>
			</div>
		</div> 
	</div>
</div>
@stop

@section('masuk')
<div class="modal fade" id="myModal2" role="dialog">
	<div class="modal-dialog">
			<div class="modal-content">
	        <div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal">&times;</button>
	          	<h4 class="modal-title">Masuk</h4>
	        </div>
	        <div class="modal-body">
				<form role="form" action="{{url('/dologin')}}" method="POST">
					{!! csrf_field() !!}
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name='email' class="form-control" id="email" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" name='password' class="form-control" id="pwd" placeholder="Enter password">
					</div>
					<div class="modal-footer">
		         		<button type="submit" class="btn btn-default">Masuk</button>
		        	</div>
				</form>
	        </div>
	        
			</div> 
	</div>
</div>
@stop

@section('content')
	<div class="container-fluid" >
  		<div class="row">
        	<div class="col-sm-4 col-sm-offset-4">
				<div class="judul"> Promoooooooo bulan ini! <?php echo 'Hai'.Session::get('nama'); ?>
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
					        	<img src="images/promo1.jpg" alt="Chania" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo1.jpg" alt="Chania" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo1.jpg" alt="Flower" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo1.jpg" alt="Flower" width="400" height="300">
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
  				</div>
  			</div>
  		</div>
	</div>
	<br>
	<div class="inputan">
		<div class="container">
		  	<form role="form">
		    	<div class="form-group">
					<div class="row">
		        		<div class="col-sm-6 "> 
		      				<label for="usr">Berapa budgetmu?</label>
		      				<input type="text" class="form-control" id="usr">
		    			</div>
		    			<div class="form-group">
							<div class="col-sm-3 "> 
		      					<label for="pwd">Untuk berapa orang?</label>
		      					<input type="password" class="form-control" id="pwd">
			     			</div>
		    			</div>
						<div class="col-sm-1 ">
							<button type="button" class="btn">Cari</button>
						</div>
					</div>
				</div>
		  	</form>
		</div>
	</div>
@stop