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