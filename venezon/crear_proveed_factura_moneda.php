<?php 
require("coneccion/connection.php");
session_start();

/*
Nota:
echo $_SESSION['carrito_proveed'][1]['id_producto'];
exit();
*/

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");
    exit();
         
}

$valor_cambio=0;
if(isset($_GET['moneda'])) {

	$moneda=$_GET['moneda'];

	$sql="SELECT id_moneda, moneda, valor_cambio ";
	$sql.="FROM tab_monedas WHERE (moneda = '".$moneda."')";

	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc(); 

	if ($query->num_rows!=0) {

		$valor_cambio=$row['valor_cambio'];
		$moneda=$row['moneda'];
   		
	} else { // $row = $query->fetch_assoc()

		echo "La moneda: ".$moneda." no esta registrada";
		exit();

	} // $row = $query->fetch_assoc()

} // if(isset($_GET['moneda']))

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Crear Factura Proveedor - Moneda</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.10.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="fonts/style.css">

<link rel="shortcut icon" href="imagen/avatar.png" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<style type="text/css">
  .usuario3 {

	color:black;
	font-size:16px;
	
  }
  .total_factura{

  	text-align:right;
  	font-size:16px;

  }

  .cantidad{

  	width:65px;
  	text-align:center;

  }

  .monto{

	text-align:right;  	

  }
  .th_color{

  	background: green;

  }
  .navbar{

  	background: yellow;

  }
  .body1{

  	background:silver;

  }
  .menu2{

  	font-size:24px;
  	color:black;

  }
  .encab{

  	font-size:18px;

  }
  @media screen and (max-width:400px ) {

  .menu2{

  	font-size:19px;
  	color:black;

   }
   
  }	  

</style>

</head>
<body class="body1">

<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Venezon</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menu</a></span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="crear_proveed_factura.php">Volver</a></span></p> 

  </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<div class="container">

<p class="usuario3">

	<span class="encab">
	<span class="text-danger">
	Fecha: <?php echo $_SESSION['fecha']; ?>
	<br/>
	Usuario: <?php echo $_SESSION['usuario']; ?>
	</span>

	<br/>
	<b>Cliente:</b> <?php echo $_SESSION['proveedor'] ; ?>
	<br/>
	<b>Cédula o Rif:</b> <?php echo $_SESSION['nac_proveed']."-".$_SESSION['cedula_proveed']; ?>
	<br/>
	<b>Teléfono:</b> <?php echo $_SESSION['telefono_proveed']; ?>
	<br/>
	<b>Moneda:</b> <?php echo $moneda; ?>
	<br/>
	<b>Valor cambio por dólar:</b> 
	<?php echo number_format($valor_cambio,2,',','.'); ?>
	<?php echo $moneda; ?>
	</span>

</p>

<h3>Crear Factura</h3>

<div class="table-responsive">

<?php if(isset($_SESSION['carrito_proveed'])) { ?>

<form id="formulario_renglones" method="post" action="crear_factura.php">

<table class="table table-bordered">

  <thead>
	<tr class="th_color">
	  
	  <th class='table-header' width='5%'>Nro.</th>
	  <th class='table-header' width='37.5%'>Producto</th>
	  <th class='table-header' width='37.5%'>Descripción</th>
	  <th class='table-header' width='10%'>Cantidad</th>
	  <th class='table-header' width='10%'>Prec/Unit</th>
	  <th class='table-header' width='10%'>Prec/Total</th>
	  
	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php

	$totalprice=0;
	$nro_reng2=0;
	$cantidad2=0;
	
	for($i=0;$i<$_SESSION['total_productos_proveed'];$i++){

		$nro_reng2++;
		$nro_reglon=$nro_reng2;
		
		$subtotal=$_SESSION['carrito_proveed'][$nro_reglon]['cantidad']*$_SESSION['carrito_proveed'][$nro_reglon]['precio'];
		$totalprice+=$subtotal;

		$cantidad2+=$_SESSION['carrito_proveed'][$nro_reglon]['cantidad'];

?>

	<tr class='table-row'>
		  
		<td><?php echo $_SESSION['carrito_proveed'][$nro_reglon]['orden'] ?></td>
		<td><?php echo $_SESSION['carrito_proveed'][$nro_reglon]['producto'] ?></td>
		<td><?php echo $_SESSION['carrito_proveed'][$nro_reglon]['descripcion'] ?></td>
		<td><div class="cantidad"><?php echo $_SESSION['carrito_proveed'][$nro_reglon]['cantidad'] ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['carrito_proveed'][$nro_reglon]['precio']*$valor_cambio,2,',','.') ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['carrito_proveed'][$nro_reglon]['cantidad']*$_SESSION['carrito_proveed'][$nro_reglon]['precio']*$valor_cambio,2,',','.'); ?></div></td>
		
	</tr>

<?php

	} // for($i=0;$i<$_SESSION['total_productos_proveed'];$i++)

	$_SESSION['totalprice']=$totalprice;

?>

  </tbody>
</table>

<div class="total_factura">

	<b>Sub-Total: </b> <?php echo number_format($totalprice*$valor_cambio,2,',','.'); ?>
	<br/>
	<b>Descuento(%): </b> <?php echo $_SESSION['descuento_proveed']; ?>
	<br/>
	<b>Total: </b><?php echo number_format($totalprice*$valor_cambio-$totalprice*$valor_cambio*$_SESSION['descuento_proveed']/100,2,',','.'); ?>
	<br/>
	<b>Nro. de Productos:</b> <?php echo number_format($cantidad2,0,',','.'); ?>


	
</div>

</form>

<?php 

} // if(isset($_SESSION['carrito_proveed']))

?>

</div> <?php // class="table-responsive" ?>

</div>		
<div class="panel-footer">
  <div class="container">
    <?php 
  	// mini Sistemas cjcv
  	require("mini.php"); 
	?>
  </div>
</div>
</body>
</html>