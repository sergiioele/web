<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="estilos/font-awesome/css/font-awesome.min.css"/>
<link rel="stylesheet" href="font-awesome\css\font-awesome.min.css"/>
<link  rel="stylesheet"  href ="estilos/animate.css" />
<link  rel="stylesheet"  href="estilos/estilosGaleria.css" />

<link rel="stylesheet" type="text/css" href="estilos/estilosdriveme.css"/>

<title>Untitled 1</title>
</head>

<body>

<div id="congeneral3">
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
			<div id="galeria">
				<?php
					include "funciones.php";
					$conn=conectarBD();
					$qry="select * from Autos";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos de la galeria".mysql_error());
					echo "<table id='galery'>";
						echo ' <tr>
						<th>Descripcion</th>
						<th>Imagen</th>
						</tr>';	
						while($datos = mysql_fetch_object($rs))
						{	echo "<tr>";
								echo "<td><p> Marca: ".$datos->marca."<br/> Color: " .$datos->color. "<br/> Precio: $" .$datos->precio. "<p></td>";
								echo "<td><img  src='Imagen.php?idI=" . $datos->idAuto. "' alt='" . $datos->marca . "' class='imagenFicha' /></td>";
							echo "</tr>";
						}
					echo "</table>";
				?>
			</div>
		</div>
	<div>
</div>

</div>
</body>

</html>
