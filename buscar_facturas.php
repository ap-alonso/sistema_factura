<?php
session_start();
define("NRO_REGISTROS",10);
require_once('coneccion/conexion.php');

// Si se cerro la sesión por otro lado
$definido=isset($_SESSION['usuario']);
// No está definido la variable
if ($definido==false){

    header("Location:error1.php");

  exit();
         
}

if(isset($_GET['id_cliente'])){

	$id_cliente=$_GET['id_cliente'];

	$sql2='SELECT id_cliente, nombres, apellidos, cedula, telefono FROM tab_clientes WHERE (id_cliente = '.$id_cliente.')';
    
	$query2 = $pdo_conn -> prepare($sql2); 
	$query2 -> execute(); 
	$results = $query2 -> fetchAll(PDO::FETCH_OBJ); 

	if($query2 -> rowCount() > 0) { 
	
	  foreach($results as $result) { 
	
	    $cliente = $result -> nombres." ".$result -> apellidos;
	    $_SESSION['cliente'] = $cliente;
	    $_SESSION['cedula'] = $result -> cedula;
	    $_SESSION['id_cliente'] = $id_cliente;
	    $_SESSION['telefono'] = $result -> telefono;

      } // foreach($results as $result)

    } // if($query2 -> rowCount() > 0)
		
} // if(isset($_GET['id_cliente']))	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Venezon - Facturas - Lista</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

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
  .pagina {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }
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
      <p class="navbar-brand"><span class="menu2"><a href="buscar_clientes.php">Volver</a></span></p> 

    </div>
    
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
   <p class="usuario3">

	<span class="encab">	
	<span class="text-danger">
	Fecha Sistema: <?php echo $_SESSION['fecha']; ?>
	<br/>
	Usuario: <?php echo $_SESSION['usuario']; ?>
	</span>
	</span>
	<br/>
	<b>Cliente:</b> <?php echo $_SESSION['cliente']; ?>
	<br/>
	<b>Cédula o Rif:</b> <?php echo $_SESSION['cedula']; ?>
	<br/>
	<b>Teléfono:</b> <?php echo $_SESSION['telefono']; ?>
	<br/>
	<b>Moneda:</b> <?php echo $_SESSION['moneda_base']; ?>
	
  </p>		
  <div class="row">
    <div class="col-md-12">
      <h2>Cliente - Facturas - Lista</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
<div class="panel-body">
<?php
function verfecha($vfecha)
{
$fch=explode("-",$vfecha);
$tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
return $tfecha;
}
  
	$search_keyword = '';
	if(!empty($_POST['search']['keyword'])) {
		$search_keyword = $_POST['search']['keyword'];
	}
	$sql = 'SELECT * FROM tab_facturas WHERE (nro_factura LIKE :keyword OR fecha_reg LIKE :keyword OR total LIKE :keyword OR descuento LIKE :keyword OR total_desc LIKE :keyword) AND (id_cliente = '.$_SESSION['id_cliente'].') ORDER BY fecha_reg DESC, id_factura DESC';
	
	/* Pagination Code starts */
	$per_page_html = '';
	$page = 1;
	$start=0;
	if(!empty($_POST["page"])) {
		$page = $_POST["page"];
		$start=($page-1) * NRO_REGISTROS;
	}
	$limit=" limit " . $start . "," . NRO_REGISTROS;
	$pagination_statement = $pdo_conn->prepare($sql);
	$pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pagination_statement->execute();

	$row_count = $pagination_statement->rowCount();
	if(!empty($row_count)){
		$per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
		$page_count=ceil($row_count/NRO_REGISTROS);
		if($page_count>1) {
			for($i=1;$i<=$page_count;$i++){
				if($i==$page){
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
				} else {
					$per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
				}
			}
		}
		$per_page_html .= "</div>";
	}
	
	$query = $sql.$limit;
	$pdo_statement = $pdo_conn->prepare($query);
	$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$pdo_statement->execute();
	$resultados = $pdo_statement->fetchAll();
?>
<form name='frmSearch' action='' method='post'>
<div style='text-align:right;margin:20px 0px;'>

