<?php
 session_start();
 include("funciones.php");
 //contnectar bd
 $conn=conectarBD();
 	if(isset($_REQUEST['sendC']))
	{
		insertaC($_SESSION['idUs'],$_POST['txtareaC']);
		
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>
<link rel="stylesheet" type="text/css" href="../estilos/estilosComentarios.css"/>

<title>Untitled 1</title>
</head>

<body>
<div id="encSesion" class="encSesion">
	<div id="conlog" class="conlog"><img src="../imagenes/logo-769x245.png" alt="logoemp"/></div>
	<div id="continfo" class="continfo">
		<p>Usuario:<?php echo $_SESSION['usr']?></p>
		<p>Tipo Usuario:<?php echo $_SESSION['tipou'] ?></p>
		<a href="../driveme.php"> Cerrar Sesion</a>
	</div>
</div>
<?php
if($_SESSION['tipou']=="Administrador")
{
	//menuprincipa de sesion
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Usuarios.php'>Usuarios</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
	$qry="select * from comentarios";
			echo"<div id='seccioncomentarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		
			echo"<div id='tablaC'>";
				echo"<p>COMENTARIOS</p>";
				echo "<table id='tablas' style border=1px>";
				echo ' <tr>
						<th>id Comentario</th>
						<th>id Usuario</th>
						<th>Descripcion del comentario</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idComentario."</td>";
					echo "<td>".$datos->idUsuario."</td>";
					echo "<td>".$datos->comentario."</td>";
					echo"<td><a href='eliminaC.php?idC=".$datos->idComentario."'>Eliminar</a>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
}
else
{
	//menuprincipa de sesion
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
	
	$qry="select * from comentarios where idUsuario=".$_SESSION['idUs'];
			echo"<div id='seccioncomentarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		
			echo"<div id='tablaC'>";
				echo"<p>COMENTARIOS</p>";
				echo "<table id='tablas' style border=1px>";
				echo ' <tr>
						<th>id Comentario</th>
						<th>Descripcion del comentario</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idComentario."</td>";
					//echo "<td>".$datos->idUsuario."</td>";
					echo "<td>".$datos->comentario."</td>";
					echo"<td><a href='eliminaC.php?idC=".$datos->idComentario."'>Eliminar</a>";
					echo"</tr>";//checar
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='AccComentarios'>";
				echo"<form action='Comentarios.php' method='post'>";
					echo "<textarea id='txtar' name='txtareaC'></textarea><br/><br/><br/><br/>";
					echo "<input type='submit' value='Enviar comentario' name='sendC'/>";
				echo"</form>";
			echo "</div>";

	
}
?>
</body>

</html>
