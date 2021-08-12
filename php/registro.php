<?php

$oConexao = mysqli_connect("localhost","root", "test");
$oConsulta = "INSERT INTO USUARIOS(USRNOME, USRSENHA, USREMAIL) VALUES ('".$_GET['nome']."', '".$_GET['senha']."','" .$_GET['email']."')";

$oQuery = mysqli_query($oConexao, $oConsulta);

mysqli_free_result($oQuery);
mysqli_Close($oConexao);
header('location: registro.html');

?>