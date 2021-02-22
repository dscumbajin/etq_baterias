<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombre'])) {
	$errors[] = "Nombre vacío";
}
elseif (empty($_POST['nombre'])) {
	$errors[] = "Nombre vacío";
} else if (!empty($_POST['nombre'])) {
	/* Connect To Database*/
	require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code


	$usuario = mysqli_real_escape_string($con, (strip_tags($_POST["usuario"], ENT_QUOTES)));
	$nombre = mysqli_real_escape_string($con, (strip_tags($_POST["nombre"], ENT_QUOTES)));
	$password = mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES)));
	$email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
	$estado = intval($_POST['estado']);

	$sql = "INSERT INTO usuario (nom_user ,nick ,pass, mail_user , est_user ) VALUES ('$nombre','$usuario','$password','$email','$estado')";
	$query_new_insert = mysqli_query($con, $sql);
	if ($query_new_insert) {
		$messages[] = "Usuario ha sido ingresado satisfactoriamente.";
	} else {
		$errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
	}
} else {
	$errors[] = "Error desconocido.";
}

if (isset($errors)) {

?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong>
		<?php
		foreach ($errors as $error) {
			echo $error;
		}
		?>
	</div>
<?php
}
if (isset($messages)) {

?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
		foreach ($messages as $message) {
			echo $message;
		}
		?>
	</div>
<?php
}

?>