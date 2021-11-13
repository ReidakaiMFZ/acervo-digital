<?php
session_start();

ini_set('display_errors', "On");
error_reporting(E_ALL);


if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/index.css">
  <title>Inicio - ACERVO</title>
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

<?php
$conexao = mysqli_connect("localhost", "root", "", "ACERVO"); //conexão



$queryGeneros ="SELECT * FROM GENEROS"; //pesquisa de generos no banco de dados
$consultaGeneros = mysqli_query($conexao, $queryGeneros); //consulta de generos de fato
$qntgeneros2 = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT MAX(GNRCODIGO) FROM GENEROS"));
$c = 1; //contador

while($c < ((int)$qntgeneros2['MAX(GNRCODIGO)']+1))
{
    $queryPop ="SELECT MSCNOME, BDSNOME, ARTNOME, GNRNOME, GNRCODIGO, BDSCODIGO, ARTCODIGO
    FROM MUSICAS 
    LEFT JOIN GENEROS ON GENEROS.GNRCODIGO = MUSICAS.MSCGENERO
    LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA
    LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA
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
        echo "<a href='cantor.php?artistaid=". $regPop['ARTCODIGO']."'><small>" . $regPop['ARTNOME'] . "</small></a>";
      }
      else
      {
        echo "<a href='banda.php?bandaid=". $regPop['BDSCODIGO']."'><small>" . $regPop['BDSNOME'] . "</small></a>";
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
mysqli_free_result($consultaGeneros);
mysqli_close($conexao);
?>
</body>
</html>