<?php
if($_GET['nome'] !="" && $_GET['Senha'] !="" && $_GET['email'] !="" && $_GET['login'] !="")
{
    $oConexao = mysqli_connect('localhost', 'root', '', 'acervo');
    $oConsulta = "INSERT INTO USUARIOS(USRNOME, USRSENHA, USREMAIL, USRLOGIN) VALUES ('".$_GET['nome']. "', MD5('".$_GET['Senha']."'),'" .$_GET['email']."','". $_GET['login'] . "')";

    $oQuery = mysqli_query($oConexao, $oConsulta);
        
    mysqli_Close($oConexao);
    header('location: ../login/login.htm');
}
else 
{
    header('location: ../registro.html');
}
?>