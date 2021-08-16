<?php
if($_GET['nome'] !="" && $_GET['Senha'] !="" && $_GET['email'] !="" && $_GET['sobrenome'] !="")
{
    $oConexao = mysqli_connect('localhost', 'Aluno2DS', 'SenhaBD2', 'BANCOCOMUM');
    $oConsulta = "INSERT INTO USUARIOS(USRNOME, USRSENHA, USREMAIL, USRSOBRENOME) VALUES ('".$_GET['nome']."', MD5('".$_GET['Senha']."'),'" .$_GET['email']."','". $_GET['sobrenome'] . "' )";

    $oQuery = mysqli_query($oConexao, $oConsulta);
        
    mysqli_Close($oConexao);
    header('location: ../index.html');
}
else 
{
    header('location: ../registro.html');
}
?>