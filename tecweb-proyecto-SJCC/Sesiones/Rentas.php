<?php
 session_start();
 include("funciones.php");
 
 //contnectar bd
	$conn=conectarBD();
	if(isset($_REQUEST['inseR']))
	{
		if($_POST['txtfechaE']!="" && $_POST['txtfechaE']!="")//validar que tenga los demas campos
		{
			if($_POST['selusuario']!="" && $_POST['selauto']!="")
			{
				$u=$_POST['selusuario'];
				$u2="";
				$a=$_POST['selauto'];
				$a2="";
				$e2=$_POST['txtfechaE'];
				$e1=$_POST['txtfechaS'];
				$date1 = new DateTime($e1);
				$date2 = new DateTime($e2);
				$d2= $date2->format('d-m-y');
				$d1= $date1->format('d-m-y');
				$ndia= date_diff($date1,$date2);
				$numd= $ndia->format('%a');
				#echo $numd;
				for($i=0;$i<strlen($_POST['selusuario']);$i++)
				{
					if($u[$i]==',')
						break;
					else
						$u2.=$u[$i];
				}
				for($i=0;$i<strlen($_POST['selauto']);$i++)
				{
					if($a[$i]==',')
						break;
					else
						$a2.=$a[$i];
				}
	
				insertaR($a2,$u2,$d1,$d2,$_POST['selstatus']);
			}
		}
	}
	if(isset($_REQUEST['modR']))
	{
		if($_POST['selidrenta']!="")
		{
			$u=$_POST['selusuario'];
			$u2="";
			$a=$_POST['selauto'];
			$a2="";
			$e2=$_POST['txtfechaE'];
			$e1=$_POST['txtfechaS'];
			$ndia="";
			$numd="";
			$d1="";
			$d2="";
			if($_POST['txtfechaE']!="")
			{
				$date1 = new DateTime($e1);
				$d1= $date1->format('d-m-y');
			}
			if($_POST['txtfechaS']!="")
			{
				$date2 = new DateTime($e2);
				$d2= $date2->format('d-m-y');
			}
			if($_POST['txtfechaS']!="" && $_POST['txtfechaE']!="")
			{
				$ndia= date_diff($date1,$date2);
				$numd= $ndia->format('%a');
			}
			for($i=0;$i<strlen($_POST['selusuario']);$i++)
			{
				if($u[$i]==',')
					break;
				else
					$u2.=$u[$i];
			}
			for($i=0;$i<strlen($_POST['selauto']);$i++)
			{
				if($a[$i]==',')
					break;
				else
					$a2.=$a[$i];
			}
			modificaR($_POST['selidrenta'],$a2,$u2,$d1,$d2,$_POST['selstatus']);
		}
	}
	if(isset($_REQUEST['inseRG']))
	{
		if($_POST['txtfechaE']!="" && $_POST['txtfechaS']!="")
		{
			$ia=$_POST['selauto'];
			$ia2="";
			$e2=$_POST['txtfechaE'];
			$e1=$_POST['txtfechaS'];
			$date1 = new DateTime($e1);
			$date2 = new DateTime($e2);
			$d2= $date2->format('d-m-y');
			$d1= $date1->format('d-m-y');
			for($i=0;$i<strlen($_POST['selauto']);$i++)
			{
				if($ia[$i]==',')
					break;
				else
					$ia2.=$ia[$i];
			}
			insertaRG($ia2,$_SESSION['idUs'],$e1,$e2);
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="../estilos/estilosSesionG.css"/>
<link rel="stylesheet" type="text/css" href="../estilos/estilosRentas.css"/>
<title>Untitled 3</title>
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
	//consulta de tablas
	$qry="select * from rentas";
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo"<div id='seccionrentas'>";
			echo"<div id='tablaR'>";
				echo"<p>Rentas</p>";
				echo "<table id='tablas' style border=1px>";
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
					echo"<td><a href='eliminaR?idR=".$datos->idRenta."&idA=".$datos->idAuto."'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Rentas.php' method='post'>";
					echo "<a>Insertar</a><br/><br/>";
					echo "<a>Id Renta</a>";
					echo "<select name='selidrenta'><a>*Obligatorio para modificar</a>";
					$qry="select idRenta from Rentas";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{
						echo "<option>".$datos->idRenta."</option>";
					}
					echo "</select><a>*Obligatorio para modificar</a><br/><br/>";	
					echo "<a>Cliente</a>";//combo para autos
					echo "<select name='selusuario'>";
					$qry="select CONCAT(idUsuario,', ',nombreus) as dat from usuarios where tipousuario='General'";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					echo "</select><br/><br/>";	
					echo "<a>Auto</a>";//combo para cliente
					echo "<select name='selauto'>";
					$qry="select CONCAT(idAuto,', ',marca,' ',color,' ',modelo) as dat from autos where disponibilidad=0";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					while($datos = mysql_fetch_object($rs))
					{

						echo "<option>".$datos->dat."</option>";
					}
					$fe=date("d-m-y");
					echo "</select><br/><br/>";	
					echo "<a>Fecha de Salida</a><input type='text' value=".$fe." name='txtfechaS' /><br/><br/>";
					echo "<a>Fecha de Entrada</a><input type='text'  name='txtfechaE'/><br/><br/>";
					//echo "<a>Total</a><input type='text'/><br/><br/>";//fijo depende el auto
					//echo "<p>Total</p><input type='text'/>";
					echo "<a>Estado Renta</a>";//combo
					echo"<select name='selstatus'><option style=visibility:'hidden'value='' selected='selected' /><option>Aprobado</option><option>No aprobado</option><option>Pendiente</option></select><br/><br/>";
					echo "<input type='submit' value='Insertar' name='inseR'/>";
					echo "<input type='submit' value='Modificar' name='modR'/><br/><br/>";
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
			echo "<li><a href='Ventas.php'>Ventas</a></li>";
			echo "<li><a href='Rentas'>Rentas</a></li>";
			echo "<li><a href='Autos.php'>Autos</a></li>";
			echo "<li><a href='Comentarios.php'>Comentarios</a></li>";
		echo "</ul>";
	echo "</div>";

	$qry="select * from rentas where idUsuario=".$_SESSION['idUs'];
		$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
		echo"<div id='seccionrentas'>";
			echo"<div id='tablaR'>";
				echo"<p>Rentas</p>";
				echo "<table id='tablas' style border=1px>";
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
					echo"<td><a  href='eliminaR?idR=".$datos->idRenta."&idA=".$datos->idAuto."'>Eliminar</a></td>";
					echo"</tr>";
				}
				echo "</table>";
			echo "</div>";
			echo"<div id='Acc'>";
				echo"<form action='Rentas.php' method='post'>";
					$fe=date("d-m-Y");
					echo "<a>Insertar y Modificar</a><br/><br/>";
					//echo "<a>Cliente</a><input type='text'/><br/><br/>";//combo para autos
					echo "<a>Auto</a>";//combo para cliente
					echo "<select name='selauto'>";
					echo "<option style=visibility:'hidden'value='' selected='selected' />";
					$qry="select CONCAT(idAuto,', ',marca,' ',color,' ',modelo) as dat from autos where disponibilidad=0";
					$rs=mysql_query($qry,$conn)	or die("Error al recuperar datos del usuario".mysql_error());
					while($datos = mysql_fetch_object($rs))
					{
						echo "<option>".$datos->dat."</option>";
					}
					$fe=date("d-m-y");
					echo "</select><br/><br/>";	

					echo "<a>Fecha de Salida</a><input type='text' value=".$fe." name='txtfechaS' /><br/><br/>";
					echo "<a>Fecha de Entrega</a><input type='text' name='txtfechaE' /><br/><br/>";
					//echo "<a>Total</a><input type='text'/><br/><br/>";//fijo depende el auto
					//echo "<p>Total</p><input type='text'/>";
					//echo "<a>Estado Renta</a><input type='text'/><br/><br/>";//combo
					echo "<input type='submit' value='Insertar' name='inseRG'/><br/><br/>";
				echo"</form>";
			echo "</div>";
		echo "</div>";	

}
?>
</body>

</html>
