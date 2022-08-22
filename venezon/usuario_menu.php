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

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Usuario - Menú</title>

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
  </span>

</p>

<h4>Usuarios</h4>


<div class="row">
<div class="col-md-12">

<p><span class="#"><a href="usuario_menu_form_crear.php">Agregar Usuario</a></span></p>
<div class="table-responsive">

<form id="formulario_usuarios" method="post" action="crear_factura.php">

<?php

// Tabla monedas
$sql2="SELECT * FROM tab_usuarios ORDER BY usuario";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

		echo "No hay datos para mostrar";

}else{ // if($query2->num_rows==0)	


?>

<table class="table table-bordered table-hover">

  <thead>
	<tr class='th_color'>
	  
	  <th class='table-header' width='15%'>Usuarios</th>
	  <th class='table-header' width='15%'>Contraseña</th>
    <th class='table-header' width='20%'>Rol</th>
    <th class='table-header' width='30%'>Nombre</th>
	  <th class='table-header' width='20%'>Enlace</th>
	
	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php
	
	while ($row2=$query2->fetch_assoc()) {

?>

		<tr class='table-row'>
		  
			<td><?php echo utf8_decode($row2['usuario']) ?></td>
			<td><?php echo $row2['contrasena'] ?></td>
      <td><?php echo $row2['rol'] ?></td>
      <td><?php echo  utf8_decode($row2['nombre']) ?></td>
			<td>

        <a href="#" onclick="Validar3(<?php echo $row2['id_usuario']?>, '<?php echo $row2['usuario']?>', '<?php echo $row2['contrasena']?>', '<?php echo $row2['nombre']?>', '<?php echo $row2['rol']?>')">Editar</a>
        <a href="#" onclick="Validar4(<?php echo $row2['id_usuario']?>, '<?php echo $row2['usuario'] ?>')">Eliminar</a>

      </td>
		
		</tr>

<?php

	} // while ($row2=$query2->fetch_assoc())

?>

  </tbody>
</table>

<?php

} // if($query2->num_rows==0)

?>


</form>

<div id="resultado"></div>
<br/>

<script>

// Editar usuario
function Validar3(id_usuario,usuario,contrasena,nombre,rol)
{

// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en editar el usuario '+usuario+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

	         window.location.href="usuario_menu_form_editar.php?id_usuario="+id_usuario+"&usuario="+usuario+"&contrasena="+contrasena+"&nombre="+nombre+"&rol="+rol;				     
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
	} // buttons
  
}); // $.confirm

}

// Eliminar usuario
function Validar4(id_usuario,usuario)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en eliminar <br/> el Usuario '+usuario+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="usuario_menu_eliminar_validar.php?id_usuario="+id_usuario;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

</script>

</div> <?php // class="table-responsive" ?>

</div> <!-- div class="col-md-8" -->

</div> <!-- div class="row" -->

</div>	

<?php 

if ( isset($_SESSION['usuario_guardado']) && $_SESSION['usuario_guardado'] == "si" ) {

    unset($_SESSION['usuario_guardado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Datos guardado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['usuario_eliminado']) && $_SESSION['usuario_eliminado'] == "si" ) {

    unset($_SESSION['usuario_eliminado']);
    
    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:green>Usuario eliminado con éxito.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

if ( isset($_SESSION['usuario_tiene_mov']) && $_SESSION['usuario_tiene_mov'] == "si" ) {

    unset($_SESSION['usuario_tiene_mov']);
    
    $usuario_npe=$_SESSION['usuario_npe'];

    echo "<script>

    $.confirm({
      title: 'Mensaje',
      content: '<span style=color:red>No se puede eliminar el Usuario $usuario_npe<br/>porque tiene movimientos.</span>',
      autoClose: 'Cerrar|3000',
      buttons: {
          Cerrar: function () {
            
          }
      }
    
    });</script>";

}

?>

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