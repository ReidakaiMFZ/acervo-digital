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

$pesquisa = $_GET['txtPesquisa'];

$queryPop ="SELECT MSCCODIGO, MSCNOME, BDSNOME, ARTNOME, BDSCODIGO, ARTCODIGO, ALBCAPA
FROM MUSICAS 
LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA
LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA
LEFT JOIN FAIXAS ON FAIXAS.FXSMUSICA = MUSICAS.MSCCODIGO 
LEFT JOIN ALBUNS ON ALBUNS.ALBCODIGO = FAIXAS.FXSALBUM 
WHERE MSCNOME LIKE '%". $pesquisa ."%' ORDER BY MSCNOME ASC";

$queryBanda ="SELECT BDSCODIGO, BDSNOME
FROM BANDAS
WHERE BDSNOME LIKE '%". $pesquisa ."%' ORDER BY BDSNOME ASC";

$queryCantor ="SELECT ARTCODIGO, ARTNOME
FROM ARTISTAS 
WHERE ARTNOME LIKE '%". $pesquisa ."%' ORDER BY ARTNOME ASC";

$queryAlbum ="SELECT ALBCODIGO, ALBNOME, IFNULL(ALBCAPA, 'placeholder-de-imagens.png') ALBCAPA, BDSNOME, ARTNOME
FROM ALBUNS 
LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = ALBBANDA
LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = ALBARTISTA
WHERE ALBNOME LIKE '%". $pesquisa . "%' ORDER BY ALBNOME ASC";

$consultaCantor = mysqli_query($conexao, $queryCantor);
$consultaBanda = mysqli_query($conexao, $queryBanda);
$consultaPop = mysqli_query($conexao, $queryPop);
$consultaAlbum = mysqli_query($conexao, $queryAlbum);
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/search.css">
    <script src="../js/search.js"></script>
    <title>Acervo - Search</title>
</head>

<body>
    
<header>

  <h3><a href="../php/">Inicio</a></h3>
  <h3><a href="biblioteca.php">Biblioteca</a></h3>
  <h3><a href="cadastromus.php">Cadastrar</a></h3>

  <form class="pesquisa" action="search.php" method="get">
    <?php echo"<input type='text' name='txtPesquisa' class='txtPesquisa' placeholder='Pesquisar...' value='". $pesquisa."'/>";?>
    <button type="submit" class="btnPesquisa"><img src="../images/search-site-pw2.png" alt=""/></button>
  </form>

  <div class="perfil">
    <img src="../images/unknown.ico">
    <h3>
      <a href="perfil.php">perfil</a>
    </h3>
  </div>    
</header>

