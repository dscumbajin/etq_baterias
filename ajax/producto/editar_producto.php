<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id'])) {
	$errors[] = "Id bateria vacío";
} else if (empty($_POST['mod_nombProducto'])) {
	$errors[] = "Nombre producto vacío";
} else if (empty($_POST['mod_codigo_inicio'])) {
	$errors[] = "Codigo de garantia vacío";
} else if (empty($_POST['mod_tipo_bater'])) {
	$error[] = "Tipo vacío";
} else if (
	!empty($_POST['mod_id']) &&
	!empty($_POST['mod_nombProducto']) &&
	!empty($_POST['mod_codigo_inicio']) &&
	!empty($_POST['mod_tipo_bater'])
) {
	/* Connect To Database*/
	require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code



	$codCrm = mysqli_real_escape_string($con, (strip_tags($_POST["mod_codCrm"], ENT_QUOTES)));
	$codNeural = mysqli_real_escape_string($con, (strip_tags($_POST["mod_codNeural"], ENT_QUOTES)));
	$nombProducto = mysqli_real_escape_string($con, (strip_tags($_POST["mod_nombProducto"], ENT_QUOTES)));
	$nombProdNeural = mysqli_real_escape_string($con, (strip_tags($_POST["mod_nombProdNeural"], ENT_QUOTES)));
	$modelo = mysqli_real_escape_string($con, (strip_tags($_POST["mod_modelo"], ENT_QUOTES)));
	$codigoLP = mysqli_real_escape_string($con, (strip_tags($_POST["mod_codigoLP"], ENT_QUOTES)));
	$codigo_inicio = mysqli_real_escape_string($con, (strip_tags($_POST["mod_codigo_inicio"], ENT_QUOTES)));
	$tipo_bater = mysqli_real_escape_string($con, (strip_tags($_POST["mod_tipo_bater"], ENT_QUOTES)));
	$estado = intval($_POST['mod_estado']);
	$id_bateria = intval($_POST['mod_id']);
	
	$sql = "UPDATE bateria SET codCrm='" . $codCrm . "', codNeural='" . $codNeural . "', nombProducto='" . $nombProducto . "', nombProdNeural='" . $nombProdNeural . "', modelo='" . $modelo . "', codigoLP='" . $codigoLP . "', codigo_inicio='" . $codigo_inicio . "', tipo_bater='" . $tipo_bater . "', estado_bater='" . $estado . "' WHERE id_bateria='" . $id_bateria . "'";
	$query_update = mysqli_query($con, $sql);
	if ($query_update) {
		$messages[] = "Producto actualizado satisfactoriamente.";
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