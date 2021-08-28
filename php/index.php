<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "","acervo");
$query = "SELECT MSCNOME, MSCDURACAO, MSCBANDA, MSCARTISTA FROM musicas";
$consultas = mysqli_query($conexao, $query);
$total = mysqli_num_rows($consultas);
$contador = 0;
?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/cssinicio.css">
  <script src="../js/indexscript.js"></script>
  <title>inicial</title>
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

  <main>
      <?php
          while($reg = mysqli_fetch_assoc($consultas)){
            echo "<div id='fileira" . $contador . "'>";
            echo "<img src='alguma imagem aí'>";
            echo "<label>" . $reg['MSCNOME'] . "</label>";
            if($reg['MSCARTISTA'] != null){
              echo "<small>" . $reg['MSCARTISTA'] . "</small>";
            }
            else{
              echo "<small>" . $reg['MSCBANDA'] . "</small>";
            }
            echo "</div>";
            $contador++;
          }
          mysqli_free_result($consultas);
          mysqli_close($conexao);
        ?>
      
  </main>



</body>
</html>