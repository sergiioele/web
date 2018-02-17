<?php
//variables globales
$existe=0;
$tusuario="";
$nombre="";
$conn="";

//conexion a la base de datos
	$conn =@mysql_connect("localhost","root","mysql")
	or die("no se pudo coonectar al servidor");
	mysql_select_db("agenciaautos")
	or die("no se pudo aceder a la base de datos");
//verificar si esta realizando un movimiento de inicio de sesion o registro
	if(!isset($_GET['txtusuario']) || $_GET['txtusuario']=="" && !isset($_GET['Pass']) || $_GET['Pass']=="")
	{
		echo "error";
		//regresar a la pagina anterior
		header("Location:http://localhost/proyecto/driveme.php");
	}
	else
	{
		//verificar si existe en la base de datos
		$qry="select * from Usuarios";
		$rs=mysql_query($qry,$conn)
			or die("Error al recuperar datos del usuario".mysql_error());
		//recorrer y buscar al usuario
			//modificacion de los datos del usuario
		//echo $_GET['txtusuario'];
		while($datos = mysql_fetch_object($rs))
		{
			//echo $_GET['txtusuario'];
			//echo $datos->nombreus;
			if($datos->nombreus==$_GET['txtusuario'] && $datos->contrasena==$_GET['Pass'])
			{
				$nombre=$datos->nombreus;
				//echo '<p>'.$nombre.'<p/><br/>';
				$existe=1;
				$tusuario=$datos->tipousuario;
				$idusu=$datos->idUsuario;
				//echo '<p>'.$tusuario.'<p/><br/>';				
				break;
			}
		}
		if($existe==0)
		{
			//regresar al menu principal
			header("Location:http://localhost/proyecto/driveme.php");
		}
		else
		{
			//inicio de sesion de usuario
			session_start();
			$_SESSION['usr']=$nombre;
			$_SESSION['tipou']=$tusuario;
			$_SESSION['idUs']=$idusu;
			//colocar en encabezado
			/*echo "<div id='encabezadoses'>";
				echo "<div id='logos'>";
					echo "<img src='logo-769x245.png' alt='logos'/>";
				echo "</div>";
				echo "<div id='menus'>";
					echo "<p class='fontm'> Nombre Usuario: ".$_SESSION['usr']."</p>";
					echo "<p class='fontm'> Tipo de Usuario: ".$_SESSION['tipou']."</p>";
					echo "<a class='fontm' href='.'> Cerrar Sesion</a>";
				echo "</div>";
			echo "</div>";*/
		}
	}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>

