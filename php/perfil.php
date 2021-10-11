<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../login.htm');
}

$conexao = mysqli_connect("localhost", "root", "", "acervo");
$query = mysqli_query($conexao, "SELECT USRCODIGO, USRNOME, USRLOGIN, USREMAIL
    FROM usuarios WHERE USRCODIGO = ". $_SESSION['USRCODIGO']);
$perfil = mysqli_fetch_assoc($query);
?>

<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo - Perfil</title>
</head>

<body>
    
</body>
</html>