<?php
// musica
if(mysqli_fetch_assoc($consultaPop)){
    mysqli_free_result($consultaPop);
    $consultaPop = mysqli_query($conexao, $queryPop);
    //teste de musicas
    while($regPop = mysqli_fetch_assoc($consultaPop))
    {
        echo "<div class='linha'>";
        echo "<a class='prev' id='prev' onclick='plusSlides(-1)'>&#10094;</a>";
        echo  "<h2>Musicas</h2>";
        echo  "<table>";
        echo    "<tbody>";
        echo      "<tr>";
        for($i = 0; $i < 7; $i++)
        {
            if($regPop != null)
            {
                echo "<td>";
                echo "<div class='album'>";
                if($regPop['ALBCAPA'] != null){
                    echo   "<a href='../php/musicas.php?musicaid=". $regPop['MSCCODIGO'] ."'><img src='../images/". $regPop['ALBCAPA'] ."'/>";
                }
                else{
                    echo   "<a href='../php/musicas.php?musicaid=". $regPop['MSCCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
                }
                echo   "<label>" . $regPop['MSCNOME'] . "</label></a>";
                echo "<br/>";
                if ($regPop['BDSNOME'] == null)
                {
                    echo   "<a href='cantorPes.php?artistaid=". $regPop['ARTCODIGO']."'><small>" . $regPop['ARTNOME'] . "</small></a>";
                }
                else
                {
                    echo   "<a href='bandaPes.php?bandaid=". $regPop['BDSCODIGO']."'><small>" . $regPop['BDSNOME'] . "</small></a>";
                }
                echo "<div id='estrelas'>";
                $cont = 1;
                $queryNotas = "SELECT AVG(CLSNOTA) media FROM CLASSIFICACAO WHERE CLSMUSICA = " . $regPop['MSCCODIGO'];
                $consultaNotas = mysqli_query($conexao, $queryNotas);
                $regNotas = mysqli_fetch_assoc($consultaNotas);
      
                while ($cont <= 5) {
                  if($cont <= round($regNotas['media'])){
                    echo  "<img class='star' id='star-". $cont ."-". $regPop['MSCCODIGO'] ."' src='../images/star1.webp' alt='star'/>";
                  }
                  else{
                    echo  "<img class='star' id='star-". $cont ."-". $regPop['MSCCODIGO'] ."' src='../images/star0.webp' alt='star'/>";
                  }
                  $cont++;
                }
                echo "</div>";
                echo "</td>";
                echo "</div>";
                $regPop = mysqli_fetch_assoc($consultaPop);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "<a class='next' id='next' onclick='plusSlides(1)'>&#10095;</a>";
        echo "</div>";
    }
}
// album
if(mysqli_fetch_assoc($consultaAlbum)){
    mysqli_free_result($consultaAlbum);
    $consultaAlbum = mysqli_query($conexao, $queryAlbum);
    //teste de cantor

    while($regAlbum = mysqli_fetch_array($consultaAlbum))
    {
        echo "<div class='linha3'>";
        echo "<a class='prev' id='prev3' onclick='plusSlides3(parseInt(-1, 10))'>&#10094;</a>";
        echo  "<h2>Álbuns</h2>";
        echo  "<table>";
        echo    "<tbody>";
        echo      "<tr>";
        for($i = 0; $i < 7; $i++)
        {
            if($regAlbum != null)
            {
                echo "<td>";
                echo "<div class='album'>";
                echo   "<a href='album.php?albumid=". $regAlbum['ALBCODIGO'] ."'><img src='../images/". $regAlbum['ALBCAPA'] ."'/>";
                echo   "<label>" . $regAlbum['ALBNOME'] . "</label></a>";
                echo "</td>";
                echo "</div>";
                $regAlbum = mysqli_fetch_array($consultaAlbum);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "<a class='next' id='next3' onclick='plusSlides3(parseInt(1, 10))'>&#10095;</a>";
        echo "</div>";
    }
}
// banda
if(mysqli_fetch_assoc($consultaBanda)){
    mysqli_free_result($consultaBanda);
    $consultaBanda = mysqli_query($conexao, $queryBanda);
    //bandas
    while($regBanda = mysqli_fetch_array($consultaBanda))
    {
        echo "<div class='linha1'>";
        echo "<a class='prev' id='prev1' onclick='plusSlides1(parseInt(-1, 10))'>&#10094;</a>";
        echo  "<h2>Bandas</h2>";
        echo  "<table>";
        echo    "<tbody>";
        echo      "<tr>";
        for($i = 0; $i < 7; $i++)
        {
            if($regBanda != null)
            {
                echo "<td>";
                echo "<div class='album'>";
                echo   "<a href='bandaPes.php?bandaid=". $regBanda['BDSCODIGO']."'><img src='../images/placeholder-de-imagens.png'/>";
                echo   "<label>" . $regBanda['BDSNOME'] . "</label></a>";
                echo "</td>";
                echo "</div>";
                $regBanda = mysqli_fetch_array($consultaBanda);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "<a class='next' id='next1' onclick='plusSlides1(parseInt(1, 10))'>&#10095;</a>";
        echo "</div>";
    }
}
// artista
if(mysqli_fetch_assoc($consultaCantor)){
    mysqli_free_result($consultaCantor);
    $consultaCantor = mysqli_query($conexao, $queryCantor);
    //teste de cantor

    while($regCantor = mysqli_fetch_array($consultaCantor))
    {
        echo "<div class='linha2'>";
        echo "<a class='prev' id='prev2' onclick='plusSlides2(parseInt(-1, 10))'>&#10094;</a>";
        echo  "<h2>Artistas</h2>";
        echo  "<table>";
        echo    "<tbody>";
        echo      "<tr>";
        for($i = 0; $i < 7; $i++)
        {
            if($regCantor != null)
            {
                echo "<td>";
                echo "<div class='album'>";
                echo   "<a href='cantorPes.php?artistaid=". $regCantor['ARTCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
                echo   "<label>" . $regCantor['ARTNOME'] . "</label></a>";
                echo "</td>";
                echo "</div>";
                $regCantor = mysqli_fetch_array($consultaCantor);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "<a class='next' id='next2' onclick='plusSlides2(parseInt(1, 10))'>&#10095;</a>";
        echo "</div>";
    }
}

mysqli_free_result($consultaCantor);
mysqli_free_result($consultaPop);
mysqli_free_result($consultaBanda);

mysqli_close($conexao);
?>
</body>

<script src="../js/search.js"></script>
</html>