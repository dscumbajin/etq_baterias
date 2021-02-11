<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_clientes="active";

	$title="Vendedor | Baterias Ecuador";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>

<body>
    <?php
	include("navbar.php");
	?>

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoUsuario"><span
                            class="glyphicon glyphicon-plus"></span> Nuevo Vendedor</button>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Buscar Vendedor</h4>
            </div>
            <div class="panel-body">



                <?php
				include("modal/usuario/registro_usuarios.php");
				include("modal/usuario/editar_usuarios.php");
			?>
                <form class="form-horizontal" role="form" id="datos_cotizacion">

                    <div class="form-group row">
                        <label for="q" class="col-md-2 control-label">Vendedor</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="q" placeholder="Nombre vendedor"
                                onkeyup='load(1);'>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-default" onclick='load(1);'>
                                <span class="glyphicon glyphicon-search"></span> Buscar</button>
                            <span id="loader"></span>
                        </div>

                    </div>



                </form>
                <div id="resultados"></div><!-- Carga los datos ajax -->
                <div class='outer_div'></div><!-- Carga los datos ajax -->

            </div>
        </div>

    </div>
    <hr>
    <?php
	include("footer.php");
	?>
    <script>
    if($('#historico').hasClass('activarnav')){
		$('#historico').removeClass('activarnav');
		$('#cliente').addClass('activarnav');
		$('#facturacion').removeClass('activarnav');
	}
    </script>
    <script type="text/javascript" src="js/vendedor/vendedores.js"></script>
<!--     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
</body>

</html>