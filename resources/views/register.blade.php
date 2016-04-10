<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="Tutorial Pemrograman Web">
	    <meta name="author" content="Ramtul">
	    <link rel="icon" href="assets/favicon.png">

	    <title>MargoFoodies | a webapp for find the best combination to eat</title>
	</head>
	<body>
		<form action="{{url('/register')}}" method="POST">
			{!! csrf_field() !!}

			<label>Nama Lengkap</label>
			<input type="text" class="form-control" name="nama_lengkap"></input></br>
			@if ($errors->has('nama_lengkap'))
                <span class="help-block">
                    <strong>{{ $errors->first('nama_lengkap') }}</strong></br>
                </span>
            @endif
			
			<label>Email</label>
			<input type="email" name="email"></input></br>
			@if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong></br>
                </span>
            @endif

			<label>Username</label>
			<input type="text" name="username"></input></br>
			@if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong></br>
                </span>
            @endif
			
			<label>Password</label>
			<input type="password" name="password"></input></br>
			@if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong></br>
                </span>
            @endif
			
			<button type="submit">submit</button>
		</form>
	</body>
	<footer>
		<p>This is example footer</p>
	</footer>
</html>