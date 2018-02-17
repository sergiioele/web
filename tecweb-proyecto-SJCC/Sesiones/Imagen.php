<?php
include "funciones.php";

$con = conectarBD();

$qry = "Select imagen from autos where idAuto =" . $_GET['idI'];
$rs = mysql_query($qry, $con);
$file = mysql_fetch_object($rs);
//header("Content-type:" . "image/jpg");
echo $file->imagen;
//mysql_close($con);
?>
