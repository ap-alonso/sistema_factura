<?php  

sleep(1);

require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

	header("Location:error1.php");
	exit();
         
}

//validación
$error_form = "";

if ($_POST["nac"] == "") {

	$_SESSION['contenido_mensaje_cliente']='Debes escribir el campo antes de la Cédula';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];
   
    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $nac=$_POST["nac"];

}

if ($_POST["cedula"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Cédula o Rif';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $cedula="";
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $cedula=$_POST["cedula"];

}

$cedula_numero =  is_numeric($_POST["cedula"]);
if ($cedula_numero==false){

    $_SESSION['contenido_mensaje_cliente']='La Cédula o Rif debe ser un número';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $cedula="";
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}

$cedula_decimal=number_format($_POST["cedula"],1);
$cedula_decimal = explode('.', $cedula_decimal);

if ($cedula_decimal[1]!=0){

    $_SESSION['contenido_mensaje_cliente']='La Cédula debe ser un número entero';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $cedula="";
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}


if ($_POST["rif_final"] != "") {

    $rif_final_numero =  is_numeric($_POST["rif_final"]);
    if ($rif_final_numero==false){

        $_SESSION['contenido_mensaje_cliente']='Numeral del Rif debe ser un número';
        $_SESSION['cliente_mensaje']='si';

        $nac=$_POST["nac"];
        $_SESSION['cedula']=$_POST["cedula"];
        $rif_final="";
        $_SESSION['nombres']=$_POST["nombres"];
        $_SESSION['apellidos']=$_POST["apellidos"];
        $_SESSION['telefono']=$_POST["telefono"];
        $_SESSION['direccion']=$_POST["direccion"];
        $_SESSION['correo']=$_POST["correo"];

        echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
        exit();

    }

}

if ($_POST["rif_final"] == "") {

    $rif_final="";

}else{

    $rif_final=$_POST["rif_final"];

}

if ($_POST["nombres"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir los Nombres';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']="";
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $nombres=utf8_encode($_POST["nombres"]);

}

if ($_POST["apellidos"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir los Apellidos';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']="";
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $apellidos=utf8_encode($_POST["apellidos"]);

}

if ($_POST["telefono"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir el Teléfono';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']="";
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $telefono=$_POST["telefono"];

}

if ($_POST["direccion"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Dirección';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']="";
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $direccion=utf8_encode($_POST["direccion"]);

}

if ($_POST["correo"] == "") {

    $_SESSION['contenido_mensaje_cliente']='Debes escribir la Correo';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']="";

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}else{

    $correo=$_POST["correo"];

}

$cedula=$nac."-".$cedula;

if($rif_final!=""){

    $cedula=$cedula."-".$rif_final;

}

// Chequea que existe la cédula o rif del cliente
$sql20="SELECT cedula FROM tab_clientes WHERE (cedula = '$cedula')";
$query20 = $mysqli->query($sql20);
// $row20=$query20->fetch_assoc();

if ($query20->num_rows!=0) {

    $_SESSION['contenido_mensaje_cliente']='Cédula o Rif ya existe';
    $_SESSION['cliente_mensaje']='si';

    $nac=$_POST["nac"];
    $_SESSION['cedula']=$_POST["cedula"];
    $_SESSION['rif_final']=$_POST["rif_final"];
    $_SESSION['nombres']=$_POST["nombres"];
    $_SESSION['apellidos']=$_POST["apellidos"];
    $_SESSION['telefono']=$_POST["telefono"];
    $_SESSION['direccion']=$_POST["direccion"];
    $_SESSION['correo']=$_POST["correo"];

    echo "<script>location.href = 'clientes_crear.php?nac=$nac'</script>";    
    exit();

}

$valores_fecha_act = explode('-', $_SESSION['fecha']);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];
$hora_actual=$_SESSION['hora_actual'];

$id_usuario_cp=$_SESSION["id_usuario"];

// Guarda datos 
$sql="INSERT INTO tab_clientes (cedula, nombres, apellidos, telefono, direccion, correo, fecha_reg, hora_reg, id_usuario) ";
$sql.="VALUES ('$cedula','$nombres','$apellidos','$telefono','$direccion','$correo','$fecha_act','$hora_actual','$id_usuario_cp')";

// echo $sql;
// exit();

$query = $mysqli->query($sql);

// Chequea si el usuario tiene movimientos
$sql8="SELECT movimiento "; 
$sql8.="FROM tab_usuarios WHERE (id_usuario = $id_usuario_cp)";

$query8 = $mysqli->query($sql8);
$row8=$query8->fetch_assoc();
$movimiento8=$row8['movimiento'];

if($movimiento8=='no'){

    $sql9="UPDATE tab_usuarios SET movimiento = 'si' ";
    $sql9.="WHERE (id_usuario = ".$id_usuario_cp.")"; 

    $query9 = $mysqli->query($sql9);

}

$_SESSION['cliente_guardado']="si";
echo "<script>location.href = 'buscar_clientes.php'</script>";    

?>