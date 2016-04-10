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

    <nav class="navbar">
  		<div class="container-fluid">
    		<div class="navbar-header">
    		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
      		</button>
      			<a class="navbar-brand" href=""><img src="images/logo.png" class="img-responsive" alt="MargoFoodies" ></a>
    		</div>
    		<br>
    		<div class="collapse navbar-collapse" id="myNavbar">
    			@if (!Session::has('nama'))
      			<ul class="nav navbar-nav navbar-right">
        			<li><a href="#myModal1" data-toggle="modal"  data-target="#myModal1"><span class="glyphicon glyphicon-user" ></span> Daftar</a></li>
        			<li><a href="#myModal2" data-toggle="modal"  data-target="#myModal2"><span class="glyphicon glyphicon-log-in"></span> Masuk</a></li>
      			</ul>
	  			@else
	  			<ul class="nav navbar-nav navbar-right">
        			<li><a href="#">Hi {!! Session::get('nama') !!}</a></li>
        			<li><a href="{{ URL::to('/logout') }}"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
      			</ul>
				@endif

   				@include('register')
  
				@include('login')
	  
			   	<div class="container" id="search">
					<div class="row">
			        	<div class="col-sm-3 col-sm-offset-10">       
			            	<div class="input-group stylish-input-group">
			            		
				                	<input type="text" class="form-control" name="cari" placeholder="Search" >
				                	<span class="input-group-addon">
					                    <button type="submit">
					                    	<span class="glyphicon glyphicon-search"></span>
					                    </button> 
				                	</span>                
			            	</div>
			        	</div>	
					</div>
				</div>
	
    		</div>
  		</div>
	</nav>

	@yield('content')
    
    </body>
</html>
