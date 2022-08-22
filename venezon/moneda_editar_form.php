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

if(isset($_GET['id_moneda'])) {

    $id_moneda=$_GET['id_moneda'];
    $moneda=utf8_decode($_GET['moneda']);
    $valor_cambio=number_format($_GET['valor_cambio'],2,'.','');

    $_SESSION['id_moneda2']=$id_moneda;
    $_SESSION['moneda2']=$moneda;
    $_SESSION['valor_cambio2']=$valor_cambio;
 
}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Moneda - Editar - Form</title>

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
      <p class="navbar-brand"><span class="menu2"><a href="moneda_editar.php">Volver</a></span></p> 

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

  <h4>Editar Moneda</h4>

    <form id="formulario_moneda" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="moneda" class="control-label col-md-1">Moneda:</label>
        <div class="col-md-3">
          <input id="user" class="form-control" type="text" name="moneda" size="20" maxlength="20" autofocus value="<?php echo $moneda ?>"/>
        </div>
      </div>

      <div class="form-group">
        <label for="monto" class="control-label col-md-1">Monto:</label>
        <div class="col-md-3">
          <input id="pass" class="form-control" type="text" name="monto" size="18" maxlength="18" value="<?php echo $valor_cambio ?>"/>
        </div>
        <label for="monto" class="control-label col-md-0"><span class="text-warning">por ejemplo: 170582.23</span></label>
      </div>

      <input id="idmoneda" class="form-control" type="hidden" name="id" value="<?php echo $id_moneda ?>"/>

      <div class="form-group">
        <div class="col-md-1 col-md-offset-1">
          <button class="btn btn-success" name="submit2" onclick="Validar(document.getElementById('user').value,document.getElementById('pass').value,document.getElementById('idmoneda').value);"><b>Guardar</b></button></p>
        </div>

      </div>
      <div id="resultado"></div>

    </form>

</div>

<script>

// Boton Guardar
function Validar(user,pass,idmoneda) {
  
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

              $.ajax({
            url: "moneda_editar_form_validar.php",
            type: "POST",
            data: "user="+user+"&pass="+pass+"&idmoneda="+idmoneda,
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

    if ( isset($_SESSION['moneda_mensaje']) && $_SESSION['moneda_mensaje'] == "si" ) {

      $_SESSION['moneda_mensaje']='no';
      $contenido_mensaje=$_SESSION['contenido_mensaje'];
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