<!--<input type='text' name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='25'>-->

<div class="row"><div class="col-lg-6"></div>
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Busqueda..."  name='search[keyword]' value="<?php echo $search_keyword; ?>" id='keyword' maxlength='50'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>

<div class="table-responsive">

<p><span class="encab"><a href="crear_factura.php">Crear Factura</a></span></p>
<table class="table table-bordered table-hover">
  <thead>
	<tr class='th_color'>
	  
	  <th class='table-header' width='12%'>Nro. Factura</th>
	  <th class='table-header' width='10%'>Fecha</th>
	  <th class='table-header' width='16%'>Total</th>
	  <th class='table-header' width='16%'>Desc.(%)</th>
	  <th class='table-header' width='16%'>Total con desc.</th>
	  <th class='table-header' width='10%'>Anulado</th>
	  <th class='table-header' width='20%'>Enlace</th>

	</tr>
  </thead>
  <tbody id='table-body'>
	<?php
	if(!empty($resultados)) {
		foreach($resultados as $row) {

			/*
			$valores[0], año
			$valores[1], mes
			$valores[2], dia
			*/

			$valores_fecha_reg = explode('-', $row['fecha_reg']);
			$fecha_reg=$valores_fecha_reg[2]."-".$valores_fecha_reg[1]."-".$valores_fecha_reg[0];

	?>
	  <tr class='table-row'>
		
		<td><?php echo $row['nro_factura']; ?></td>
		<td><?php echo $fecha_reg; ?></td>
		<td><div class="monto"><?php echo number_format($row['total'],2,',','.'); ?></div></td>
		<td><div class="monto"><?php echo number_format($row['descuento'],2,',','.'); ?></div></td>
		<td><div class="monto"><?php echo number_format($row['total_desc'],2,',','.'); ?></div></td>
		<td><?php echo $row['anulado']; ?></td>
		<td>
			<a href="factura_reporte.php?id_factura=<?php echo $row['id_factura'] ?>&nro_factura=<?php echo $row['nro_factura'] ?>&fecha_reg=<?php echo $fecha_reg ?>&total=<?php echo $row['total'] ?>&descuento=<?php echo $row['descuento'] ?>&total_desc=<?php echo $row['total_desc'] ?>">Vista</a> 
			<?php
			
				if($row['anulado']=='no'){

					$id_factura_anular=$row['id_factura'];
					$nro_factura=$row['nro_factura'];
					$id_cliente_a=$_SESSION['id_cliente'];

					echo "<a href='#' onclick='Validar4($id_factura_anular, $nro_factura, $id_cliente_a)'>Anular</a>";
			
				}else{

					echo "";

				}

			?>
		</td>

	  </tr>
    <?php
		}
	}
	?>
  </tbody>
</table>
</div>
<?php echo $per_page_html; ?>
</form>

</div>
</div>
  </div>
</div>

<script>

// Anular factura
function Validar4(id_factura, nro_factura, id_cliente)
{

$.confirm({
title: 'Mensaje',
content: '¿Confirma en anular <br/> la factura nro. '+nro_factura+'?',
animation: 'scale',
closeAnimation: 'zoom',
buttons: {
    confirm: {
        text: 'Si',
        btnClass: 'btn-orange',

           action: function(){

           window.location.href="anular_factura_validar.php?id_factura="+id_factura+"&id_cliente="+id_cliente;           
             
           } // action: function(){

    }, // confirm: {

    cancelar: function(){
              
    } // cancelar: function()
    
  } // buttons
  
}); // $.confirm

}

</script>

<?php 

    if ( isset($_SESSION['factura_guardada']) && $_SESSION['factura_guardada'] == "si" ) {

    	unset($_SESSION['factura_guardada']);
    	unset($_SESSION['descuento']);

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

<?php 

    if ( isset($_SESSION['factura_anulada']) && $_SESSION['factura_anulada'] == "si" ) {

    	unset($_SESSION['factura_anulada']);
    	
        echo "<script>

		$.confirm({
    	title: 'Mensaje',
    	content: '<span style=color:green>Factura anulado con éxito.</span>',
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