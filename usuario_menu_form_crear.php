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

// Viene de valida usuario crear
if(isset($_GET['usuario'])) {

    $usuario=utf8_decode($_SESSION['usuario2']);
    $contrasena=$_SESSION['contrasena2'];
    $nombre=utf8_decode($_SESSION['nombre2']);
    $rol=$_SESSION['rol2'];
    
}else{

    $usuario="";
    $contrasena="";
    $nombre="";
    $rol="";
  
}

//echo $_SESSION['usuario2'];
//echo "...";
//exit();



?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Usuario - Form - Crear</title>

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

<script>

  $(document).on('ready',function(){

    $('#btn-enviar').click(function(){

      // confirmation
      $.confirm({
      title: 'Mensaje',
      content: '¿Confirma en guardar?',
      animation: 'scale',
      closeAnimation: 'zoom',
        buttons: {
          confirm: {
          text: 'Si',
          btnClass: 'btn-orange',

            action: function(){

               var url = "usuario_menu_form_crear_validar.php";     

               $.ajax({                        
               type: "POST",                 
               url: url,                    
               data: $("#formulario_usuario_crear").serialize(),
               beforeSend: function () {
                $("#resultado").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
               },
               success: function(data)            
               {
                $('#resultado').html(data);           
               }
               });          
             
            } // action: function(){

          }, // confirm: {

          cancelar: function(){
              
          } // cancelar: function()
    
        } // buttons
  
      }); // $.confirm

    });

  });

</script>

</head>
<body class="body1">

<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
      <p class="navbar-brand"><span class="menu2">Venezon</span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menu</a></span></p> 
      <p class="navbar-brand"><span class="menu2"><a href="usuario_menu.php">Volver</a></span></p> 

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

  <h4>Agregar Usuario</h4>

    <form id="formulario_usuario_crear" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="usuario" class="control-label col-md-2">Usuario:</label>
        <div class="col-md-4">
          <input id="usuario" class="form-control" type="text" name="usuario" size="20" maxlength="20" autofocus value="<?php echo $usuario ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="contrasena" class="control-label col-md-2">Contraseña:</label>
        <div class="col-md-4">
          <input id="contrasena" class="form-control" type="text" name="contrasena" size="20" maxlength="20" value="<?php echo $contrasena ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="nombre" class="control-label col-md-2">Nombres:</label>
        <div class="col-md-7">
          <input id="nombre" class="form-control" type="text" name="nombre" size="50" maxlength="50" value="<?php echo $nombre ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="rol" class="control-label col-md-2">Rol:</label>
        <div class="col-md-4">
          <input id="rol" class="form-control" type="text" name="rol" size="20" maxlength="20" value="<?php echo $rol ?>"/>
        </div>
      </div>

      <input id="id_usuario" class="form-control" type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>"/>

      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success" /><b>Guardar</b></button>
        </div>

      </div>
      <div id="resultado"></div>

    </form>

</div>

<br/>

<?php 

    if ( isset($_SESSION['usuario_mensaje']) && $_SESSION['usuario_mensaje'] == "si" ) {

      $_SESSION['usuario_mensaje']='no';
      $contenido_mensaje=$_SESSION['contenido_usuario_mensaje'];
      echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>$contenido_mensaje.</span>',
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