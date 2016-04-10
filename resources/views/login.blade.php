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