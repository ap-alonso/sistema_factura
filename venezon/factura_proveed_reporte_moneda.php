<?php 
require("coneccion/connection.php");
session_start();

/*
Nota:
echo $_SESSION['productos2'][1]['id_producto'];
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

	$sql="SELECT id_factura_proveedor, valor_cambio ";
	$sql.="FROM tab_proveedores_facturas_monedas ";
	$sql.="WHERE (moneda = '".$moneda."') AND (id_factura_proveedor = ".$_SESSION['id_factura_rep'].")";

	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc(); 

	if ($query->num_rows!=0) {

		$valor_cambio=$row['valor_cambio'];
   		
	} else { // $row = $query->fetch_assoc()

		echo "La factura no tiene la moneda: ".$moneda." registrada";
		exit();

	} // $row = $query->fetch_assoc()

} // if(isset($_GET['moneda']))

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Factura - Proveedor - Vista - Moneda</title>
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

</style>

<script>
function printe(){
  //desaparece el boton
  document.getElementById("menu").style.display='none';
  document.getElementById("volver").style.display='none';
  document.getElementById("Imprimir").style.display='none';
  //se imprime la pagina
  window.print();
  //reaparece el boton
  document.getElementById("menu").style.display='inline';
  document.getElementById("volver").style.display='inline';
  document.getElementById("Imprimir").style.display='inline';
  
}
</script>

</head>

<body>

<div class="container">

<div>

<div align="right" style="padding-top:20px; float:right;">

<img src='imagen/imgvenezon3.jpg' alt='logo venezon' width='50%' height='auto'>

</div>

<div>

<p class="usuario3">

	<br/>
	<b>Factura Nro.:</b> <?php echo $_SESSION['nro_factura_rep']; ?>
	<br/>	
	Fecha Factura: <?php echo $_SESSION['fecha_prov_rep']; ?>
	<br/>
	Proveedor: <?php echo $_SESSION['proveedor'] ; ?>
	<br/>
	Cédula o Rif: <?php echo $_SESSION['cedula_proveed']; ?>
	<br/>
	Teléfono: <?php echo $_SESSION['telefono_proveed']; ?>
	<br/>
	Moneda: <?php echo $moneda; ?>
	<br/>
	Valor cambio por dólar: <?php echo number_format($valor_cambio,2,',','.'); ?>
	<?php echo $moneda; ?>

</p>

</div>

</div>

<div class="table-responsive">

<?php if(isset($_SESSION['productos2'])) { ?>

<form id="formulario_renglones" method="post" action="crear_factura.php">

<table class="table table-bordered">

  <thead>
	<tr>
	  
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
	
	for($i=0;$i<$_SESSION['total_renglones_rep'];$i++){

		$nro_reng2++;
		$nro_reglon=$nro_reng2;
		
		$subtotal=$_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio'];
		$totalprice+=$subtotal;

		$cantidad2+=$_SESSION['productos2'][$nro_reglon]['cantidad'];

?>

	<tr class='table-row'>
		  
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['orden'] ?></td>
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['producto'] ?></td>
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['descripcion'] ?></td>
		<td><div class="cantidad"><?php echo $_SESSION['productos2'][$nro_reglon]['cantidad'] ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['precio']*$valor_cambio,2,',','.') ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio']*$valor_cambio,2,',','.'); ?></div></td>
		
	</tr>

<?php

	} // for($i=0;$i<$_SESSION['total_productos'];$i++)

	$_SESSION['totalprice']=$totalprice;

?>

  </tbody>
</table>

<div class="total_factura">

	<b>Sub-Total</b>: <?php echo number_format($totalprice*$valor_cambio,2,',','.'); ?>
	<br/>
	<b>Descuento(%)</b>: <?php echo number_format($_SESSION['descuento_rep'],2,',','.'); ?>
	<br/>
	<b>Total</b>: <?php echo number_format($_SESSION['total_desc']*$valor_cambio,2,',','.'); ?>
	<br/>
	<b>Nro. de Productos:</b> <?php echo number_format($cantidad2,0,',','.'); ?>


	
</div>

</form>

<p>
	<b>Dirección:</b> Carrera 7, Nro. 6-5, El Corozo, Tovar Edo. Médira.
	<br/>
	<b>Telf:</b> 0424-7519699.

</p>

<?php 

} // if(isset($_SESSION['productos2']))

?>

</div> <?php // class="table-responsive" ?>

<div class="usuario3">
<a id="menu" href="panel.php">Menu</a>
<a id="volver" href="factura_proveed_reporte.php?id_factura_proveedor=<?php echo $_SESSION['id_factura_rep'] ?>&nro_factura_proveedor=<?php echo $_SESSION['nro_factura_rep'] ?>&fecha_prov=<?php echo $_SESSION['fecha_prov_rep']?>&total=<?php echo $_SESSION['total']?>&descuento=<?php echo $_SESSION['descuento_rep']?>&total_desc=<?php echo $_SESSION['total_desc']?>">Volver</a>
<a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 

</div>
</div>		
</body>
</html>