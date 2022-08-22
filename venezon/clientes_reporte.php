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

if(isset($_GET['id_cliente'])) {

    $id_cliente=$_GET['id_cliente'];
   
}

// Tabla clientes
$sql2="SELECT * FROM tab_clientes WHERE (id_cliente = $id_cliente)";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

    echo "No hay datos para mostrar";
    exit();

}

$row2=$query2->fetch_assoc();

$valores_fecha_act = explode('-', $row2['fecha_reg']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

// echo $id_cliente;
// exit();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - cliente - Vista</title>

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
  .clientelabel{

    font-size:16px; 
    font-weight: bold;

  }
   .clientedato{

    font-size:16px; 
    
  }
  @media screen and (max-width:400px ) {

  .usuario3 {

    color:black;
    font-size:14px;
  
  }
  .clientelabel{

    font-size:14px; 
    font-weight: bold;

  }
   .clientedato{

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
 
    <span class="clientelabel">Cédula o Rif:</span>
    <span class="clientedato"><?php echo $row2['cedula'] ?></span>
    <br/>

    <span class="clientelabel">Nombres:</span>
    <span class="clientedato"><?php echo utf8_decode($row2['nombres']) ?></span>
    <br/>

    <span class="clientelabel">Apellidos:</span>
    <span class="clientedato"><?php echo utf8_decode($row2['apellidos']) ?></span>
    <br/>

    <span class="clientelabel">Teléfono:</span>
    <span class="clientedato"><?php echo $row2['telefono'] ?></span>
    <br/>

    <span class="clientelabel">Dirección:</span>
    <span class="clientedato"><?php echo utf8_decode($row2['direccion']) ?></span>
    <br/>

    <span class="clientelabel">Correo:</span>
    <span class="clientedato"><?php echo $row2['correo'] ?></span>
    <br/>

    <span class="clientelabel">Fecha Registro:</span>
    <span class="clientedato"><?php echo $fecha_act ?></span>
    <br/>

    <span class="clientelabel">Hora Registro:</span>
    <span class="clientedato"><?php echo $row2['hora_reg'] ?></span>
    <br/>

  </div> <!-- class="form-group" -->

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menu</a>
    <a id="volver" href="Buscar_clientes.php">Volver</a>
    <a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>