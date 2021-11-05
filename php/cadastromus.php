<?php
session_start();
$_SESSION['USRCODIGO'] = "103943";
if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../login.htm');
}
$conexao = mysqli_connect("192.168.0.12", "Aluno2DS", "SenhaBD2", "ACERVO");
?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/cadastromus.css">
  <title>Acervo - Inserir</title>
</head>

<body>

<header>
  <h3><a href="../php/">Inicio</a></h3>
  <h3><a href="#">Biblioteca</a></h3>
  <h3><a href="#">Cadastrar</a></h3>

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

<select id="escolheInsercao" onchange="escolha()">
  <option value="">--Selecionar--</option>
  <option value="0"> Inserir albuns</option>
  <option value="1"> Inserir artistas</option>
  <option value="2"> Inserir bandas</option>
  <option value="3"> Inserir generos</option>
  <option value="4"> Inserir gravadoras</option>
  <option value="5"> Inserir instrumento</option>
  <option value="6"> Inserir musicas</option>
</select>

<div id="insercao00" class="insercao" name="insercao00"style="display: none;">
  <h1>Álbuns</h1>
  <label for="NOME">
    <span>Nome</span>
    <input type="text" name="txtAlbum" id="txtAlbum"/>
  </label>
  <label for="GRAVADORA">
    <span>Gravadora</span>
    <select name="txtGravadora" id="txtGravadora">
      <option value="">--Selecionar--</option>
    <?php
      $queryGravadora = mysqli_query($conexao, "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS");
      while($regGravadora = mysqli_fetch_assoc($queryGravadora)){
        echo "<option value='". $regGravadora['GRVCODIGO'] ."'>". $regGravadora["GRVNOME"] ."</option>";
      }
    ?>
    </select>
  </label>
  <label for="GENERO">
    <span>Gênero</span>
    <select name="txtGravadora" id="txtGravadora">
      <option value="">--Selecionar--</option>
    <?php
      $queryGenero = mysqli_query($conexao, "SELECT GNRNOME, GNRCODIGO FROM GENEROS");
      while($regGenero = mysqli_fetch_assoc($queryGenero)){
        echo "<option value='". $regGenero['GNRCODIGO'] ."'>". $regGenero["GNRNOME"] ."</option>";
      }
    ?>
    </select>
  </label>
  <Label for="banda">
  <span>Banda</span>
    <select name="txtBanda" id="txtBanda">
      <option value="">--Selecionar--</option>
    <?php
      $queryBanda = mysqli_query($conexao, "SELECT ALBNOME, ALBCODIGO FROM ALBUNS");
      while($regBanda = mysqli_fetch_assoc($queryBanda)){
        echo "<option value='". $regBanda['ALBCODIGO'] ."'>". $regBanda["ALBNOME"] ."</option>";
      }
    ?>
    </select>
  </Label>
</div>

<div id="insercao01" class="insercao" name="insercao01"style="display: none;"></div>
<div id="insercao02" class="insercao" name="insercao02"style="display: none;"></div>
<div id="insercao03" class="insercao" name="insercao03"style="display: none;"></div>
<div id="insercao04" class="insercao" name="insercao04"style="display: none;"></div>
<div id="insercao05" class="insercao" name="insercao05"style="display: none;"></div>
<div id="insercao06" class="insercao" name="insercao06"style="display: none;"></div>

</body>

<script src="../js/cadastromus.js"></script>
</html>