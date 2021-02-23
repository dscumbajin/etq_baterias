<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$title="Productos | Baterias Ecuador";
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
                    <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoProducto"><span
                            class="glyphicon glyphicon-plus"></span> Nuevo Producto</button>
                </div>
                <h4><i class='glyphicon glyphicon-search'></i> Buscar Producto</h4>
            </div>
            <div class="panel-body">



                <?php
				include("modal/producto/registro_productos.php");
				include("modal/producto/editar_productos.php");
			?>
                <form class="form-horizontal" role="form" id="datos_cotizacion">

                    <div class="form-group row">
                        <label for="q" class="col-md-2 control-label">Producto</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="q" placeholder="Nombre producto"
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
    if($('#usuarios').hasClass('activarnav')){
		$('#usuarios').removeClass('activarnav');
        $('#home').removeClass('activarnav');
		$('#productos').addClass('activarnav');
        
	}
    </script>
    
    <script type="text/javascript" src="js/producto/productos.js"></script>
    <script type="text/javascript" src="js/usuario/usuarios.js"></script>
      
</body>

</html>