<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cssinicio.css">
    <title>Search</title>
</head>
<body>
    
<?php
$conexao = mysqli_connect("localhost", "root", "", "acervo");
$pesquisa = $_GET['txtPesquisa'];

$queryPop ="SELECT MSCNOME, BDSNOME, ARTNOME, BDSCODIGO, ARTCODIGO
  FROM musicas 
  LEFT JOIN bandas ON BANDAS.BDSCODIGO = musicas.MSCBANDA
  LEFT JOIN artistas ON artistas.ARTCODIGO = musicas.MSCARTISTA
  WHERE MSCNOME LIKE '%". $pesquisa ."%' ORDER BY MSCNOME";
$consultaPop = mysqli_query($conexao, $queryPop);

$queryBanda ="SELECT BDSCODIGO, BDSNOME
  FROM bandas 
  WHERE BDSNOME LIKE '%". $pesquisa ."%' ORDER BY BDSNOME";
$consultaBanda = mysqli_query($conexao, $queryBanda);

$queryCantor ="SELECT ARTCODIGO, ARTNOME
  FROM artistas 
  WHERE ARTNOME LIKE '%". $pesquisa ."%' ORDER BY ARTNOME";
$consultaCantor = mysqli_query($conexao, $queryCantor);
//teste de musicas
if(mysqli_fetch_array($consultaPop) != null)
{
    echo "<div class='linha'>";
    echo  "<h2>Musicas</h2>";
    echo  "<table>";
    echo    "<tbody>";
    echo      "<tr>";

    while($regPop = mysqli_fetch_assoc($consultaPop))
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
     
    }
    echo      "</tr>";
    echo    "</tbody>";
    echo  "</table>";
    echo "</div>";
}
//teste de bandas
if(mysqli_fetch_array($consultaBanda) != null)
{
    echo "<div class='linha'>";
    echo  "<h2>Bandas</h2>";
    echo  "<table>";
    echo    "<tbody>";
    echo      "<tr>";

    while($regBanda = mysqli_fetch_assoc($consultaBanda))
    {
        echo "<td>";
        echo "<div class='album'>";
        echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/></a>";
        echo   "<a href='banda.php?bandaid=". $regBanda['BDSCODIGO']."'><label>" . $regBanda['BDSNOME'] . "</label></a>";
        echo "<br/>";
        echo "</td>";
        echo "</div>";
    }
    echo      "</tr>";
    echo    "</tbody>";
    echo  "</table>";
    echo "</div>";
}

//teste de cantor
if(mysqli_fetch_array($consultaCantor) != null)
{
    echo "<div class='linha'>";
    echo  "<h2>Artistas</h2>";
    echo  "<table>";
    echo    "<tbody>";
    echo      "<tr>";

    while($regCantor = mysqli_fetch_assoc($consultaCantor))
    {
        echo "<td>";
        echo "<div class='album'>";
        echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/></a>";
        echo   "<a href='cantor.php?artistaid=". $regCantor['ARTCODIGO'] ."'><label>" . $regCantor['ARTNOME'] . "</label></a>";
        echo "<br/>";
        echo "</td>";
        echo "</div>";
    }
    echo      "</tr>";
    echo    "</tbody>";
    echo  "</table>";
    echo "</div>";
}

mysqli_free_result($consultaCantor);
mysqli_free_result($consultaPop);
mysqli_free_result($consultaBanda);

mysqli_close($conexao);
?>
</body>
</html>