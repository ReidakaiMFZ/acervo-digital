<?php
include 'config.php';
session_start();

if(isset($_SESSION['USRCODIGO']) == false){
  header('location:../pages/login.htm');
}

if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}

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
$queryAvaliar = "SELECT CLSNOTA FROM CLASSIFICACAO WHERE CLSUSUARIO = ". $_SESSION['USRCODIGO'] ." AND CLSMUSICA = ". $_GET['musicaid'];
$consultaAvaliar = mysqli_query($conexao, $queryAvaliar);
$regAvaliar = mysqli_fetch_assoc($consultaAvaliar);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/musicas.css">
    <link rel="icon" type="image/x-icon" href="../images/logo-etec.png">
    <title>Acervo - Musica</title>
</head>

<body>
    <header>
        <h3><a href="../php/">Inicio</a></h3>
        <h3><a href="biblioteca.php">Biblioteca</a></h3>
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
        <nav>
            <form action="../api/classificacao.php" method="get" id="form1">
                <input type="hidden" name="txtClassificacao" id="txtClassificacao" value="0"/>
                <input type="hidden" name="txtMusicaId" id="txtMusicaId" <?php echo "value='". $_GET['musicaid']."'"; ?>/>

                <img class="star" id="star-1"src="../images/star0.webp" alt="star" onclick="avaliar(1), timer()"/>
                <img class="star" id="star-2"src="../images/star0.webp" alt="star" onclick="avaliar(2), timer()"/>
                <img class="star" id="star-3"src="../images/star0.webp" alt="star" onclick="avaliar(3), timer()"/>
                <img class="star" id="star-4"src="../images/star0.webp" alt="star" onclick="avaliar(4), timer()"/>
                <img class="star" id="star-5"src="../images/star0.webp" alt="star" onclick="avaliar(5), timer()"/>
            </form>
        </nav>
        <div>
            <p id="minimo">00:00</p>
            <?php
              echo "<p id='maximo'>". $regPop['MSCDURACAO'] ."</p>";
            ?>
            <progress id="musicaProgresso" value="0" max="0"></progress>
            <button id="btnTocar" onclick="iniciar()"></button>
        </div>
        <button id="btnLetras" onclick="mostraLetras()">letras</button>
    </main>
    <div id="txtLetras" style="display: none;">
      <div>
        <?php
        $letras = nl2br(htmlentities($regPop['MSCLETRA'], ENT_QUOTES, 'UTF-8'));
        echo "<p>". $letras ."</p>";
        ?>
      </div>
    </div>
</body>
</html>
<script src="../js/musicas.js"></script>
<script>
  var aval = <?php echo $regAvaliar['CLSNOTA']; ?>;
  avaliar(aval);
</script>

<?php
mysqli_free_result($consultaAvaliar); 
mysqli_free_result($consultaPop); 
mysqli_close($conexao);
?>
