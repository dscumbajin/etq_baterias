<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
	// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
	// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
	require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
	// the user is logged in. you can do whatever you want here.
	// for demonstration purposes, we simply show the "you are logged in" view.
	header("location: home.php");
} else {
	// the user is not logged in. you can do whatever you want here.
	// for demonstration purposes, we simply show the "you are not logged in" view.
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
		<title>BATERIAS ECUADOR | Login</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- CSS  -->
		<link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<link rel=icon href='img/favicon.ico' sizes="32x32" type="image/png">
		<link href="css/fontawesome.css" rel="stylesheet">
		<link href="css/brands.css" rel="stylesheet">
		<link href="css/solid.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<style>
			* {
				font-family: 'Roboto', sans-serif;
			}

			input,
			button {
				font-weight: normal !important;
			}

			input {
				background: #f2f2f2 !important;
				padding: 10px 20px !important;
				border: none !important;
				height: 40px !important;
				transition: all 300ms ease-in !important;
				border-bottom: 1px solid #c3c3c3 !important;

			}

			input:hover {
				border-bottom: 1px solid #666666 !important;

			}

			input:focus,
			button:focus {
				outline: none !important;
				box-shadow: none !important
			}

			label {
				color: #666666 !important;
				font-size: 15px !important;
				margin-bottom: 15px;

			}

			i {
				cursor: pointer;
			}

			@media(max-width:600px) {
				.card {
					min-width: 400px !important;
				}

				.navbar-footer {
					float: none !important;
				}

				.acciones {
					flex-direction: column !important;
				}

				.acciones button {
					flex: 0 1 100% !important;
				}

				button {
					margin-left: 0 !important;
				}
			}

			@media(max-width:450px) {
				.card {
					min-width: 300px !important;
				}

			}

			@media(max-width:400px) {
				.card {
					min-width: 200px !important;
					padding: 40px 25px 40px 25px !important;
				}

			}

			@media(max-width:370px) {
				.card {
					min-width: 100% !important;
					width: 100% !important;
				}

			}

			.acciones {
				display: flex;
				margin-top: 40px;
				justify-content: space-between;
			}

			.acciones button {
				flex: 0 1 46% !important;
				cursor: pointer;
				padding: 10px 20px !important;
				width: 100%;
			}

			.acciones .btn-signin {
				margin-top: 0 !important;
				height: 40px;
			}
		</style>

		<script>
			function reset_password() {
				location.href = "reset_password.php";
			}
		</script>

	</head>

	<body style="background:#f2f2f2">
		<nav class="navbar ">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="padding:10px;">
					<a href="home.php">
						<!--<img width="25%" src="img/logobat.png" alt="Logo">-->
					</a>
				</div>
			</div>
			</div>
			<div class="container">
				<div class="card card-container" style="background:#fff; min-width:400px;height:100%;">
					<div class="center">
						<!-- LOGO -->
						<div id="logo">
							<img src="img/logo-baterias.png" class="app-logo" alt="Logotipo" />

						</div>
					</div>

					<div class="clearfix"></div>
					<p id="profile-name" class="profile-name-card"></p>
					<form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
						<?php
						// show potential errors / feedback (from login object)
						if (isset($login)) {
							if ($login->errors) {
						?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<strong>Error!</strong>

									<?php
									foreach ($login->errors as $error) {
										echo $error;
									}
									?>
								</div>
							<?php
							}
							if ($login->messages) {
							?>
								<div class="alert alert-success alert-dismissible" role="alert">
									<strong>Aviso!</strong>
									<?php
									foreach ($login->messages as $message) {
										echo $message;
									}
									?>
								</div>
						<?php
							}
						}
						?>
						<span id="reauth-email" class="reauth-email"></span>
						<label for="user_name">Usuario</label>
						<input class="form-control" placeholder="Usuario" name="user_name" id="user_name" type="text" value="" autofocus="" required>
						<label for="user_password" style="margin-top:10px;">Contraseña</label>
						<input class="form-control" placeholder="Contraseña" name="user_password" id="user_password" type="password" value="" autocomplete="off" required>
						<div class="acciones">
							<button type="submit" class="btn btn-lg btn-success  btn-signin" name="login" id="submit">Iniciar Sesión</button>
							<button class="hidden" type="button" onclick="reset_password()" class="btn btn-lg btn-success btn-signin" style="margin-left:10px;" name="login" id="submit">Recuperar Contraseña</button>
						</div>
					</form><!-- /form -->

				</div><!-- /card-container -->
			</div><!-- /container -->
			<div class="navbar navbar-footer navbar-fixed-bottom" style="display:flex;justify-content:center;padding:10px 20px; background:#f2f2f2; margin:auto">
				<div class="container" style="padding:10px;">
					<p class="navbar-footer pull-right" style="background:#f2f2f2; margin:auto; color:#666666">Copyright &copy <?php echo date('Y'); ?> - BATERIAS ECUADOR.
						<a href="http://bateriasecuador.com/" target="_blank" style="color: #666666; ">DERECHOS RESERVADOS</a>
					<div class="btn-group pull-left">

						<a href="http://bateriasecuador.com/" target="_blank" style="color: #666666; margin-right:10px;">www.bateriasecuador.com </a>
						<a href="https://web.facebook.com/bateriasecuador/" target="_blank"><i style="color:#666666" class="fab fa-facebook x-3"></i></a> |
						<a href="https://www.youtube.com/channel/UC_KkHecfX2JmOHLsFNkISTA" target="_blank"><i style="color:#666666" class="fab fa-youtube"></i></a> |
						<a href="https://www.instagram.com/baterias_ecuador/" target="_blank"><i style="color:#666666" class="fab fa-instagram"></i></a>
					</div>
					</p>
				</div>
			</div>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>

	</html>

<?php
}
