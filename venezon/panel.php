<?php 

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");

  exit();
         
}

$sql = "SELECT current_date";
$row = $mysqli->query($sql);
$consultaf = $row->fetch_assoc();

$fechadelmysql = date_create($consultaf['current_date']);
$fechadelmysql = date_format($fechadelmysql, 'd-m-Y');
$_SESSION['fecha'] = $fechadelmysql;

$sql = "SELECT DATE_FORMAT(NOW( ), '%h:%i:%S %p' ) as hora";
$row2 = $mysqli->query($sql);
$consultaf2 = $row2->fetch_assoc();
$hora_actual=$consultaf2['hora'];
$_SESSION['hora_actual'] = $hora_actual;

/*
$sql = "SELECT DATE_FORMAT(NOW( ), '%d-%m-%Y' ) as fecha";
$row3 = $mysqli->query($sql);
$consultaf3 = $row3->fetch_assoc();
$fecha_actual=$consultaf3['fecha'];
$_SESSION['fecha'] = $fecha_actual;
*/

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Menu</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>

<link rel="stylesheet" type="text/css" href="css/estilos2.css">
<link rel="stylesheet" type="text/css" href="fonts/style.css">
<link rel="shortcut icon" href="imagen/avatar.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style>

	ul span {

		color:white;
		font-size: 25px;

	}

</style>

</head>
<body>

<div class="contenedor">

	<header>

		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-menu"></span>Menu</a>
		</div>

		<nav>

			<ul>

				<li><a href="buscar_clientes.php">Ventas</a></li>
				<li><a href="buscar_proveedores.php">Compras</a></li>
				<li><a href="productos.php">Productos</a></li>
				<li><a href="reportes.php">Reportes</a></li>
				<li><a href="moneda_menu.php">Dólar</a></li>		
				<li><a href="usuario_menu.php">Usuarios</a></li>	
				<li><a href="acerca.php">Acerca</a></li>
				<li><a href="#" onclick="Validar3();">Cerrar</a></li>	

			</ul>	

		</nav>	

		<p class="usuario">

			<?php 
  				// mini Sistemas cjcv
  				require("mini.php"); 
			?>
			<span class="text-danger">
			<br/>			
			Fecha Sistema: <?php echo $_SESSION['fecha']; ?>
			<br/>			
			Hora Sistema: <?php echo $_SESSION['hora_actual']; ?>
			<br/>
			Usuario: <?php echo $_SESSION['usuario']; ?>
			</span>

		<p>
				
	</header>

	<section class="main">

		<img class="imagen1" src="imagen/imgvenezon1.jpg" alt="">
		<img class="imagen2" src="imagen/imgvenezon2.jpg" alt="">
		<img class="imagen4" src="imagen/imgvenezon4.jpg" alt="">

	</section>

	<script src="js/menu.js"></script>

</div>		

<script>

function Validar3()
{
// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en cerrar Sesion?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',
           action: function(){
	         window.location.href="cerrando.php";				     
           } // action: function(){

    }, // confirm: {
    cancelar: function(){
    } // cancelar: function()
	} // buttons
}); // $.confirm
}

</script>

</body>
</html>