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
  <link rel="stylesheet" href="../css/cssinicio.css">
  <script src="../js/indexscript.js"></script>
  <title>Inicio - ACERVO</title>
</head>

<body>

<header>

  <h3><a href="../php/">Inicio</a></h3>
  <h3><a href="#">Biblioteca</a></h3>
  <h3><a href="#">Cadastrar</a></h3>

  <div class="pesquisa">
    <input id="txtPesquisa" type="search" class="txtPesquisa" placeholder="Pesquisar..." />
    <input type="image" class="btnPesquisa" src="../images/search-site-pw2.png" alt="">
  </div>

  <div class="perfil">
    <img src="../images/unknown.ico">
    <h3>
      <a href="#">perfil</a>
    </h3>
  </div>    
</header>

<?php
$conexao = mysqli_connect("localhost", "root", "","acervo"); //conexão
$queryGeneros ="SELECT * FROM GENEROS"; //pesquisa de generos no banco de dados
$consultaGeneros = mysqli_query($conexao, $queryGeneros); //consulta de generos de fato
$qntgeneros = mysqli_query($conexao, "SELECT MAX(GNRCODIGO) FROM generos"); // quantidades de generos maxima
$qntgeneros2 = mysqli_fetch_array($qntgeneros);
$c = 1; //contador

while($c < ((int)$qntgeneros2['MAX(GNRCODIGO)']+1))
{
    $queryPop ="SELECT MSCNOME, BDSNOME, ARTNOME, GNRNOME, GNRCODIGO, BDSCODIGO, ARTCODIGO
    FROM musicas 
    LEFT JOIN generos ON GENEROS.GNRCODIGO = MUSICAS.MSCGENERO
    LEFT JOIN bandas ON BANDAS.BDSCODIGO = musicas.MSCBANDA
    LEFT JOIN artistas ON artistas.ARTCODIGO = musicas.MSCARTISTA
    WHERE MSCGENERO =". $c; //query de musicas
    $consultaPop = mysqli_query($conexao, $queryPop);
  if(mysqli_fetch_assoc($consultaPop) != null)
  {
    $regPop = mysqli_fetch_assoc($consultaPop);
    echo "<div class='linha'>";
    echo  "<h2>". $regPop['GNRNOME'] ."</h2>";
    echo  "<table>";
    echo    "<tbody>";
    echo      "<tr>";//cabeçalho do div

  
    for($i = 0; $i<=6; $i++)
    {
      $regPop = mysqli_fetch_array($consultaPop);
      echo "<td>";
      echo "<div class='album'>";
      echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/>";
      echo   "<label>" . $regPop['MSCNOME'] . "</label></a>";
      echo "<br/>";
      if ($regPop['BDSNOME'] == NULL)
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
  else
  {
    $c++;
    mysqli_fetch_assoc($consultaGeneros);
  }
  $c++;
}

mysqli_close($conexao);
?>
</body>
</html>