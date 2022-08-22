<?php
session_start();

$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");

    exit();
         
}

session_destroy();
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/estilos3.css">
    <title>Sesión Cerrador</title>
    <link rel="shortcut icon" href="imagen/avatar.png" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<style type="text/css">

  .body1{

    background:#906b6b;

  }

</style>

<body class="body1">

<div> 	
<p class="sesioncerrado1">
    Sesión Cerrado
    <br/>
    <a class="sesioncerrado2" href="index.php">Ir a la Página Iniciar Sesión</a>
</p>
</div>

</body>
</html>