<?php

include('../is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once("../../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	if ($delete1 = mysqli_query($con, "DELETE FROM bateria WHERE id_bateria='" . $id . "'")) {
?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Aviso! </strong> Datos eliminados exitosamente.
		</div>
	<?php
	} else {
	?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
		</div>
	<?php

	}
}

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	// idUsu, usuario, nombreUsu, password, mail, idestado
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('nombProducto', 'codigo_inicio', 'modelo', 'tipo_bater'); //Columnas de busqueda
	$sTable = "bateria";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= " order by id_bateria DESC";
	include '../pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 10; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = '../../productos.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data


	if ($numrows > 0) {

	?>
		<div class="table-responsive">
			<table id="registrosTable" class="table ">
				<tr class="info">

					<th>codCRM</th>
					<th>codNeural</th>
					<th>Producto</th>
					<th>Producto según neural</th>
					<th>Modelo</th>
					<th>Código LP</th>
					<th>Código Garantía</th>
					<th>Tipo</th>
					<th>Estado</th>
					<th>Acciones</th>

				</tr>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					// idUsu, usuario, nombreUsu, password, mail, idPerfil
					$id = $row['id_bateria'];
					$codCrm = $row['codCrm'];
					$codNeural = $row['codNeural'];
					$nombProducto = $row['nombProducto'];
					$nombProdNeural = $row['nombProdNeural'];
					$modelo = $row['modelo'];
					$codigoLP = $row['codigoLP'];
					$codigo_inicio = $row['codigo_inicio'];
					$tipo_bater = $row['tipo_bater'];
					$estado = $row['estado_bater'];
					if ($estado == 1) {
						$estado_bater = "Activo";
					} else {
						$estado_bater = "Inactivo";
					}
				?>

					<input type="hidden" value="<?php echo $codCrm; ?>" id="codCrm<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $codNeural; ?>" id="codNeural<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $nombProducto; ?>" id="nombProducto<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $nombProdNeural; ?>" id="nombProdNeural<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $modelo; ?>" id="modelo<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $codigoLP; ?>" id="codigoLP<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $codigo_inicio; ?>" id="codigo_inicio<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $tipo_bater; ?>" id="tipo_bater<?php echo $id; ?>">
					<input type="hidden" value="<?php echo $estado; ?>" id="estado<?php echo $id; ?>">
					<tr>
						<td><?php echo $codCrm; ?></td>
						<td><?php echo $codNeural; ?></td>
						<td><?php echo $nombProducto; ?></td>
						<td><?php echo $nombProdNeural; ?></td>
						<td><?php echo $modelo; ?></td>
						<td><?php echo $codigoLP; ?></td>
						<td><?php echo $codigo_inicio; ?></td>
						<td><?php echo $tipo_bater; ?></td>
						<td><?php echo $estado_bater; ?></td>
						<td><span>
								<a href="#" title='Editar producto' onclick="obtener_datos('<?php echo $id; ?>');" data-toggle="modal" data-target="#modProducto"><i class="glyphicon glyphicon-edit"></i></a>
								<?php if ($_SESSION['user_name'] == 'soporte') { ?>
									<a href="#" title='Borrar producto' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash" style="color: red;"></i> </a>

								<?php } ?>

							</span>
						</td>

					</tr>
				<?php
				}
				?>

			</table>
			<div class="paginacion">

				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?>

			</div>
		</div>
		<?php
	} else {
		if ($_GET['q'] != "") {
		?>
			<div class="alert alert-danger text-center" role="alert">
				No existen baterias filtrados con el dato: <?php echo $_GET['q']; ?>
			</div>
<?php
		}
	}
}
?>