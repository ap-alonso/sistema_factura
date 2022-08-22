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

// Totaliza los renglones de la factura segun la cantidad del producto
$sql3="SELECT id_producto, producto, descripcion, precio_compra, precio_final, ganancia, cantidad_existencia FROM tab_productos ";

$sql3.="GROUP BY id_producto";

$query3 = $mysqli->query($sql3);

if($query3->num_rows==0){

  echo "<p style='font-family: Arial; font-size: 11pt; color: red'>No hay productos</p>"; 
  exit();

}

// Lista los totales de las cantidades del producto
$i=0;
while ($row3=$query3->fetch_assoc()) {

  $i=$i+1;
  $id_producto_4=$row3['id_producto'];

  if ($i==1){
      
    $productos_a = array(

      $i => array(
        
        'nombre_p' => $row3['producto'],
        'descripcion_p' => $row3['descripcion'],
        'precio_compra_p' => $row3['precio_compra'],
        'precio_final_p' => $row3['precio_final'],
        'ganancia_p' => $row3['ganancia'],
        'cantidad_existencia_p' => $row3['cantidad_existencia'],

      ),
  
    );

  }

  if ($i>1){

    array_push($productos_a, 

      array(

        'nombre_p' => $row3['producto'],
        'descripcion_p' => $row3['descripcion'],
        'precio_compra_p' => $row3['precio_compra'],
        'precio_final_p' => $row3['precio_final'],
        'ganancia_p' => $row3['ganancia'],
        'cantidad_existencia_p' => $row3['cantidad_existencia'],
       
      )

    );

  }

}

function array_sort($array, $on, $order=SORT_ASC)
{

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<title>Venezon - Reporte - Productos</title>

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
  
  .productodato{

    font-size:16px; 
    text-align:right;
    
  }
  .monto{

  text-align:right;   

  }
  .cantidad{

    width:65px;
    text-align:center;

  }
  
  @media screen and (max-width:400px ) {

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
    <h3>Reporte - Productos</h3>
    <b>Moneda:</b> <?php echo $_SESSION['moneda_base']; ?>
    </p>

  </div>

</div>  

<div class="table-responsive">

<div class="table-responsive">

<table class="table table-bordered">
  
 <thead>
  <tr>
    
    <th class='table-header' width='5%' style="vertical-align:middle">Nro.</th>
    <th class='table-header' width='30%' style="vertical-align:middle">Producto</th>
    <th class='table-header' width='35%' style="vertical-align:middle">Descripción</th>
    <th class='table-header' width='10%'>Precio Compra</th>
    <th class='table-header' width='10%'>Precio Final</th>
    <th class='table-header' width='10%' style="vertical-align:middle">Ganacia</th>
    <th class='table-header' width='10%' style="vertical-align:middle">Existencia</th>
            
  </tr>
  </thead>

   <tbody id='table-body'>

    <?php

      $new_array_2 = array();
      $new_array_2 = array_sort($productos_a, 'nombre_p', SORT_ASC);

      $total_ganacia=0;
      $nro_pp=0;
      $pp3=0;
      $pp4=0;
      $pp5=0;
      $pp6=0;
      foreach($new_array_2 as $id=>$a){

        $p="";
        foreach($a as $b=>$c){
   
          $p.="|||".$c;
   
        }

        $nro_pp=$nro_pp+1;
        
        $pp = explode("|||", $p);

        // Total precio compra
        $pp3=$pp3+$pp[3];
        // Total precio final
        $pp4=$pp4+$pp[4];
        // Total ganancia
        $pp5=$pp5+$pp[5];
        // Total cantidad
        $pp6=$pp6+$pp[6];
          
    ?>

    <tr class='table-row'>
      
      <td><?php echo $nro_pp;; ?></td>
      <td><?php echo utf8_decode($pp[1]); ?></td>
      <td><?php echo utf8_decode($pp[2]); ?></td>
      <td><div class="monto"><?php echo number_format($pp[3],2,',','.') ?></div></td>
      <td><div class="monto"><?php echo number_format($pp[4],2,',','.') ?></div></td>
      <td><div class="monto"><?php echo number_format($pp[5],2,',','.') ?></div></td>
      <td><div class="cantidad"><?php echo $pp[6] ?></div></td>
      
    </tr>

    <?php

      }

    ?>

   </tbody>

</table>

  <div class="productodato">
   <?php

      // echo "<b>Total Ganancia: </b>".number_format($total_ganacia,2,',','.');

    ?>
  </div>  

</div>  

</div>

<br/>

<div class="form-horizontal">

  <div class="form-group">

    <div class="usuario3">
    <a id="menu" href="panel.php">Menu</a>
    <a id="volver" href="reportes.php">Volver</a>
    <a href="#" id="Imprimir" onclick="printe()">Imprimir</a> 
    </div>

  </div> <!-- class="form-group" -->  

</div>

</div> <!-- class="container" -->		
</body>
</html>