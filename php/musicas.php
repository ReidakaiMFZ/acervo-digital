<?php
session_start();

ini_set('display_errors', "On");
error_reporting(E_ALL);

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}
$conexao = mysqli_connect("localhost", "root", "", "acervo");

$queryPop = "SELECT MSCCODIGO, MSCNOME, MSCDURACAO, MSCVIDEO, MSCAUDIO, MSCLETRA, BDSCODIGO, BDSNOME, ARTCODIGO, ARTNOME, ALBCAPA 
              FROM MUSICAS
              LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA 
              LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA 
              LEFT JOIN FAIXAS ON FAIXAS.FXSMUSICA = MUSICAS.MSCCODIGO 
              LEFT JOIN ALBUNS ON ALBUNS.ALBCODIGO = FAIXAS.FXSALBUM  
              WHERE MSCCODIGO = ". $_GET['musicaid'];

$consultaPop = mysqli_query($conexao, $queryPop);
if(!$regPop = mysqli_fetch_assoc($consultaPop)){
  echo "<h1>Error 404</h1>";
  echo "<label>Not Found</label>";
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/musicas.css">
  <title>Acervo - Musica</title>
</head>

<body>
  <header>
    <h3><a href="../php/">Inicio</a></h3>
    <h3><a href="#">Biblioteca</a></h3>
    <h3><a href="../php/cadastromus.php">Cadastrar</a></h3>

    <form class="pesquisa" action="../php/search.php" method="get">
      <input name="txtPesquisa" class="txtPesquisa" placeholder="Pesquisar..." />
      <button type="submit" class="btnPesquisa"></button>
    </form>

    <div class="perfil">
      <img src="../images/unknown.ico">
      <h3>
        <a href="../php/perfil.php">perfil</a>
      </h3>
    </div>
  </header>

  <main>
    <?php 
    if($regPop['ALBCAPA'] != null){
      echo   "<img src='../images/". $regPop['ALBCAPA'] ."' alt='musica' />";
    }
    else{
      echo   "<img src='../images/placeholder-de-imagens.png' alt='musica' />";
    }
    echo "<h3 id='musicaNome'>". $regPop['MSCNOME'] ."</h3>";
    ?>
    <div>
      <p id="minimo">00:00</p>
      <?php
      echo "<p id='maximo'>". $regPop['MSCDURACAO'] ."</p>";
      ?>
      <progress id="musicaProgresso" value="0" max="0"></progress>
      <button id="btnTocar" onclick="iniciar()">play</button>
    </div>
      <button id="btnLetras" onclick="mostraLetras()">letras</button>
    </main>
    <div id="txtLetras" style="display: none;">
      <?php
      echo "<p>". $regPop['MSCLETRA'] ."</p>";
      ?>
    </div>
</body>
<script src="../js/teste.js"></script>

</html>
