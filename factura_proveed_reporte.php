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

if(isset($_GET['id_factura_proveedor'])){

	$id_factura=$_GET['id_factura_proveedor'];	
	$nro_factura=$_GET['nro_factura_proveedor'];
	$fecha_prov=$_GET['fecha_prov'];
	$total=$_GET['total'];
	$descuento=$_GET['descuento'];
	$total_desc=$_GET['total_desc'];

	$_SESSION['id_factura_rep']=$id_factura;
	$_SESSION['nro_factura_rep']=$nro_factura;
	$_SESSION['fecha_prov_rep']=$fecha_prov;
	$_SESSION['total']=$total;
	$_SESSION['descuento_rep']=$descuento;
	$_SESSION['total_desc']=$total_desc;

	$sql="SELECT tab_proveedores_facturas_reng.id_fact_reng, tab_proveedores_facturas_reng.id_factura_proveedor, ";
  	$sql.="tab_proveedores_facturas_reng.nro_reglon, tab_proveedores_facturas_reng.id_producto, ";
  	$sql.="tab_productos.producto, tab_productos.descripcion, ";
  	$sql.="tab_proveedores_facturas_reng.cantidad, tab_proveedores_facturas_reng.precio_unitario, ";
  	$sql.="tab_proveedores_facturas_reng.precio_total FROM tab_productos ";
    $sql.="INNER JOIN tab_proveedores_facturas_reng ON (tab_productos.id_producto = tab_proveedores_facturas_reng.id_producto) ";
	$sql.="WHERE (tab_proveedores_facturas_reng.id_factura_proveedor = ".$id_factura.") ";
	$sql.="ORDER BY tab_proveedores_facturas_reng.nro_reglon";

	$row = $mysqli->query($sql);
	//$fila = $row->fetch_assoc();

	$total_renglones=$row->num_rows;
	$_SESSION['total_renglones_rep']=$total_renglones;

	//$fila['precio_unitario']

	if($total_renglones!=0){

		$i=0;
		while ($fila = $row->fetch_assoc()) { 	

			$i++;
			$_SESSION['productos2'][$i]=array(

				"cantidad" => $fila['cantidad'],
				"producto" => $fila['producto'],
				"descripcion" => $fila['descripcion'],
				"precio" => $fila['precio_unitario'],
				"orden"  => $i

			);	

		} // for($i=0;$i<$_SESSION['total_productos'];$i++)

	}else{ // if($total_renglones1=0)

		echo "Factura no tiene productos";
		exit();

	} // if($total_renglones1=0)

} // if(isset($_GET['id_factura']))

// Tabla monedas
$sql2="SELECT moneda FROM tab_monedas ORDER BY id_moneda";
$query2 = $mysqli->query($sql2);
$combobit2="<option value='Seleccione'>Seleccione</option>";
while ($row2=$query2->fetch_assoc()) { 

  $combobit2.=" <option value='".$row2['moneda']."'>".$row2['moneda']."</option>"; 
 
}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Factura - Proveedor - Vista</title>

<link rel="stylesheet" href="demo/libs/bundled.css">
<script src="demo/libs/bundled.js"></script>
<script src="js/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
<script type="text/javascript" src="js/jquery-confirm.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
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

  #pass{

  	width:120px;
  	height: 25px;

  }

</style>

<script>
function printe(){
  //desaparece el boton
  document.getElementById("menu").style.display='none';
  document.getElementById("volver").style.display='none';
  document.getElementById("Imprimir").style.display='none';
  document.getElementById("formulario_moneda").style.display='none';
  //se imprime la pagina
  window.print();
  //reaparece el boton
  document.getElementById("menu").style.display='inline';
  document.getElementById("volver").style.display='inline';
  document.getElementById("Imprimir").style.display='inline';
  document.getElementById("formulario_moneda").style.display='inline';

}
</script>

</head>

<body>

<div class="container">

<br/>

<div>

<div align="right" style="float:right;">

<img src='imagen/imgvenezon3.jpg' alt='logo venezon' width='50%' height='auto'>

</div>

<div>

