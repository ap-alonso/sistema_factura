<?php

require("coneccion/connection.php");
session_start();

if(!isset($_SESSION['usuario_2'])) {

	$_SESSION['usuario_2']="";
	$_SESSION['clave_2']="";

}	

$sql = "SELECT current_date";
$row = $mysqli->query($sql);
$consultaf = $row->fetch_assoc();

$fechadelmysql = date_create($consultaf['current_date']);
$fechadelmysql = date_format($fechadelmysql, 'd-m-Y');
$fecha_pc = $fechadelmysql;

$valores_fecha_act = explode('-', $fecha_pc);
$fecha_act=$valores_fecha_act[2]."-".$valores_fecha_act[1]."-".$valores_fecha_act[0];

$fecha_act_g=$valores_fecha_act[2]."/".$valores_fecha_act[1]."/".$valores_fecha_act[0];

// Fecha invertida
$valores_fecha_act_i= explode('-', $fecha_act);
$fecha_act_i=$valores_fecha_act_i[2]."-".$valores_fecha_act_i[1]."-".$valores_fecha_act_i[0];

/*

$valores_fecha_act[0], año
$valores_fecha_act[1], mes
$valores_fecha_act[2], dia

*/

$sql="SELECT * FROM tab_fecha_pc";
$query = $mysqli->query($sql);
$row=$query->fetch_assoc();

$fecha_pc_last=$row["fecha_pc"];

$valores_fecha_pc_last = explode('-', $fecha_pc_last);
$fecha_pc_last=$valores_fecha_pc_last[2]."-".$valores_fecha_pc_last[1]."-".$valores_fecha_pc_last[0];

$primera = $fecha_act_i;
$segunda = $fecha_pc_last;

$diferencia_dias=compararFechas ($primera,$segunda);

if($diferencia_dias<0){

    echo "<p style='font-family: Arial; font-size: 11pt; color: red'>Fecha del PC incorrecta</p>";
    exit();

}else{

    // Guarda datos en tab_fecha_pc
    // $sql3="UPDATE tab_fecha_pc SET fecha_pc='$fecha_act_g'";
    // $query3=$mysqli->query($sql3);   

}

function compararFechas($primera, $segunda)
 {
  $valoresPrimera = explode ("-", $primera);   
  $valoresSegunda = explode ("-", $segunda); 

  $diaPrimera    = $valoresPrimera[0];  
  $mesPrimera  = $valoresPrimera[1];  
  $anyoPrimera   = $valoresPrimera[2]; 

  $diaSegunda   = $valoresSegunda[0];  
  $mesSegunda = $valoresSegunda[1];  
  $anyoSegunda  = $valoresSegunda[2];

  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
    // "La fecha ".$primera." no es v&aacute;lida";
    return 0;
  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
    // "La fecha ".$segunda." no es v&aacute;lida";
    return 0;
  }else{
    return  $diasPrimeraJuliano - $diasSegundaJuliano;
  } 

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<link rel="stylesheet" href="demo/libs/bundled.css">
	<script src="demo/libs/bundled.js"></script>
	<script src="js/jquery-latest.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css"/>
	<script type="text/javascript" src="js/jquery-confirm.js"></script>

	<link rel="stylesheet" href="css/estilos4.css">
	<title>Venezon - Inicio</title>
	<link rel="shortcut icon" href="imagen/avatar.png" />
	
</head>
<body>

	<div class="contenedor-formulario">

		<div class="wrap">

			<header>

				<h1><p class="titulo1">Venezon</h1>
				<br/>
				<p class="titulo2">Iniciar Sesión</p>
				<br/>

			</header>

			<form action="" class="formulario" name="formulario_registro" onsubmit="return false" method="POST">
				
				<div>
					<div class="input-group">
						<label class="label1" for="nombre">Usuario:</label>
						<input type="text" id="user" name="user" autofocus value=<?php echo $_SESSION['usuario_2']; ?>>
					</div>
					<div class="input-group">
						<label class="label2" for="pass">Contraseña:</label>
						<input type="password" id="pass" name="pass" value=<?php echo $_SESSION['clave_2']; ?>>
					</div>
          <input onclick="Validar(document.getElementById('user').value, document.getElementById('pass').value);" type="submit" id="btn-submit" value="Enviar">
					
					<script>
					
    				function Validar(user, pass)
    				{
    					if(user==""){
    						$.alert({
                        		title: 'Mensaje',
                        		content: '<span style=color:red>Debes escribir el Usuario.</span>',
                        		animation: 'scale',
                        		closeAnimation: 'scale',
                        		buttons: {
                            		okay: {
                                		text: 'Cerrar',
                                		btnClass: 'btn-warning'
                            		}
                        		}
                    		});
    						return 0;
    					} 
    					if(pass==""){
    						$.alert({
                        		title: 'Mensaje',
                        		content: '<span style=color:red>Debes escribir la Clave.</span>',
                        		animation: 'scale',
                        		closeAnimation: 'scale',
                        		buttons: {
                            		okay: {
                                		text: 'Cerrar',
                                		btnClass: 'btn-warning'
                            		}
                        		}
                    		});
                return 0;
    					} 

   						$.ajax({

       						url: "validarusuario.php",

        						type: "POST",
        						data: "user="+user+"&pass="+pass,
        						beforeSend: function () {
           						$("#mensaje1").html("<img src='imagen/loader-small.gif'/><font color='white'>&nbsp&nbspProcesando, por favor espere...</font>");
        						},
        						success: function(resp){
           						$('#mensaje1').html(resp)
        						}        

        					});
        				
    				}

    		</script>

				</div>
				<div id="mensaje1" class="mensaje1"></div>
			</form>

			<?php 

			if ( isset($_SESSION['usuario_valido']) && $_SESSION['usuario_valido'] == "no" ) {

				unset($_SESSION['usuario_valido']);
    			echo "<script>
    			
    				 $.alert({

                        title: 'Mensaje',
                        content: '<span style=color:red>El usuario o la clave son incorrectas.</span>',
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
			
			<div class="mini" style="font-size:18px">

			<?php 
  				// mini Sistemas cjcv
  				require("mini.php"); 
			?>
			</div>

		</div>
	</div>
	
</body>
</html>