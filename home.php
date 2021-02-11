<?php

session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

/* Connect To Database*/
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos

$active_clientes = "active";

$title = "Home | Baterias Ecuador";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>

<body>
    <?php
    include("navbar.php");
    ?>

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
            
            </div>
            <div class="panel-body">



            </div>
        </div>

    </div>
    <hr>
    <?php
    include("footer.php");
    ?>
    <script>
        if ($('#historico').hasClass('activarnav')) {
            $('#historico').removeClass('activarnav');
            $('#cliente').addClass('activarnav');
            $('#facturacion').removeClass('activarnav');
        }
    </script>
    <script type="text/javascript" src="js/usuario/usuarios.js"></script>
</body>

</html>