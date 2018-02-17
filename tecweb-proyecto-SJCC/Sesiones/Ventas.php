<?php
 session_start();
 //contnectar bd
 include("funciones.php");
 $conn=conectarBD();
	//insertar
	if(isset($_REQUEST['inseV']))
	{
		if(isset($_POST['txtfecha']) && $_POST['txtfecha']!="")//agregar los campos de combo
		{
			//$date2= date_format($_POST['txtfecha']." 17:45:12", 'Y/m/d');
			$e=$_POST['txtfecha'];
			$date2 = new DateTime($e);
			$d= $date2->format('d-m-y');
			$iu=$_POST['selusuario'];
			$iu2="";
			$ia=$_POST['selauto'];
			$ia2="";
			for($i=0;$i<strlen($_POST['selusuario']);$i++)
			{
				if($iu[$i]==',')
					break;
				else
					$iu2.=$iu[$i];
			}
			for($i=0;$i<strlen($_POST['selauto']);$i++)
			{
				if($ia[$i]==',')
					break;
				else
					$ia2.=$ia[$i];
			}

			
			//echo $date2;
			insertaV($ia2,$iu2,$d,$_POST['selstatus']);
		}
		else
		{
			echo "error";
		}
	}
	if(isset($_REQUEST['modV']))
	{
		//vlidar que haya seleccionado combo
		if($_POST['selidventa']!="")
		{
			$e=$_POST['txtfecha'];
			$date2 = new DateTime($e);
			$d= $date2->format('d-m-y');
			$iu=$_POST['selusuario'];
			$iu2="";
			$ia=$_POST['selauto'];
			$ia2="";
			for($i=0;$i<strlen($_POST['selusuario']);$i++)
			{
				if($iu[$i]==',')
					break;
				else
					$iu2.=$iu[$i];
			}
			for($i=0;$i<strlen($_POST['selauto']);$i++)
			{
				if($ia[$i]==',')
					break;
				else
					$ia2.=$ia[$i];
			}
			#echo $iv2;
			modificaV($_POST['selidventa'],$ia2,$iu2,$d,$_POST['selstatus']);
		}			//echo $date2;
		#insertaV($cadi2[0],$cadi[0],$d,$_POST['selstatus']);
	}
	if(isset($_REQUEST['insVG']))
	{
		if($_POST['selauto']!="")
		{
			$ia=$_POST['selauto'];
			$ia2="";
			for($i=0;$i<strlen($_POST['selauto']);$i++)
			{
				if($ia[$i]==',')
					break;
				else
					$ia2.=$ia[$i];
			}
			insertaVG($ia2);
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>
<link rel="stylesheet" type="text/css" href="../estilos/estilosVentas.css"/>
<title>Untitled 2</title>
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
<a style="background-color:black;color:aqua"></a>
<?php
	
	if($_SESSION['tipou']=="Administrador")
	{
		//menuprincipa de sesion
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a id='elegido' href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Usuarios.php'>Usuarios</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";
		//.........................................................................................tabla de ventas
		$qry="select * from ventas";
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo "<div id='seccionventas'>";	
			echo"<div id='tablaV' class='tablaV'>";
				echo"<p>Ventas</p>";
				echo "<table id='tablas' style border=1px>";
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
					echo "<td>".$datos->fechaventa."</td>";
					echo "<td>".$datos->total."</td>";
					echo "<td>".$datos->estadoventa."</td>";

					echo"<td><a href='eliminaV.php?idV=".$datos->idVenta."&idA=".$datos->idAuto."'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Ventas.php' method='post'>";
					echo "<a>Insertar y Modificar</a><br/><br/>";
					echo "<a>Id Venta</a>";
					$qry="select idVenta from ventas";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<select name='selidventa'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{
						echo "<option>".$datos->idVenta."</option>";
					}
					echo "</select><br/><br/>";

					echo "<a>Cliente</a>";//combo para autos
					$qry="select CONCAT(idUsuario,', ',nombreus) as dat from usuarios where tipousuario='General'";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<select name='selusuario'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{
						echo "<option>".$datos->dat."</option>";
					}
					echo "</select><br/><br/>";
					echo "<a>Auto</a>";
					$qry="select CONCAT(idAuto,', ',marca,' ',color,' ',modelo) as dat from autos where disponibilidad=0";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del auto".mysql_error());
					echo "<select name='selauto'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					$fe=date("d-m-y");
					echo "</select><br/><br/>";	
					echo "<a>Fecha</a><input type='text' name='txtfecha' value='".$fe."'/><br/><br/>";
					//echo "<a>Total</a><input type='text'/><br/><br/>";
					echo "<a>Estado de Venta</a>";
					echo"<select name='selstatus'><option>Aprobado</option><option>No aprobado</option><option>Pendiente</option><option style=visibility:'hidden'value='' selected='selected' /></select><br/><br/>";
					echo "<input type='submit' value='Insertar' name='inseV'/>";
					echo "<input type='submit' value='Modificar' name='modV'/>";
				echo"</form>";
			echo "</div>";

		echo "</div>";		
	}
	else
	{
			//menuprincipa de sesion
	echo "<div id='ConMenu' class='ConMenu'>";
		echo"<p>MENU PRINCIPAL<p>";
		echo "<ul id='MenuSesion'>";
			echo "<li><a id='elegido' href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";

		$qry="select * from ventas where idUsuario=".$_SESSION['idUs'];
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo "<div id='seccionventas'>";	
			echo"<div id='tablaV'>";
				echo"<p>Ventas</p>";
				echo "<table id='tablas' style border=1px>";
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
					echo "<td>".$datos->fechaventa."</td>";
					echo "<td>".$datos->total."</td>";
					echo "<td>".$datos->estadoventa."</td>";
					echo"<td><a href='eliminaV.php?idV=".$datos->idVenta."&idA=".$datos->idAuto."'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Ventas.php' method='post'>";
					echo "<a>Insertar</a><br/><br/>";
					//echo "<a>Clienteeee</a>";//combo para autos
					/*echo"<select>";
					$qry="select CONCAT(idUsuario,' ',nombreus) as dat from usuarios where tiposusuario='General'";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					echo "</select><br/><br/>";	*/

					echo "<a>Auto</a>";//combo para cliente
					$qry="select CONCAT(idAuto,', ',marca,' ',color,' ',modelo) as dat from autos where disponibilidad=0";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del auto".mysql_error());
					echo "<select name='selauto'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					$fe=date("d-m-y");
					echo "</select><br/><br/>";
					//echo "<a>Fecha</a>";
					echo "<input type='hidden' name='fechaG' value=".$fe."/><br/><br/>";
					//echo "<a>Total</a><input type='text'/><br/><br/>";
					//echo "<a>Estado de Venta</a><input type='text'/><br/><br/>";
					echo "<input type='submit' value='Insertar' name='insVG'/>";
				echo"</form>";
			echo "</div>";

		echo "</div>";	
	}
?>
<script type="text/javascript"
</body>

</html>
