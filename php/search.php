<?php
$conexao = mysqli_connect("localhost", "root", "", "acervo");
$pesquisa = $_GET['txtPesquisa'];
if($pesquisa == "all")
{
    $queryPop = "SELECT MSCNOME, BDSNOME, ARTNOME, BDSCODIGO, ARTCODIGO
    FROM musicas 
    LEFT JOIN bandas ON BANDAS.BDSCODIGO = musicas.MSCBANDA
    LEFT JOIN artistas ON artistas.ARTCODIGO = musicas.MSCARTISTA";

    $queryBanda ="SELECT BDSCODIGO, BDSNOME
    FROM bandas";

    $queryCantor ="SELECT ARTCODIGO, ARTNOME
    FROM artistas";
}
else
{
    $queryPop ="SELECT MSCNOME, BDSNOME, ARTNOME, BDSCODIGO, ARTCODIGO
    FROM musicas 
    LEFT JOIN bandas ON BANDAS.BDSCODIGO = musicas.MSCBANDA
    LEFT JOIN artistas ON artistas.ARTCODIGO = musicas.MSCARTISTA
    WHERE MSCNOME LIKE '%". $pesquisa ."%' ORDER BY MSCNOME";

    $queryBanda ="SELECT BDSCODIGO, BDSNOME
    FROM bandas 
    WHERE BDSNOME LIKE '%". $pesquisa ."%' ORDER BY BDSNOME";

    $queryCantor ="SELECT ARTCODIGO, ARTNOME
    FROM artistas 
    WHERE ARTNOME LIKE '%". $pesquisa ."%' ORDER BY ARTNOME";
}
$consultaCantor = mysqli_query($conexao, $queryCantor);
$consultaBanda = mysqli_query($conexao, $queryBanda);
$consultaPop = mysqli_query($conexao, $queryPop);
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
  <h3><a href="#">Biblioteca</a></h3>
  <h3><a href="#">Cadastrar</a></h3>

  <form class="pesquisa" action="search.php" method="get">
    <?php echo"<input type='text' name='txtPesquisa' class='txtPesquisa' placeholder='Pesquisar...' value='". $pesquisa."'/>";?>
    <button type="submit" class="btnPesquisa"><img src="../images/search-site-pw2.png" alt=""/></button>
  </form>

  <div class="perfil">
    <img src="../images/unknown.ico">
    <h3>
      <a href="#">perfil</a>
    </h3>
  </div>    
</header>

<?php
if(mysqli_fetch_assoc($consultaPop))
{
    mysqli_free_result($consultaPop);
    $consultaPop = mysqli_query($conexao, $queryPop);
    //teste de musicas
    echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>";
    while($regPop = mysqli_fetch_assoc($consultaPop))
    {
        echo "<div class='linha'>";
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
                echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/>";
                echo   "<label>" . $regPop['MSCNOME'] . "</label></a>";
                echo "<br/>";
                if ($regPop['BDSNOME'] == null)
                {
                    echo   "<a href='cantor.php?artistaid=". $regPop['ARTCODIGO']."'><small>" . $regPop['ARTNOME'] . "</small></a>";
                }
                else
                {
                    echo   "<a href='banda.php?bandaid=". $regPop['BDSCODIGO']."'><small>" . $regPop['BDSNOME'] . "</small></a>";
                }
                echo "</td>";
                echo "</div>";
                $regPop = mysqli_fetch_assoc($consultaPop);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "</div>";
    }
    echo "<a class='next' onclick='plusSlides(1)'>&#10095;</a>";
}
if(mysqli_fetch_assoc($consultaBanda))
{
    mysqli_free_result($consultaBanda);
    $consultaBanda = mysqli_query($conexao, $queryBanda);
    //bandas
    echo "<a class='prev1' onclick='plusSlides1(parseInt(-1, 10))'>&#10094;</a>";
    while($regBanda = mysqli_fetch_array($consultaBanda))
    {
        echo "<div class='linha1'>";
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
                echo   "<a href='banda.php?bandaid=". $regBanda['BDSCODIGO']."'><img src='../images/placeholder-de-imagens.png'/>";
                echo   "<label>" . $regBanda['BDSNOME'] . "</label></a>";
                echo "</td>";
                echo "</div>";
                $regBanda = mysqli_fetch_array($consultaBanda);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "</div>";
    }
    echo "<a class='next1' onclick='plusSlides1(parseInt(1, 10))'>&#10095;</a>";
}
if(mysqli_fetch_assoc($consultaCantor))
{
    mysqli_free_result($consultaCantor);
    $consultaCantor = mysqli_query($conexao, $queryCantor);
    //teste de cantor

    echo "<a class='prev2' onclick='plusSlides2(parseInt(-1, 10))'>&#10094;</a>";
    while($regCantor = mysqli_fetch_array($consultaCantor))
    {
        echo "<div class='linha2'>";
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
                echo   "<a href='cantor.php?artistaid=". $regCantor['ARTCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
                echo   "<label>" . $regCantor['ARTNOME'] . "</label></a>";
                echo "</td>";
                echo "</div>";
                $regCantor = mysqli_fetch_array($consultaCantor);
            }
        }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "</div>";
    }
    echo "<a class='next2' onclick='plusSlides2(parseInt(1, 10))'>&#10095;</a>";
}

mysqli_free_result($consultaCantor);
mysqli_free_result($consultaPop);
mysqli_free_result($consultaBanda);

mysqli_close($conexao);
?>
</body>

<script src="../js/search.js"></script>
</html>