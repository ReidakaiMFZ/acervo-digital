<?php

session_start();

$oCon = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'BANCOCOMUM');
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
		" WHERE '" . $_GET['txtLogin'] . "' IN (USRLOGIN, USREMAIL)" .
		"   AND USRSENHA = MD5('" . $_GET['txtSenha'] . "')";
$oUsuarios = mysqli_query($oCon, $cSQL);


if($vReg = mysqli_fetch_assoc($oUsuarios))
{
	
	$_SESSION['USRCODIGO'] = $vReg['USRCODIGO'];
	header('location: index.php');
}
else
	
	header('location: index4.htm');

mysqli_free_result($oUsuarios);
mysqli_close($oCon);

?>