<p class="usuario3">

	<b>Factura Nro.:</b> <?php echo $nro_factura; ?>
	<br/>	
	Fecha Factura: <?php echo $fecha_prov; ?>
	<br/>
	Proveedor: <?php echo $_SESSION['proveedor'] ; ?>
	<br/>
	Cédula o Rif: <?php echo $_SESSION['cedula_proveed']; ?>
	<br/>
	Teléfono: <?php echo $_SESSION['telefono_proveed']; ?>
	<br/>
	Moneda: <?php echo $_SESSION['moneda_base']; ?>
	<br/>
	
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

	//$totalprice=0;
	$nro_reng2=0;
	$cantidad2=0;
	
	for($i=0;$i<$total_renglones;$i++){

		$nro_reng2++;
		$nro_reglon=$nro_reng2;
		
		//$subtotal=$_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio'];
		//$totalprice+=$subtotal;

		$cantidad2+=$_SESSION['productos2'][$nro_reglon]['cantidad'];

?>

	<tr class='table-row'>
		  
		<td><?php echo $_SESSION['productos2'][$nro_reglon]['orden'] ?></td>
		<td><?php echo utf8_decode($_SESSION['productos2'][$nro_reglon]['producto']) ?></td>
		<td><?php echo utf8_decode($_SESSION['productos2'][$nro_reglon]['descripcion']) ?></td>
		<td><div class="cantidad"><?php echo $_SESSION['productos2'][$nro_reglon]['cantidad'] ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['precio'],2,',','.') ?></div></td>
		<td><div class="monto"><?php echo number_format($_SESSION['productos2'][$nro_reglon]['cantidad']*$_SESSION['productos2'][$nro_reglon]['precio'],2,',','.'); ?></div></td>
		
	</tr>

<?php

	} // for($i=0;$i<$_SESSION['total_productos'];$i++)

	//$_SESSION['totalprice']=$totalprice;

?>

  </tbody>
</table>

<div class="total_factura">

	<b>Sub-Total</b>: <?php echo number_format($_SESSION['total'],2,',','.'); ?>
	<br/>
	<b>Descuento(%)</b>: <?php echo number_format($_SESSION['descuento_rep'],2,',','.'); ?>
	<br/>
	<b>Total</b>: <?php echo number_format($_SESSION['total_desc'],2,',','.'); ?>
	<br/>
	<b>Nro. de Productos:</b> <?php echo number_format($cantidad2,0,',','.'); ?>
	
</div>

</form>

<?php 

} // if(isset($_SESSION['productos2']))

?>

</div> <?php // class="table-responsive" ?>

<p>
	<b>Dirección:</b> Carrera 7, Nro. 6-5, El Corozo, Tovar Edo. Médira.
	<br/>
	<b>Telf:</b> 0424-7519699.

</p>

<form id="formulario_moneda" method="post" action="return false" onsubmit="return false">

	<b>Ver factura en otra moneda: </b><select name="pass" id="pass"><?php echo $combobit2;?></select>
	<button class="btn btn-xs btn-success" name="submit3" onclick="Validar2(1,document.getElementById('pass').value);" style="font-family: Arial; font-size: 12pt;"><b>Vista</b></button></p>

</form>

<script>

// Boton Moneda
function Validar2(user, pass)
{

// No seleccionó la moneda
var pass3=pass; 

if (pass3=="Seleccione") {
 
    $.alert({

   		title: 'Mensaje',
   		content: '<span style=color:red>No seleccionó la moneda.</span>',
   		animation: 'scale',
   		closeAnimation: 'scale',
   		buttons: {
       		okay: {
           		text: 'Cerrar',
           		btnClass: 'btn-warning'
       		}
   		}

    });

} else {

	$.ajax({
    	url: "factura_proveed_reporte_validar.php",
    	type: "POST",
    	data: "user="+user+"&pass="+pass,
    	beforeSend: function () {
        	$("#resultado").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
        },
    	success: function(resp){
        	$('#resultado').html(resp)
    	}        
    });

}

}

</script>

<div class="usuario3">
<a id="menu" href="panel.php">Menu</a>
<a id="volver" href="buscar_facturas_proveed.php?id_proveedor=<?php echo $_SESSION['id_proveedor'] ?>">Volver</a>
<a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
</div>
<div id="resultado"></div>
</div>		
</body>
</html>