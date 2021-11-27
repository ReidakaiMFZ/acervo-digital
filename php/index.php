<?php
session_start();

ini_set('display_errors', "On");
error_reporting(E_ALL);

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}

$conexao = mysqli_connect("localhost", "root", "", "ACERVO");
if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}

?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/index.css">
  <title>Acervo - Inicio</title>
</head>

<body>

<header>
  <h3><a href="../php/">Inicio</a></h3>
  <h3><a href="biblioteca.php">Biblioteca</a></h3>
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
$queryGeneros ="SELECT * FROM GENEROS"; //pesquisa de generos no banco de dados
$qntgeneros2 = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT MAX(GNRCODIGO) FROM GENEROS"));
$c = 1; //contador
try{
  while($c <= ((int)$qntgeneros2['MAX(GNRCODIGO)'])){
    $queryPop ="SELECT MSCCODIGO, MSCNOME, BDSNOME, ARTNOME, GNRNOME, GNRCODIGO, BDSCODIGO, ARTCODIGO, ALBCAPA 
    FROM MUSICAS 
    LEFT JOIN GENEROS ON GENEROS.GNRCODIGO = MUSICAS.MSCGENERO 
    LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA 
    LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA 
    LEFT JOIN FAIXAS ON FAIXAS.FXSMUSICA = MUSICAS.MSCCODIGO 
    LEFT JOIN ALBUNS ON ALBUNS.ALBCODIGO = FAIXAS.FXSALBUM 
    WHERE MSCGENERO = ". $c . " ORDER BY MSCNOME ASC"; //query de musicas
    $consultaPop = mysqli_query($conexao, $queryPop);

    if($regPop = mysqli_fetch_assoc($consultaPop)){
      echo "<div class='linha'>";
      echo  "<h2>". $regPop['GNRNOME'] ."</h2>";
      echo  "<table>";
      echo    "<tbody>";
      echo      "<tr>";//cabeçalho do div

      mysqli_free_result($consultaPop);
      $consultaPop = mysqli_query($conexao, $queryPop);

      for($i = 0; $i<=6; $i++){
        if($regPop = mysqli_fetch_assoc($consultaPop)){
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
          if ($regPop['BDSNOME'] == NULL){
            echo "<a href='cantor.php?artistaid=". $regPop['ARTCODIGO']."'><small>" . $regPop['ARTNOME'] . "</small></a>";
          }
          else{
            echo "<a href='banda.php?bandaid=". $regPop['BDSCODIGO']."'><small>" . $regPop['BDSNOME'] . "</small></a>";
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
          
          echo "</div>";
          echo "</td>";
        }
      }
        echo      "</tr>";
        echo    "</tbody>";
        echo  "</table>";
        echo "</div>";
        mysqli_free_result($consultaNotas);
    }
    else
    {
      $c++;
    }
    $c++;
  }
}
finally{
  mysqli_close($conexao);
}
?>
</body>
</html>