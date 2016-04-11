@extends('layout')

@section('title')
	<title>MargoFoodies - Home</title>
@stop

@section('content')
	<div class="container-fluid" >
  		<div class="row">
        	<div class="col-sm-4 col-sm-offset-4">
				<div class="judul"> <h2> Promo bulan ini! </h2>
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
					        	<img src="images/promo2.jpg" alt="Chania" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo1.jpg" alt="Flower" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo2.jpg" alt="Flower" width="400" height="300">
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
		  	<form role="form" action="{{url('/findFood')}}" method="POST">
		  		{!! csrf_field() !!}
		    	<div class="form-group">
					<div class="row">
		        		<div class="col-sm-6 "> 
		      				<label for="budget">Berapa budgetmu?</label>
		      				<input type="text" class="form-control" name="budget" id="budget">
		    			</div>
		    			
		    			<div class="col-sm-3 "> 
		      				<label for="porsi">Untuk berapa orang?</label>
		      				<input type="text" class="form-control" name="porsi" id="porsi">
			     		</div>
		    			
						<div class="col-sm-2 ">
							<label for="cari"> Cari Makanannya!</label>
							<button type="submit" class="btn" id="cari">Cari</button>
						</div>
					</div>
				</div>
		  	</form>
		</div>
	</div>
@stop