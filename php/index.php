<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "","acervo");
$queryMusica = "SELECT MSCNOME, MSCDURACAO, BDSNOME, ARTNOME
FROM musicas 
LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA 
LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA ";
$consultaMusicas = mysqli_query($conexao, $queryMusica);

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

<div class="linha">
  <h2>Músicas</h2>
  <table>
    <tbody>
      <tr>
        <?php
        for($i = 0; $i<=6; $i++){
          $regMusicas = mysqli_fetch_assoc($consultaMusicas);
          echo "<td>";
          echo "<div class='album'>";
          echo   "<a href=''><img src='../images/placeholder-de-imagens.png'/>";
          echo   "<label>" . $reg['MSCNOME'] . "</label></a>";
          echo "<br/>";
          if ($reg['BDSNOME'] == NULL){
            echo   "<a href=''><small>" . $regMusicas['ARTNOME'] . "</small></a>";
          }
          else{
            echo   "<a href=''><small>" . $regMusicas['BDSNOME'] . "</small></a>";
          }
          echo "</td>";
          echo "</div>";
        }
        mysqli_free_result($consultaMusicas);
        mysqli_close($conexao);
        ?>
      </tr>
    </tbody>
  </table>
</div>

</body>

</html>