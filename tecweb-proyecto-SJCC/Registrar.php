<?php
 session_start();
 //contnectar bd
 $conn =@mysql_connect("localhost","root","mysql")
	or die("no se pudo coonectar al servidor");
	mysql_select_db("agenciaautos")
	or die("no se pudo aceder a la base de datos");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link  rel="stylesheet"  href ="estilos/animate.css" />
<link rel="stylesheet" href="estilos/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="estilos/estilosdriveme.css"/>
<link rel="stylesheet" type="text/css" href="estilos/estilosRegistrar.css"/>
<title>Untitled 1</title>
</head>

<body>
<div id="congeneral">
	<div id="slider">
		<div id="menunaveg">
			<div id="logoe"><img src="imagenes/logo-769x245.png" alt="logoem"/></div>
			<div id="menup">
			<ul id="menupagi">
				<li><a href="driveme.php">Inicio</a></li>
				<li><a href="Galeria.php">Galeria</a></li>
				<li><a href="Nosotros.php">Nosotros</a></li>
				<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://www.google.com.mx/"><i class="fa fa-google"></i></a></li>

				
			</ul>
			</div>
		</div>
		<form action="CreaUsuarioG.php" method="post" id="formreg">
			<br/><br/><br/>
			<a>Nombre usuario:  </a><br/><br/><input type="text" id="txtnameuser" name="txtnameuser"/><br/><br/><br/>
			<a>Contraseña:   </a><br/><br/><input type="password" id="txtcontra" name="txtcontra"/><br/><br/><br/>
			<input type="submit" value="Crear usuario"/><br/>
		</form>
	</div>
	<div>
</div>

</div>
<?php
	
?>

</body>

</html>
