<?php
session_start();




$conexao = mysqli_connect("localhost", "root", "","acervo");

$queryGeneros ="SELECT * FROM GENEROS";

$consultaGeneros = mysqli_query($conexao, $queryGeneros);
$qntgeneros = mysqli_query($conexao, "SELECT MAX(GNRCODIGO) FROM generos");
$c = 1;
$qntgeneros2 = mysqli_fetch_assoc($qntgeneros);

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

  <h3><a href="#">Inicio</a></h3>
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
while($c < (int)$qntgeneros2['MAX(GNRCODIGO)']){
  if(mysqli_fetch_assoc($consultaGeneros))
  {
    $queryPop ="SELECT MSCNOME, BDSNOME, ARTNOME, GNRNOME 
    FROM musicas 
    LEFT JOIN generos ON GENEROS.GNRCODIGO = MUSICAS.MSCGENERO
    LEFT JOIN bandas ON BANDAS.BDSCODIGO = musicas.MSCBANDA
    LEFT JOIN artistas ON artistas.ARTCODIGO = musicas.MSCARTISTA
    WHERE MSCGENERO =". $c;
    $consultaPop = mysqli_query($conexao, $queryPop);
    $regGeneros = mysqli_fetch_assoc($consultaGeneros);
    echo "<div class='linha'>";
    echo  "<h2>". $regGeneros['GNRNOME'] ."</h2>";
    echo  "<table>";
    echo    "<tbody>";
    echo      "<tr>";
          
    for($i = 0; $i<=6; $i++){
      $regPop = mysqli_fetch_assoc($consultaPop);
      echo "<td>";
      echo "<div class='album'>";
      echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/>";
      echo   "<label>" . $regPop['MSCNOME'] . "</label></a>";
      echo "<br/>";
      if ($regPop['BDSNOME'] == NULL){
        echo   "<a href=''><small>" . $regPop['ARTNOME'] . "</small></a>";
     }
      else{
        echo   "<a href=''><small>" . $regPop['BDSNOME'] . "</small></a>";
      }
        echo "</td>";
        echo "</div>";
      }     
    
    echo      "</tr>";
    echo    "</tbody>";
    echo  "</table>";
    echo "</div>";

  }
  $c++;
}
mysqli_close($conexao);
?>





</body>

</html>