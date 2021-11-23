<?php
session_start();
if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}
$conexao = mysqli_connect("localhost", "root", "", "ACERVO");
?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../css/cadastromus.css">
  <title>Acervo - Inserir</title>
</head>
<script src="../js/fnRadioButton.js"></script>
<script src="../js/cadastromus.js"></script>
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

  <select id="escolheInsercao"  onchange="escolha()">
    <option value="-1">--Selecionar--</option>
    <option value="0"> Inserir albuns</option>
    <option value="1"> Inserir artistas</option>
    <option value="2"> Inserir bandas</option>
    <option value="3"> Inserir generos</option>
    <option value="4"> Inserir gravadoras</option>
    <option value="5"> Inserir instrumento</option>
    <option value="6"> Inserir musicas</option>
  </select>
  <!-- albuns -->
  <div id="insercao00" class="insercao" name="insercao00" style="display: none;">
    <form action="envioDados.php" method="post" enctype="multipart/form-data">
      <h1>Álbuns</h1>
      <input type="hidden" name="TipoInsert" value="0" />
      <!-- NOME DO ALBUM -->
      <label for="NOME">
        <span>Nome</span>
        <input type="text" name="txtAlbum" id="txtAlbum" require />
      </label>
      <!-- GRAVADORA -->
      <label for="GRAVADORA">
        <span>Gravadora</span>
        <select name="txtGravadora" id="txtGravadora" require>
          <option value="">--Selecionar--</option>
          <?php
            $queryGravadora = mysqli_query($conexao, "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS ORDER BY GRVNOME ASC");
            while($regGravadora = mysqli_fetch_assoc($queryGravadora)){
              echo "<option value='". $regGravadora['GRVCODIGO'] ."'>". $regGravadora["GRVNOME"] ."</option>";
            }
            mysqli_free_result($queryGravadora);
          ?>
        </select>
      </label>
      <!-- GENERO -->
      <label for="GENERO">
        <span>Gênero</span>
        <select name="txtGenero" id="txtGenero" require>
          <option value="">--Selecionar--</option>
          <?php
            $queryGenero = mysqli_query($conexao, "SELECT GNRNOME, GNRCODIGO FROM GENEROS ORDER BY GNRNOME ASC");
            while($regGenero = mysqli_fetch_assoc($queryGenero)){
              echo "<option value='". $regGenero['GNRCODIGO'] ."'>". $regGenero["GNRNOME"] ."</option>";
            }
            mysqli_free_result($queryGenero);
          ?>
        </select>
      </label>
      <Label for="banda">
        <!-- BOTÕES DE RADIO -->
        <div id="divRadButton">
          <label>
            <input type="radio" name="rdBndArt" id="rdBndArt" class="rdBndArt" checked onclick="fnRadioButton(1)">
            <span class="rdBndArt">Banda</span>
          </label>
          <label>
            <input type="radio" name="rdBndArt" id="rdBndArt" class="rdBndArt" onclick="fnRadioButton(2)">
            <span class="rdBndArt">Artista</span>
          </label>
        </div>
        <!-- INPUT DE BANDA -->
        <label id="lblBanda">
          <span>Banda</span>
          <select name="txtBanda" id="txtBanda" require>
            <option value="-1">--Selecionar--</option>
            <?php
              $queryBanda = mysqli_query($conexao, "SELECT BDSNOME, BDSCODIGO FROM BANDAS ORDER BY BDSNOME ASC");
              while($regBanda = mysqli_fetch_assoc($queryBanda)){
                echo "<option value='". $regBanda['BDSCODIGO'] ."'>". $regBanda["BDSNOME"] ."</option>";
              }
              mysqli_free_result($queryBanda);
            ?>
          </select>
        </Label>
        <!-- INPUT DE ARTISTA -->
        <label id="lblArtista" style="display: none;">
          <span>Artista</span>
          <select name="txtArtista" id="txtArtista">
            <option value="-1">--Selecionar--</option>
            <?php
              $queryArtista = mysqli_query($conexao, "SELECT ARTNOME, ARTCODIGO FROM ARTISTAS ORDER BY ARTNOME ASC");
              while($regArtista = mysqli_fetch_assoc($queryArtista)){
                echo "<option value='". $regArtista['ARTCODIGO'] ."'>". $regArtista["ARTNOME"] ."</option>";
              }
              mysqli_free_result($queryArtista);
            ?>
          </select>
        </label>
      </Label>
      <!-- DATA DE LANÇAMENTO -->
      <label>
        <span>Data de lançamento</span>
        <input type="date" name="inpData" id="inpData" require />
      </Label>
      <!-- CAPA -->
      <label>
        <span>Capa</span>
        <input type="file" name="inpCapa" id="inpCapa" />
      </label>
      <!-- MIDIA -->
      <label>
        <span>Mídia</span>
        <select name="txtMidia" id="txtMidia" require>
          <option value="">--Selecionar--</option>
          <?php
            $queryMidia = mysqli_query($conexao, "SELECT MDSCODIGO, MDSNOME FROM MIDIAS ORDER BY MDSNOME ASC");
            while($regMidia = mysqli_fetch_assoc($queryMidia)){
              echo "<option value='". $regMidia['MDSCODIGO'] ."'>". $regMidia['MDSNOME'] ."</option>";
            }
            mysqli_free_result($queryMidia);
          ?>
        </select>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- artistas -->
  <div id="insercao01" class="insercao" name="insercao01" style="display: none;">
    <form action="envioDados.php" method="POST">
      <input type="hidden" name="TipoInsert" value="1" />
      <h1>Artista</h1>
      <label>
        <span>Nome</span>
        <input type="text" name="txtArtista" id="txtArtista" require />;
      </label>
      <label>
        <span>Data de inicio</span>
        <input type="date" name="txtDtInicioArt" id="txtDtInicioArt" require />
      </label>
      <label>
        <span>Data de Término</span>
        <input type="date" name="txtDtTerminoArt" id="txtDtTerminoArt" />
      </label>
      <!-- banda -->
      <label>
        <span>Banda</span>
        <select name="cmbArtBanda" id="cmbArtBanda" onchange="fnInstrumento(this.value)">
          <option value="-1">--Selecionar--</option>
          <?php
          $queryBanda = mysqli_query($conexao, "SELECT BDSCODIGO, BDSNOME FROM BANDAS ORDER BY BDSNOME ASC");
          while($regBanda = mysqli_fetch_assoc($queryBanda)){
            echo "<option value='".$regBanda['BDSCODIGO']."'>".$regBanda['BDSNOME']."</option>";
          }
          mysqli_free_result($queryBanda);
          ?>
        </select>
      </label>
      <!-- instrumento -->
      <label id="lblInstrumento" style="display : none;">
        <span>Instrumento</span>
        <select name="cmbInstrumento" id="cmbInstrumento">
          <option value="-1">--Selecionar--</option>
          <?php
          $queryInstrumento = mysqli_query($conexao, "SELECT INSCODIGO, INSNOME FROM INSTRUMENTOS ORDER BY INSNOME ASC");
          while($regInstrumento = mysqli_fetch_assoc($queryInstrumento)){
            echo "<option value='".$regInstrumento['INSCODIGO']."'>".$regInstrumento['INSNOME']."</option>";
          }
          mysqli_free_result($queryInstrumento);
          ?>
        </select>
      </label>
      <!-- inicio banda -->
      <label id="lblBandaIniArt" style="display : none;">
        <span>Data de inicio na banda</span>
        <input type="date" name="txtBandaIniArt" id="txtBandaIniArt" require />
      </label>
      <!-- termino banda -->
      <label id="lblBandaFimArt" style="display : none;">
        <span>Data de Término na banda</span>
        <input type="date" name="txtBandaFimArt" id="txtBandaFimArt" />
      </label>
      <!-- apresentação -->
      <label>
        <span>Apresentação</span>
        <textarea name="txtArtistaApres" id="txtArtistaApres" require></textarea>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- bandas -->
  <div id="insercao02" class="insercao" name="insercao02" style="display: none;">
    <form action="envioDados.php" method="POST">
      <input type="hidden" name="TipoInsert" value="2" />
      <h1>Banda</h1>
      <label>
        <span>Nome</span>
        <input type="text" name="txtBanda" id="txtBanda" require />;
      </label>
      <label>
        <span>Data de inicio</span>
        <input type="date" name="txtDtInicioBnd" id="txtDtInicioBnd" require />
      </label>
      <label>
        <span>Data de Término</span>
        <input type="date" name="txtDtTerminoBnd" id="txtDtTerminoBnd" />
      </label>
      <label>
        <span>Apresentação</span>
        <textarea name="txtBandaApres" id="txtBandaApres" require></textarea>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- generos -->
  <div id="insercao03" class="insercao" name="insercao03" style="display: none;">
    <form action="envioDados.php" method="POST">
      <input type="hidden" name="TipoInsert" value="3" />
      <h1>Gênero</h1>
      <label>
        <span>Nome</span>
        <input type="text" name="txtGenero" id="txtGenero" require />;
      </label>
      <label>
        <span>Descrição</span>
        <textarea name="txtGeneroApres" id="txtGeneroApres" require></textarea>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- gravadoras -->
  <div id="insercao04" class="insercao" name="insercao04" style="display: none;">
    <form action="envioDados.php" method="post">
      <input type="hidden" name="TipoInsert" value="4" />
      <h1>Gravadora</h1>
      <label>
        <span>Nome da Gravadora</span>
        <input type="text" name="txtGravadora" id="txtGravadora" require />;
      </label>
      <label>
        <span>Data de Fundação</span>
        <input type="date" name="txtFundDt" id="txtFundDt" require />
      </label>
      <label>
        <span>Data de Falência</span>
        <input type="date" name="txtFalenDt" id="txtFalenDt" />
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- instrumentos -->
  <div id="insercao05" class="insercao" name="insercao05" style="display: none;">
    <form action="envioDados.php" method="post">
      <input type="hidden" name="TipoInsert" value="5"/>
      <h1>instrumento</h1>
      <label>
        <span>Nome</span>
        <input type="text" name="txtInstrumento" id="txtInstrumento" require/>
      </label>
      <label>
        <span>tipo de instrumento</span>
        <select name="cmbInst" id="cmbInst">
          <option value="">--Selecionar--</option>
        </select>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>
  <!-- musicas -->
  <div id="insercao06" class="insercao" name="insercao06" style="display: none;">
    <!-- musica -->
    <form action="envioDados.php" method="post">
      <input type="hidden" name="TipoInsert" value="6">
      <h1>Música</h1>
      <label>
          <span>Nome</span>
        <input type="text" name="txtMusica" id="txtMusica" />
      </label>
      <!-- duração -->
      <label>
        <span>Duração</span>
        <input type="time" name="txtTempoMus" id="txtTempoMus" step="1"/>
      </label>
      <!-- generos -->
      <label>
        <span>Gênero</span>
        <select name="cmbGenero" id="cmbGenero">
          <option value="-1">--Selecionar--</option>
          <?php
            $queryGenero = mysqli_query($conexao, "SELECT GNRNOME, GNRCODIGO FROM GENEROS ORDER BY GNRNOME ASC");
            while($regGenero = mysqli_fetch_assoc($queryGenero)){
              echo "<option value='". $regGenero['GNRCODIGO'] ."'>". $regGenero["GNRNOME"] ."</option>";
            }
            mysqli_free_result($queryGenero);
          ?>
        </select>
      </label>
      <!-- bandas e artistas -->
      <div id="divRadButton">
        <label>
          <input type="radio" name="rdBndArt" id="rdBndArt" class="rdBndArt" checked onclick="fnRadioButton2(1)">
          <span class="rdBndArt">Banda</span>
        </label>
        <label>
          <input type="radio" name="rdBndArt" id="rdBndArt" class="rdBndArt" onclick="fnRadioButton2(2)">
          <span class="rdBndArt">Artista</span>
        </label>
      </div>
      <!-- bandas -->
      <label id="lblMusBanda">
        <span>Banda</span>
        <select name="cmbBanda" id="cmbBanda">
          <option value="-1">--Selecionar--</option>
          <?php
            $queryMusBanda = mysqli_query($conexao, "SELECT BDSNOME, BDSCODIGO FROM BANDAS ORDER BY BDSNOME ASC");
            while($regMusBanda = mysqli_fetch_assoc($queryMusBanda)){
              echo "<option value='". $regMusBanda['BDSCODIGO'] ."'>". $regMusBanda["BDSNOME"] ."</option>";
            }
            mysqli_free_result($queryMusBanda);
          ?>
        </select>
      </label>
      <!-- artistas -->
      <label id="lblMusArtista" style="display: none;">
        <span>Artista</span>
        <select name="cmbArtista" id="cmbArtista">
          <option value="-1">--Selecionar--</option>
          <?php
            $queryMusArtista = mysqli_query($conexao, "SELECT ARTNOME, ARTCODIGO FROM ARTISTAS ORDER BY ARTNOME ASC");
            while($regMusArtista = mysqli_fetch_assoc($queryMusArtista)){
              echo "<option value='". $regMusArtista['ARTCODIGO'] ."'>". $regMusArtista["ARTNOME"] ."</option>";
            }
            mysqli_free_result($queryMusArtista);
          ?>
        </select>
      </label>
      <!-- album -->
      <label>
        <span>Album</span>
        <select name="cmbAlbumMus" id="cmbAlbumMus">
          <option value="-1">--Selecionar--</option>
          <?php
            $queryAlbum = mysqli_query($conexao, "SELECT ALBCODIGO, ALBNOME FROM ALBUNS ORDER BY ALBNOME ASC");
            while($regAlbum = mysqli_fetch_assoc($queryAlbum)){
              echo "<option value='". $regAlbum['ALBCODIGO'] ."'>". $regAlbum['ALBNOME'] . "</option>";
            }
            mysqli_free_result($queryAlbum);
          ?>
        </select>
      </label>
      <!-- letra -->
      <label>
        <span>Letra</span>
        <textarea name="txtLetraMus" id="txtLetraMus" placeholder="digite a letra da musica aqui..."></textarea>
      </label>
      <!-- link do video -->
      <label>
        <span>Link do vídeo</span>
        <input type="url" name="txtUrlMusica" id="txtUrlMusica"  required/>
      </label>
      <!-- link do audio -->
      <label>
        <span>Link do áudio</span>
        <input type="url" name="txtUrlSomMusica" id="txtUrlSomMusica"  required/>
      </label>
      <button type="submit">Enviar</button>
    </form>
  </div>

</body>
<?php mysqli_close($conexao);?>
<script>
  var params = window.location.search.split('?')[1].split('&');
  var s = params[0].split('=')[1];
  var errors = params[1].split('=')[1];

  if(s >= 0 && s <=6)
  {
    document.getElementById('escolheInsercao').value = parseInt(s);
    escolha();
  }
  else{
    document.getElementById('escolheInsercao').value = -1;
  }
  if(s == 0 && errors == 1){
    alert("O nome do album não pode ser vazio!!");
  }
  else if(s == 0 && errors == 2){
    alert("Escolha o tipo de Midia!!");
  }

</script>
</html>