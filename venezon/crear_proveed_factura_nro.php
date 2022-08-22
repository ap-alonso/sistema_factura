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

if(!isset($_SESSION['nro_factura_porveed'])) {

  $_SESSION['nro_factura_porveed']="";

} 

if(!isset($_SESSION['fecha_factura_porveed'])) {

  $_SESSION['fecha_factura_porveed']="";

} 


?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Factura - Proveedor - Nro</title>

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
      <p class="navbar-brand"><span class="menu2"><a href="buscar_facturas_proveed.php?id_cliente=<?php echo $_SESSION['id_cliente'] ?>">Volver</a></span></p>  

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
   <b>Proveedor:</b> <?php echo $_SESSION['proveedor']; ?>
   <br/>
   <b>Cédula o Rif:</b> <?php echo $_SESSION['cedula_proveed']; ?>
   <br/>
   <b>Teléfono:</b> <?php echo $_SESSION['telefono_proveed']; ?>
   <br/>
   <b>Moneda:</b> <?php echo $_SESSION['moneda_base']; ?> 
	 </span>	

  </p>

  <h4>Crear Factura Proveedor</h4>

    <form id="formulario_factura_proveedor" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="nro_factura_porveed" class="control-label col-md-3">Nro. Factura Proveedor:</label>
        <div class="col-md-3">
          <input id="user" class="form-control" type="text" name="nro_factura_proveedor" value="<?php echo $_SESSION['nro_factura_porveed'] ?>" size="15" maxlength="15" autofocus/>
        </div>
      </div>

      <div class="form-group">
        <label for="fecha_factura_proveedor" class="control-label col-md-3">Fecha Factura Proveedor:</label>
        <div class="col-md-2">
          <input id="pass" class="form-control" type="text" name="fecha_factura_proveedor" value="<?php echo $_SESSION['fecha_factura_porveed'] ?>" size="10" maxlength="10"/>
        </div>
        <div class="col-md-3">
        <label for="fecha_factura_proveedor" class="control-label col-md-0"><span class="text-warning">por ejemplo: 02-11-1970</span></label>
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-md-1 col-md-offset-3">
          <button class="btn btn-success" name="submit2" onclick="Validar(document.getElementById('user').value,document.getElementById('pass').value);"><b>Continuar</b></button></p>
        </div>

      </div>
      <div id="resultado"></div>

    </form>

</div>

<script>

// Boton Guardar
function Validar(user,pass) {
  
// confirmation
$.confirm({
title: 'Mensaje',
content: '¿Confirma en continuar?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

            action: function(){

              $.ajax({
            url: "crear_proveed_factura_nro_validar.php",
            type: "POST",
            data: "user="+user+"&pass="+pass,
            beforeSend: function () {
                $("#resultado").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
              },
            success: function(resp){
                $('#resultado').html(resp)
            }        
          });
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

} // function Validar(user, pass)

</script>

<?php 

    if ( isset($_SESSION['nro_factura_porveed_nulo']) && $_SESSION['nro_factura_porveed_nulo'] == "si" ) {

      unset($_SESSION['nro_factura_porveed_nulo']);
    
        echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>Debes escribir el Nro. de Factura <br/> del Proveedor.</span>',
              animation: 'scale',
              closeAnimation: 'scale',
              buttons: {
                okay: {
                    text: 'Cerrar',
                    btnClass: 'btn-warning'
                }
              }
          }); 

      </script>";

    }

    if ( isset($_SESSION['fecha_factura_porveed_nulo']) && $_SESSION['fecha_factura_porveed_nulo'] == "si" ) {

      unset($_SESSION['fecha_factura_porveed_nulo']);
    
        echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>Debes escribir la fecha de la Factura <br/> del Proveedor.</span>',
              animation: 'scale',
              closeAnimation: 'scale',
              buttons: {
                okay: {
                    text: 'Cerrar',
                    btnClass: 'btn-warning'
                }
              }
          }); 

      </script>";

    }  

    if ( isset($_SESSION['fecha_factura_porveed_no_valido']) && $_SESSION['fecha_factura_porveed_no_valido'] == "si" ) {

      unset($_SESSION['fecha_factura_porveed_no_valido']);
    
        echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>Fecha de la Factura del Proveedor <br/>no válido.</span>',
              animation: 'scale',
              closeAnimation: 'scale',
              buttons: {
                okay: {
                    text: 'Cerrar',
                    btnClass: 'btn-warning'
                }
              }
          }); 

      </script>";

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