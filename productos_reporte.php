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

if(isset($_GET['id_producto'])) {

    $id_producto=$_GET['id_producto'];
   
}

// Tabla productos
$sql2="SELECT * FROM tab_productos WHERE (id_producto = $id_producto)";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

    echo "No hay datos para mostrar";
    exit();

}

$row2=$query2->fetch_assoc();
// echo $row2['producto'];

/*
  producto,
  descripcion,
  precio_compra,
  precio_final,
  ganancia,
  cantidad_producto,
  cantidad_venta,
  cantidad_existencia,
  fecha_compra,
  id_usuario
*/

$valores_fecha_act = explode('-', $row2['fecha_reg']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

// echo $id_producto;
//exit();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Producto - Vista</title>

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
  .productolabel{

    font-size:16px; 
    font-weight: bold;

  }
   .productodato{

    font-size:16px; 
    
  }
  @media screen and (max-width:400px ) {

  .usuario3 {

    color:black;
    font-size:14px;
  
  }
  .productolabel{

    font-size:14px; 
    font-weight: bold;

  }
   .productodato{

    font-size:14px; 
    
  }
   
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

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <img src='imagen/imgvenezon3.jpg' alt='logo venezon' width='80px' height='auto'>

  </div>

  <div class="form-group">
 
    <span class="productolabel">Código:</span>
    <span class="productodato"><?php echo $row2['cod_producto_2'] ?></span>
    <br/>
 
    <span class="productolabel">Producto:</span>
    <span class="productodato"><?php echo utf8_decode($row2['producto']) ?></span>
    <br/>

    <span class="productolabel">Descripcion:</span>
    <span class="productodato"><?php echo utf8_decode($row2['descripcion']) ?></span>
    <br/>

    <span class="productolabel">Precio Compra:</span>
    <span class="productodato"><?php echo number_format($row2['precio_compra'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Precio Final:</span>
    <span class="productodato"><?php echo number_format($row2['precio_final'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Ganancia:</span>
    <span class="productodato"><?php echo number_format($row2['ganancia'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Cantidad Producto:</span>
    <span class="productodato"><?php echo number_format($row2['cantidad_producto'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Cantidad Venta:</span>
    <span class="productodato"><?php echo number_format($row2['cantidad_venta'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Existencia:</span>
    <span class="productodato"><?php echo number_format($row2['cantidad_existencia'],2,',','.') ?></span>
    <br/>

    <span class="productolabel">Fecha Registro:</span>
    <span class="productodato"><?php echo $fecha_act ?></span>
    <br/>

    <span class="productolabel">Hora Registro:</span>
    <span class="productodato"><?php echo $row2['hora_reg'] ?></span>
    <br/>

  </div> <!-- class="form-group" -->

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menu</a>
    <a id="volver" href="productos.php">Volver</a>
    <a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>