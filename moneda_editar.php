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
<title>Venezon - Moneda - Editar</title>

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

      <?php 

      if($_SESSION['factura_proveedor_moneda']=='si'){

      ?>

      <p class="navbar-brand"><span class="menu2"><a href="crear_proveed_factura.php">Volver</a></span></p> 

      <?php 

      }else{

      ?>

      <p class="navbar-brand"><span class="menu2"><a href="crear_factura.php">Volver</a></span></p> 

      <?php 

      }

      ?>

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

<h4>Valor del dólar en otras monedas</h4>


<div class="row">
<div class="col-md-8">

<div class="table-responsive">

<form id="formulario_renglones" method="post" action="crear_factura.php">

<?php

// Tabla monedas
$sql2="SELECT * FROM tab_monedas ORDER BY moneda";
$query2 = $mysqli->query($sql2);

if($query2->num_rows==0){

		echo "No hay datos para mostrar";

}else{ // if($query2->num_rows==0)	


?>

<table class="table table-bordered table-hover">

  <thead>
	<tr class='th_color'>
	  
	  <th class='table-header' width='30%'>Moneda</th>
	  <th class='table-header' width='30%'>Monto</th>
	  <th class='table-header' width='40%'>Enlace</th>
	
	</tr>
  </thead>

  <tbody id='table-body'>
	
<?php
	
	while ($row2=$query2->fetch_assoc()) {

?>

		<tr class='table-row'>
		  
			<td><?php echo utf8_decode($row2['moneda']) ?></td>
			<td><div class="monto"><?php echo number_format($row2['valor_cambio'],2,',','.') ?></div></td>
			<td><a href="#" onclick="Validar3('<?php echo $row2['moneda']?>', <?php echo $row2['id_moneda']?>, <?php echo $row2['valor_cambio']?>)">Editar</a></td>
		
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

function Validar3(moneda,id_moneda,valor_cambio)
{

// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en editar los '+moneda+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

	         window.location.href="moneda_editar_form.php?id_moneda="+id_moneda+"&moneda="+moneda+"&valor_cambio="+valor_cambio;				     
             
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

if ( isset($_SESSION['moneda_guardada']) && $_SESSION['moneda_guardada'] == "si" ) {

    unset($_SESSION['moneda_guardada']);
    
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