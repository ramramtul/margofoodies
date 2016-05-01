<?php $error=false; ?>

<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Daftar</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" action="{{url('/home')}}" method="POST">
					{!! csrf_field() !!}
					@if ($errors->has('nama') or $errors->has('email') or $errors->has('password') or $errors->has('re-pass')  )
						<?php $error=true; ?>
						<span class="help-block alert alert-danger ">
							@if ($errors->has('nama'))
								<strong>{{ $errors->first('nama') }}</strong><br>
							@endif
							@if ($errors->has('email'))
								<strong>{{ $errors->first('email') }}</strong><br>
							@endif
							@if ($errors->has('password'))
								<strong>{{ $errors->first('password') }}</strong><br>
							@endif
							@if ($errors->has('re-pass'))
								<strong>{{ $errors->first('re-pass') }}</strong><br>
							@endif
						</span>
					@endif
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="nama">Nama:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama Anda">
						</div>	
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Email:</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="pwd">Password:</label>
						<div class="col-sm-10">          
							<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
						</div>
					</div>

					<div class ="form-group">
						<label class="control-label col-sm-2" for ="repwd">Re-Pass:</label>
						<div class="col-sm-10">
							<input type="password" name="re-pass" class="form-control" id="repwd" placeholder="Re-enter Password">
						</div>	
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

@if ($error)
   	<script> $('#myModal1').modal('show') </script>;
@endif
