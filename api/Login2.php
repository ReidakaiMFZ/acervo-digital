<?php
session_start();
include '../php/config.php';
if (mysqli_connect_errno()){
	header('location: ../pages/login.htm?falha=2');
}

$cSQL = "SELECT USRCODIGO, USRNOME, USRLOGIN" .
        "  FROM USUARIOS" .
		" WHERE '" . $_GET['txtLogin'] . "' IN (USRLOGIN, USREMAIL)" .
		"   AND USRSENHA = MD5('" . $_GET['txtSenha'] . "')";
$oUsuarios = mysqli_query($conexao, $cSQL);

if($vReg = mysqli_fetch_assoc($oUsuarios))
{
	$_SESSION['USRCODIGO'] = $vReg['USRCODIGO'];
	header('location: ../php/index.php');
}
else
{
	header('location: ../pages/login.htm?falha=1');
	session_destroy(); 
}		
mysqli_free_result($oUsuarios);
mysqli_close($conexao);

?>