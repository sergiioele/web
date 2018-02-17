<?php
 session_start();
 include("funciones.php");
 //contnectar bd
 $conn =conectarBD();
 	if(isset($_REQUEST['inseU']))
	{
		if($_POST['txtusuario']!="" && $_POST['txtcontraseña']!="")
		{
			insertaU($_POST['txtusuario'],$_POST['txtcontraseña'],$_POST['seltipo']);
		}
	}
	if(isset($_REQUEST['modU']))
	{
		//pendiente
		if($_POST['selusuario']!="")
		{
			$us=$_POST['selusuario'];
			$us2="";	
			for($i=0;$i<strlen($_POST['selusuario']);$i++)
			{
				if($us[$i]==',')
					break;
				else
					$us2.=$us[$i];
			}

			$id=$_POST['selusuario'];
			modificaU($us2,$_POST['txtusuario'],$_POST['txtcontraseña'],$_POST['seltipo']);
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>
<link rel="stylesheet" type="text/css" href="../estilos/estilosUsuarios.css"/>

<title>Untitled 4</title>
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
	
	$qry="select * from usuarios";
			echo"<div id='seccionusuarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		
			echo"<div id='tablaU'>";
				echo"<p>Usuarios</p>";
				echo "<table id='tablas' style border=1px>";
				echo ' <tr>
						<th>id Usuario</th>
						<th>Usuario</th>
						<th>Contraseña</th>
						<th>Tipo de usuario</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idUsuario."</td>";
					echo "<td>".$datos->nombreus."</td>";
					echo "<td>".$datos->contrasena."</td>";
					echo "<td>".$datos->tipousuario."</td>";
					echo"<td><a href='eliminaU.php?idU=".$datos->idUsuario."'>Eliminar</a>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Usuarios.php' method='post'>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>idUsuario</a>";//combo para autos
					$qry="select CONCAT(idUsuario,', ',nombreus) as dat from usuarios";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<select name='selusuario'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{
						echo "<option>".$datos->dat."</option>";
					}
					echo "</select><a>* Obligatorio para modificacion</a><br/><br/>";

					echo "<a>Usuario</a><input type='text' name='txtusuario'/><br/><br/>";//combo para cliente
					echo "<a>Contraseña</a><input type='text' name='txtcontraseña'/><br/><br/>";
					echo "<a>Tipo de Usuario</a>";
					echo"<select name='seltipo'><option>Administrador</option><option>General</option><option style=visibility:'hidden'value='' selected='selected' /></select><br/><br/>";
					//echo "<p>Total</p><input type='text'/>";//fijo depende el auto
					//echo "<p>Total</p><input type='text'/>";
					//echo "<p>Estado Renta</p><input type='text'/>";//combo
					echo "<input type='submit' value='Insertar' name='inseU'/>";
					echo "<input type='submit' value='Modificar' name='modU'/>";
				echo"</form>";
				//metodo para eliminar si es que se preciona eliminar
				echo "</div>";

		echo "</div>";

?>
</body>

</html>