<title>Untitled 1</title></head>

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
//include("funciones.php");
$qry="select * from Autos";
$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
$dis="";
if($_SESSION['tipou']=="Administrador")
{
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
	echo "<div id='fondop'></div>";
	/*
	//div contenedor de todo
	echo "<div id='ContenedorAdm'>";
		//.............................................tabla de autos
		echo "<div id='seccionautos'>";	
			echo"<div id='tablaA'>";
				echo"<p>Autos</p>";
				echo "<table style border=1px>";
				echo ' <tr>
						<th>id Auto</th>
						<th>Marca</th>
						<th>Modelo</th>
						<th>Color</th>
						<th>Precio</th>
						<th>Disponibilidad</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idAuto."</td>";
					echo "<td>".$datos->marca."</td>";
					echo "<td>".$datos->modelo."</td>";
					echo "<td>".$datos->color."</td>";
					echo "<td>".$datos->precio."</td>";
					if($datos->disponibilidad==0)
						$dis="Disponible";
					else
						$dis="No Disponible";
					echo "<td>".$dis."</td>";
					echo"<td><a href='.'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='AccAutos'>";
				echo"<form>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>Marca</a><input type='text'/><br/><br/>";
					echo "<a>Color</a><input type='text'/><br/><br/>";
					echo "<a>Modelo</a><input type='text'/><br/><br/>";
					echo "<a>Precio</a><input type='text'/><br/><br/>";
					echo "<a>Importe P/Renta</a><input type='text'/><br/><br/>";
					echo "<a>Disponibilidad</a><input type='text'/><br/><br/>";
					echo "<input type='submit' value='Insertar'/>";
				echo"</form>";
			echo "</div>";
		echo "</div>";		
		//.........................................................................................tabla de ventas
		$qry="select * from ventas";
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo "<div id='seccionventas'>";	
			echo"<div id='tablaA'>";
				echo"<p>Autos</p>";
				echo "<table style border=1px>";
				echo ' <tr>
						<th>id Venta</th>
						<th>id Auto</th>
						<th>id Usuario</th>
						<th>Fecha de Venta</th>
						<th>Total</th>
						<th>Estado de la Venta</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idVenta."</td>";
					echo "<td>".$datos->idAuto."</td>";
					echo "<td>".$datos->idUsuario."</td>";
					echo "<td>".$datos->fechaVenta."</td>";
					echo "<td>".$datos->total."</td>";
					echo "<td>".$datos->estadoventa."</td>";
					echo"<td><a href='.'>Aprobar</a><a href='.'>Denegar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='AccVentas'>";
				echo"<form>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>Cliente</a><input type='text'/><br/><br/>";//combo para autos
					echo "<a>Auto</a><input type='text'/><br/><br/>";//combo para cliente
					echo "<a>Fecha</a><input type='text'/><br/><br/>";
					echo "<a>Total</a><input type='text'/><br/><br/>";
					echo "<a>Estado de Venta</a><input type='text'/><br/><br/>";
					echo "<input type='submit' value='Insertar'/>";
				echo"</form>";
			echo "</div>";

		echo "</div>";	
		//.........................................................................................tabla de rentas
		$qry="select * from rentas";
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo"<div id='seccionrentas'>";
			echo"<div id='tablaA'>";
				echo"<p>Autos</p>";
				echo "<table style border=1px>";
				echo ' <tr>
						<th>id Renta</th>
						<th>id Auto</th>
						<th>id Usuario</th>
						<th>Fecha de Salida</th>
						<th>Fecha de Entrega</th>
						<th>Cantidad de dias</th>
						<th>Total</th>
						<th>Estado renta</th>
						<th>Acciones</th>
						</tr>';
				while($datos = mysql_fetch_object($rs))
				{
					echo "<tr>";
					echo "<td>".$datos->idRenta."</td>";
					echo "<td>".$datos->idAuto."</td>";
					echo "<td>".$datos->idUsuario."</td>";
					echo "<td>".$datos->fechasalida."</td>";
					echo "<td>".$datos->fechaentrega."</td>";
					echo "<td>".$datos->ndias."</td>";
					echo "<td>".$datos->total."</td>";
					echo "<td>".$datos->estadorenta."</td>";
					echo"<td><a href='.'>Aprobar</a><a href='.'>Denegar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='AccRentas'>";
				echo"<form>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>Cliente</a><input type='text'/><br/><br/>";//combo para autos
					echo "<a>Auto</a><input type='text'/><br/><br/>";//combo para cliente
					echo "<a>Fecha de Salida</p><input type='text'/><br/><br/>";
					echo "<a>Fecha de Entrada</p><input type='text'/><br/><br/>";
					echo "<a>Total</a><input type='text'/><br/><br/>";//fijo depende el auto
					//echo "<p>Total</p><input type='text'/>";
					echo "<a>Estado Renta</a><input type='text'/><br/><br/>";//combo
					echo "<input type='submit' value='Insertar'/><br/><br/>";
				echo"</form>";
			echo "</div>";

		echo "</div>";	
		//.........................................................................................tabla de usuarios
		$qry="select * from usuarios";
			echo"<div id='seccionusuarios'>";
			$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		
			echo"<div id='tablaA'>";
				echo"<p>suarios</p>";
				echo "<table style border=1px>";
				echo ' <tr>
						<th>id Usuarui</th>
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
					echo "<td>".$datos->contraseña."</td>";
					echo "<td>".$datos->tipousuario."</td>";
					echo"<td><a href='funciones.php?Idu=".$datos->idUsuario."'>Eliminar</a>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='AccUsuarios'>";
				echo"<form>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>idUsuario</a><input type='text'/><br/><br/>";//combo para autos
					echo "<a>Usuario</a><input type='text'/><br/><br/>";//combo para cliente
					echo "<a>Contraseña</a><input type='text'/><br/><br/>";
					echo "<a>Tipo de Usuario</a><input type='text'/><br/><br/>";
					//echo "<p>Total</p><input type='text'/>";//fijo depende el auto
					//echo "<p>Total</p><input type='text'/>";
					//echo "<p>Estado Renta</p><input type='text'/>";//combo
					echo "<input type='submit' value='Insertar'/><br/><br/>";
				echo"</form>";
				//metodo para eliminar si es que se preciona eliminar
				echo "</div>";

		echo "</div>";
	echo "</div>";//cierrre de contenedor de todo
	*/
}
else
{
	echo "<div id='ConMenu' class='ConMenu'>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
	echo "<div id='fondop'></div>";

}
?>
</body>

</html>
