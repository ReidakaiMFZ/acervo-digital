<?php
if($_GET['nome'] !="" && $_GET['Senha'] !="" && $_GET['email'] !="" && $_GET['login'] !="")
{
    $oConexao = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'BANCOCOMUM');
    $oConsulta = "INSERT INTO USUARIOS(USRNOME, USRSENHA, USREMAIL, USRLOGIN) VALUES ('".$_GET['nome']. "', MD5('".$_GET['Senha']."'),'" .$_GET['email']."','". $_GET['login'] . "')";

    $oQuery = mysqli_query($oConexao, $oConsulta);
        
    mysqli_Close($oConexao);
    header('location: ../login.htm');
}
else 
{
    header('location: ../registro.html');
}
?>