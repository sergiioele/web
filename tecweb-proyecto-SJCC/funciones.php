<?php
//session_start();
function conectarBD()
{
	$conn =@mysql_connect("localhost","root","mysql")
	or die("no se pudo coonectar al servidor");
	mysql_select_db("agenciaautos")
	or die("no se pudo aceder a la base de datos");
	return $conn;
}
//seccion de autos
function insertaA($Mar,$Mod,$Col,$Pres,$Impo,$img)
{
	$im=0;
	$qry ="insert into autos(marca,modelo,color,precio,imagen,importe,disponibilidad) values('".$Mar."',".$Mod.",'".$Col."',".$Pres.",'".$img."',".$Impo.",".$im.")";
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());

}
function actualizaA($Mar,$Mod,$Col,$Pres,$Impo,$ida)
{
	$qry="select * from autos where idAuto=".$ida;
	$rs=mysql_query($qry)	or die("Error al recuperar datos del usuario".mysql_error());
	$datos = mysql_fetch_object($rs);
	if($Mar=="")
		$Mar=$datos->marca;
	if($Mod=="")
		$Mod=$datos->modelo;
	if($Col=="")
		$Col=$datos->color;
	if($Pres=="")
		$Pres=$datos->precio;
	if($Impo=="") 
		$Impo=$datos->importe;
	$qry="update autos set marca='".$Mar."',modelo=".$Mod.",color='".$Col."',precio=".$Pres.",importe=".$Impo." where idAuto=".$ida."";
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());
}
//seccion de ventas

