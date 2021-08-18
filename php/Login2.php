<?php
session_start();

$oCon = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'BANCOCOMUM');
$cSQL = "SELECT USRCODIGO, USRNOME" .
        "  FROM USUARIOS" .
		" WHERE '" . $_GET['txtLogin'] . "' IN (USRLOGIN, USREMAIL)" .
		"   AND USRSENHA = MD5('" . $_GET['txtSenha'] . "')";
$oUsuarios = mysqli_query($oCon, $cSQL);

		
?>