<?php
include '../php/config.php';
if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}

if($_GET['nome'] !="" && $_GET['Senha'] !="" && $_GET['email'] !="" && $_GET['login'] !=""){
    $oConsulta = "INSERT INTO USUARIOS(USRNOME, USRSENHA, USREMAIL, USRLOGIN) VALUES ('".$_GET['nome']. "', MD5('".$_GET['Senha']."'),'" .$_GET['email']."','". $_GET['login'] . "')";
    $oQuery = mysqli_query($conexao, $oConsulta);
        
    mysqli_Close($conexao);
    header('location: ../pages/login.htm');
}
else{
    header('location: ../pages/registro.html');
}
?>