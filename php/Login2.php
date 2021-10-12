<?php
session_start();
$oCon = mysqli_connect('localhost', 'root', '', 'acervo');
$cSQL = "SELECT USRCODIGO, USRNOME, USRLOGIN" .
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
{
	header('location: ../login.htm?falha=1');
	session_destroy(); 
}		
mysqli_free_result($oUsuarios);
mysqli_close($oCon);

?>