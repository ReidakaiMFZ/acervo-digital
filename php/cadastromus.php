<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../login.htm');
}
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/index.css">
  <title>Acervo - Inserir</title>
</head>

<body>

<header>
  <h3><a href="../php/">Inicio</a></h3>
  <h3><a href="#">Biblioteca</a></h3>
  <h3><a href="#">Cadastrar</a></h3>

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

<?php $conexao = mysqli_connect("localhost", "root", "", "acervo");?>