<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@yield('title')
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" >
	<link rel="stylesheet" href="/margofoodies/public/css/mystyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="{{ URL::to('home') }}"><img src="/margofoodies/public/images/logo.png" class="img-responsive" alt="MargoFoodies" ></a>
			</div>
			<br>
			<div class="collapse navbar-collapse" id="myNavbar">
				@if (!Session::has('user'))
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#myModal1" data-toggle="modal"  data-target="#myModal1"><span class="glyphicon glyphicon-user" ></span> Daftar</a></li>
					<li><a href="#myModal2" data-toggle="modal"  data-target="#myModal2"><span class="glyphicon glyphicon-log-in"></span> Masuk</a></li>
				</ul>

				@include('register')

				@include('login')

				@else
				<?php $user = Session::get('user'); ?>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ URL::to('/profile') }}">Hi {{ $user->nama_lengkap }}</a></li>
					<li><a href="{{ URL::to('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
				</ul>
				@endif

				<div class="container" id="search">
					<div class="row">

			        	<div class="col-sm-3 col-sm-offset-10">       
			            	<div class="input-group stylish-input-group">
			                	<form class="form-inline" role="form" action="{{url('/search')}}" method="POST">
		  							{!! csrf_field() !!}
		  							<div class="form-group">
				                		<input type="text" class="form-control" name="query" placeholder="Search" >
  									</div>
				                	<div class="form-group">
					                    <button type="submit">
					                    	<span class="glyphicon glyphicon-search"></span>
					                    </button> 
				                	</div>
				                </form>               
			            	</div>
			        	</div>	


					</div>
				</div>
			</div>
		</div>
	</nav>

	<!-- Main component for a primary marketing message or call to action -->
	<div class="content">
		@yield('content')
	</div>
	
	<div class="footer">
		<div class = "tombolfooter-container">
			<div style="margin: left;">
			<a href="http://localhost/margofoodies/public/panel/login" class="btn btn-info" role="button">Admin</a>
			<a href="http://localhost/margofoodies/public/home" class="btn btn-info" role="button">Home</a>
			<a href="http://localhost/margofoodies/public/restoran" class="btn btn-info" role="button"> Daftar Restoran</a>
			<?php
			if(Session::has('user')){
				echo "<a href='http://localhost/margofoodies/public/profile' class='btn btn-info' role='button'> My Profile</a>";
				$user = Session::get('user')->isClient;
				if($user){
					echo "<a href='http://localhost/margofoodies/public/profileRestoran' class='btn btn-info' role='button'>My Restourant</a>";
				}
			}

			?>
		</div>
		</div>
	</div>

</body>
</html>