function insertaV($idA,$idC,$fec,$est)
{
	$qry="select precio from autos where idAuto=".$idA;
	$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
	$datos = mysql_fetch_object($rs);
	$tot=$datos->precio;
	$qry="insert into ventas(idAuto,idUsuario,fechaventa,total,estadoventa) values(".$idA.",".$idC.",'".$fec."',".$tot.",'".$est."')";
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());
	$mm=1;
	$qry="update autos set disponibilidad=".$mm." where idAuto=".$idA;
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());

}
function modificaV($idV,$idA,$idC,$fec,$est)
{
	//pendiente
	$qry="select * from ventas where idVenta=".$idV;
	$rs=mysql_query($qry) or die("Error al recuperar datos de la venta".mysql_error());
	$datos = mysql_fetch_object($rs);
	#echo strlen($idV);
	if($idA=="")
		$idA=$datos->idAuto;
		echo "nada";
	echo $datos->idUsuario;
	if($idC=="")
		$idC=$datos->idUsuario;
	if($fec=="")
		$fec=$datos->fechaventa;
	if($est=="")
		$est=$datos->estadoventa;
	echo $idC;
	if($idA!=$datos->idAuto)
	{
		$dis=0;
		//actualizar auto
		$qry="update autos set  disponibilidad=".$dis." where idAuto=".$idA;
		mysql_query($qry) or die("No actualizo el auto");
	}
	$qry="select precio from autos where idAuto=".$idA;
	$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
	$datos = mysql_fetch_object($rs);
	$tot=$datos->precio;
	$qry="update ventas set idAuto=".$idA.",idUsuario=".$idC.",fechaventa='".$fec."',total=".$tot.",estadoventa='".$est."' where idVenta=".$idV;
	mysql_query($qry) or die("No se pudo actualizar la venta".mysql_error());
	$dis=1;
	$qry="update autos set disponibilidad=".$dis." where idAuto=".$idA;
	mysql_query($qry) or die("No se pudo actualizar la venta".mysql_error());
	

}
function insertaVG($idA)
{
	
	$qry="select precio from autos where idAuto=".$idA;
	$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
	$datos = mysql_fetch_object($rs);
	$tot=$datos->precio;
	$fe=date("d-m-y");
	$date2 = new DateTime($fe);
	$d= $date2->format('d-m-y');

	
	$qry="insert into ventas(idAuto,idUsuario,fechaventa,total,estadoventa) values(".$idA.",".$_SESSION['idUs'].",'".$fe."',".$tot.",'Pendiente')";
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());
		$mm=1;
	$qry="update autos set disponibilidad=".$mm." where idAuto=".$idA;
	mysql_query($qry) or die("Error al insertar Auto".mysql_error());

	
}
//rentas
function insertaR($idA,$idC,$fs,$fe,$esta)
{
		$date1 = new DateTime($fs);
		$date2 = new DateTime($fe);
		$d2= $date2->format('d-m-y');
		$d1= $date1->format('d-m-y');
		#echo $d1;
		$ndia= date_diff($date1,$date2);
		$numd= $ndia->format('%a');
		#echo $numd;
		#echo $fs;
		#echo $fe;
		#echo $d1;
		#echo $d2;
		$d2= $date2->format('d-m-y');
		$d1= $date1->format('d-m-y');
		echo $idA;
		//colsultar precio del auto
		$qry="select importe from autos where idAuto=".$idA;
		$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
		echo "realizado";
		$datos = mysql_fetch_object($rs);
		$total=$datos->importe*$numd;
		$qry="insert into rentas(idAuto,idUsuario,fechasalida,fechaentrega,ndias,total,estadorenta) values(".$idA.",".$idC.",'".$fs."','".$fe."',".$numd.",".$total.",'".$esta."')";
		mysql_query($qry) or die("Error al insertar Renta".mysql_error());
		//actualizar auto
		$mm=1;
		$qry="update autos set disponibilidad=".$mm." where idAuto=".$idA;
		mysql_query($qry) or die("Error al insertar Renta".mysql_error());


}
function modificaR($idR,$idA,$idC,$fs,$fe,$esta)
{
	$qry="select * from rentas where idRenta=".$idR;
	$rs=mysql_query($qry) or die("No se pudo consultar la informacion de renta");
	$datos=mysql_fetch_object($rs);
	if($idA=="")
		$idA=$datos->idAuto;
	if($idC=="")
		$idC=$datos->idUsuario;
	if($fs=="")
		$fs=$datos->fechasalida;
	if($fe=="")
		$fe=$datos->fechaentrega;
	if($esta=="")
		$esta=$datos->estadorenta;
	$date1 = new DateTime($fs);
	$date2 = new DateTime($fe);
	$d2= $date2->format('d-m-y');
	$d1= $date1->format('d-m-y');
	$ndia= date_diff($date1,$date2);
	$numd= $ndia->format('%a');
	$d2= $date2->format('d-m-y');
	$d1= $date1->format('d-m-y');
	$mm=0;
	$qry="update autos set disponibilidad=".$mm." where idAuto=".$idA;
	mysql_query($qry) or die("no se pudo actualizar datos del auto");
	//colsultar precio del auto
	$qry="select importe from autos where idAuto=".$idA;
	$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
	echo "realizado";
	$datos = mysql_fetch_object($rs);
	$total=$datos->importe*$numd;
	$qry="update rentas set idAuto=".$idA.",idUsuario=".$idC.",fechasalida='".$fs."',fechaentrega='".$fe."',ndias=".$numd.", total=".$total.",estadorenta='".$esta."' where idRenta=".$idR;
	#$qry="insert into rentas(idAuto,idUsuario,fechasalida,fechaentrega,ndias,total,estadorenta) values(".$idA.",".$idC.",'".$fs."','".$fe."',".$numd.",".$total.",'".$esta."')";
	mysql_query($qry) or die("no se pudo actualizar la renta");
}
function insertaRG($idA,$idC,$fs,$fe)
{
		$date1 = new DateTime($fs);
		$date2 = new DateTime($fe);
		$d2= $date2->format('d-m-y');
		$d1= $date1->format('d-m-y');
		#echo $d1;
		$ndia= date_diff($date1,$date2);
		$numd= $ndia->format('%a');
		#echo $numd;
		//colsultar precio del auto
		$qry="select importe from autos where idAuto=".$idA;
		$rs=mysql_query($qry) or die("Error al recuperar datos del auto".mysql_error());
		$datos = mysql_fetch_object($rs);
		$total=$datos->importe*$numd;
		$edo="Pendiente";
		$qry="insert into rentas(idAuto,idUsuario,fechasalida,fechaentrega,ndias,total,estadorenta) values(".$idA.",".$idC.",'".$d1."','".$d2."',".$numd.",".$total.",'".$edo."')";
		mysql_query($qry) or die("Error al insertar Renta".mysql_error());
		//actualizar auto
		$mm=1;
		$qry="update autos set disponibilidad=".$mm." where idAuto=".$idA;
		mysql_query($qry) or die("Error al insertar Renta".mysql_error());

}
//usuarios
function insertaU($nom,$con,$tipo)
{
	//verificar que no exista el mismo nombre
	$qry="select idUsuario from usuarios where nombreus = '".$nom."'";
	$rs=mysql_query($qry) or die("Error al comprobar usuario".mysql_error());
	if(mysql_num_rows($rs)==0)//no existe ese usuario
	{
		$qry="insert into usuarios(nombreus,contraseña,tipousuario) values('".$nom."','".$con."','".$tipo."')";
		mysql_query($qry) or die("No se pudo insertar el usuario".mysql_error());
	}
	else
	{
		?>		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<title>Untitled 1</title>
		<script type="text/javascript">
		alert("no se puede insertar el usuario ya existe");
		</script>
		</head>		
		</html>
		<?php

	}

}
function modificaU($idUsu,$nom,$con,$tipo)
{
	$qry="select * from usuarios where idUsuario=".$idUsu;
	$rs=mysql_query($qry) or die("No sse pudo consultar los datos");
	$datos = mysql_fetch_object($rs);
	echo "este es la contra".$con;
	if($nom=="")
	echo	$nom=$datos->nombreus;
	if($con=="")
	echo	$con=$datos->contraseña;
	if($tipo=="")
	echo	$tipo=$datos->tipousuario;
	$qry="update usuarios set nombreus='".$nom."', contraseña='".$con."', tipousuario='".$tipo."' where idUsuario=".$idUsu;
	mysql_query($qry) or die("No se pudo actualizar el usuario el usuario".mysql_error());
		
}
//comentarios
function insertaC($idC,$desc)
{
	$qry="insert into comentarios(idUsuario,comentario) values(".$idC.",'".$desc."')";
	mysql_query($qry) or die("No se pudo mandar comentario");
}
?>
