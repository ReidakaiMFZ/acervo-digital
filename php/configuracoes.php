<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
    header('location:../pages/login.htm');
}

$conexao = mysqli_connect("localhost", "root", "", "ACERVO");
if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}
$query = mysqli_query($conexao, 
   "SELECT USRCODIGO, USRNOME, USRLOGIN, USREMAIL
    FROM usuarios 
    WHERE USRCODIGO = ". $_SESSION['USRCODIGO']
);
$perfil = mysqli_fetch_assoc($query);
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/configuracao.css">
    <title>Acervo - Perfil</title>
</head>

<body>
    <header>
        <h3><a href="../php/">Inicio</a></h3>
        <h3><a href="#">Biblioteca</a></h3>
        <h3><a href="cadastromus.php">Cadastrar</a></h3>

        <form class="pesquisa" action="search.php" method="get">
            <input name="txtPesquisa" class="txtPesquisa" placeholder="Pesquisar..." />
            <button type="submit" class="btnPesquisa"></button>
        </form>

        <div class="perfil">
            <img src="../images/unknown.ico">
            <h3>
                <a href="perfil.php">perfil</a>
            </h3>
        </div>
    </header>
    <div>
        <span>mudar senha:</span>
        
    </div>
</body>

</html>