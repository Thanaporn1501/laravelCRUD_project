<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
	<div class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
                    <form action="{{ route('authenticate') }}" method="post">
                    @csrf
						<h3>Login</h3>
						<input type="text" name="email" placeholder="Your E-mail">
						<input type="password" name="password" placeholder="password">

                        <button class="submit" type="submit">LOGIN</button>
                        @error('email')
                        <p class="error">{{ $message }}</p>
                        @enderror
					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>FLAVOUR CAFE</h2>
					<h5>LIFE BEFINS AFTER COFFEE</h5>
				</div>
            </div>
		</div>
	</div>
</body>
</html>

