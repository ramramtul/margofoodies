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
					        	<img src="images/promo2.jpg" alt="Chania" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo2.jpg" alt="Chania" width="400" height="300">
					      	</div>
					      	<div class="item">
					        	<img src="images/promo2.jpg" alt="Flower" width="400" height="300">
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
	  				<a href="promo">Lihat selengkapnya</a>
  				</div>
  			</div>
  		</div>
	</div>
	<br>
	<div class="container">
		<div class="row">
		    <div class="col-md-5">  
		    	<div class="panel panel-default">
        			<div class="panel-body res1"> 
				    	<h3 style="text-align: center"> Hitung Budgetmu! </h3>
					  	<form role="form" action="{{url('/findFood')}}" method="POST" class="carimakan">
					  		{!! csrf_field() !!}
					    	<div class="form-group">
								<div class="row">
					        		<div class="col-sm-6 "> 
					      				<label for="budget">Berapa budgetmu?</label>
					      				<input type="text" class="form-control" name="budget" id="budget">
					    			</div>
					    			
					    			<div class="col-sm-6 "> 
					      				<label for="porsi">Jumlah orang?</label>
					      				<input type="text" class="form-control" name="porsi" id="porsi">
						     		</div>
								</div>
							</div>
							<div class="row">
									<div class="col-sm-2 col-sm-offset-10">
										<button type="submit" class="btn" id="cari">Cari</button>
									</div>
							</div>
					  	</form>
				  		<br>
				  	</div>
				</div>
			</div>
			<div class="col-md-5 col-md-offset-1">
			 	<div class="panel panel-default">
        			<div class="panel-body res2">
					  	<form role="form" action="{{url('/calculateFood')}}" method="POST" class="hitungmakan"> 
					  		{!! csrf_field() !!}
					  		
				    		<div style="text-align: center;">
					    		<h3> Kalkulator Patungan </h3>
					    		<h5>(<a href="" >Masuk </a> terlebih dahulu)</h5>
					    	</div>
			
						    <div class="form-group">
								<div class="row">
					        		<div class="col-sm-10 col-sm-offset-1 "> 
					        			<?php
					        			use App\Restoran;

					        			$restoran = Restoran::orderBy("nama")->get();
					        			echo "<select class='form-control' name='restoran'>";
					        			foreach($restoran as $resto) {
									    	echo "<option value='$resto[id]'> $resto[nama] </option>";
									    }
									    echo "</select>";

					        			?>
					    			</div>
					    		</div>
					    	</div>
					    	<div class="form-group">
					    		<div class="row">	
					    			<div class="col-sm-4 col-sm-offset-1"> 
					      				<input type="text" pattern="^(?!0+$)\d+$" class="form-control" placeholder="Jumlah orang" name="orang" id="orang" required="true">
						     		</div>
					    			
									<div class="col-sm-2 col-sm-offset-4 ">
										<button type="submit" class="btn" id="hitung">Hitung</button>
									</div>
								</div>
							</div>
					  	</form>
				  	</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
@stop