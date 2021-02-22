<?php
include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombProducto'])) {
	$errors[] = "Nombre de producto vacío";
} else if (empty($_POST['codigo_inicio'])) {
	$errors[] = "Código garantia vacío";
} else if (empty($_POST['tipo_bater'])) {
	$errors[] = "Tipo batería vacío";
} else if (
	!empty($_POST['nombProducto']) &&
	!empty($_POST['codigo_inicio']) &&
	!empty($_POST['tipo_bater'])
) {
	/* Connect To Database*/
	require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
	require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code

	$codCrm = mysqli_real_escape_string($con, (strip_tags($_POST["codCrm"], ENT_QUOTES)));
	$codNeural = mysqli_real_escape_string($con, (strip_tags($_POST["codNeural"], ENT_QUOTES)));
	$nombProducto = mysqli_real_escape_string($con, (strip_tags($_POST["nombProducto"], ENT_QUOTES)));
	$nombProdNeural = mysqli_real_escape_string($con, (strip_tags($_POST["nombProdNeural"], ENT_QUOTES)));
	$modelo = mysqli_real_escape_string($con, (strip_tags($_POST["modelo"], ENT_QUOTES)));
	$codigoLP = mysqli_real_escape_string($con, (strip_tags($_POST["codigoLP"], ENT_QUOTES)));
	$codigo_inicio = mysqli_real_escape_string($con, (strip_tags($_POST["codigo_inicio"], ENT_QUOTES)));
	$tipo_bater = mysqli_real_escape_string($con, (strip_tags($_POST["tipo_bater"], ENT_QUOTES)));
	$estado_bater = intval($_POST['estado_bater']);

	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM bateria WHERE nombProducto = '$nombProducto'");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];

	if ($numrows <= 0) {
		$sql = "INSERT INTO bateria (codCrm, codNeural, nombProducto, nombProdNeural, modelo, codigoLP, codigo_inicio, tipo_bater, estado_bater ) 
		VALUES ('$codCrm','$codNeural','$nombProducto','$nombProdNeural','$modelo','$codigoLP','$codigo_inicio','$tipo_bater','$estado_bater')";
		$query_new_insert = mysqli_query($con, $sql);
		if ($query_new_insert) {
			$messages[] = " Producto ingresado satisfactoriamente.";
		} else {
			$errors[] = " Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
		}
	}else{
		$errors[] = " Producto repetido";
	}
} else {
	$errors[] = " Error desconocido.";
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