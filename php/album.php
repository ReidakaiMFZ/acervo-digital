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
$queryAlbum = "SELECT ALBNOME, BDSNOME, ARTNOME, GRVNOME, MDSNOME, GNRNOME, 
DATE_FORMAT(ALBDTLANCAMENTO, '%d de %b de %Y') ALBDTLANCAMENTO, ALBCAPA
                FROM ALBUNS 
                LEFT JOIN BANDAS ON BDSCODIGO = ALBBANDA
                LEFT JOIN ARTISTAS ON ARTCODIGO = ALBARTISTA
                LEFT JOIN GRAVADORAS ON GRVCODIGO = ALBGRAVADORA
                LEFT JOIN MIDIAS ON MDSCODIGO = ALBMIDIA
                LEFT JOIN GENEROS ON GNRCODIGO = ALBGENERO
                WHERE ALBCODIGO = ". $_GET['albumid'];
$queryMusicas = "SELECT MSCCODIGO, MSCNOME, ALBCAPA, CLSNOTA
                    FROM MUSICAS
                    LEFT JOIN FAIXAS ON FXSMUSICA = MSCCODIGO
                    LEFT JOIN ALBUNS ON ALBCODIGO = FXSALBUM
                    LEFT JOIN CLASSIFICACAO ON CLASSIFICACAO.CLSMUSICA = MUSICAS.MSCCODIGO
                    WHERE ALBCODIGO = ". $_GET['albumid'] . 
                    " ORDER BY FXSPOSICAO";
$consultaMusicas = mysqli_query($conexao, $queryMusicas);
$consultaAlbum = mysqli_query($conexao, $queryAlbum);
if(!$regAlbum = mysqli_fetch_assoc($consultaAlbum)){
    echo "<h1>Error 404</h1>";
    echo "<label>Not Found</label>";
    die();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/album.css">
    <link rel="icon" type="image/x-icon" href="../images/logo-etec.png">
    <title>Acervo - <?php echo $regAlbum['ALBNOME'];?></title>
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
    <main>
        <?php
        if(isset($regAlbum['ALBCAPA'])){
            echo "<img src='../images/". $regAlbum['ALBCAPA']. "' alt='album'>";
        }
        else{
            echo "<img src='../images/placeholder-de-imagens.png' alt='album'>";
        }

        echo "<span>Nome do álbum: ". $regAlbum['ALBNOME'] ."</span>";
        echo "<span>Gênero: ". $regAlbum['GNRNOME'] ."</span>";
        if(isset($regAlbum['BDSNOME'])){
            echo "<span>Banda: ". $regAlbum['BDSNOME'] ."</span>";
        }
        else{
            echo "<span>Artista: ". $regAlbum['ARTNOME'] ."</span>";
        }
        echo "<span>Gravadora: ". $regAlbum['GRVNOME'] ."</span>";
        echo "<span>Data De lançamento: ". $regAlbum['ALBDTLANCAMENTO'] ."</span>";
        echo "<span>Midia: ". $regAlbum['MDSNOME'] ."</span>";
        ?>
    </main>
    <nav>
        <?php
        while($regMusica = mysqli_fetch_assoc($consultaMusicas)){
            echo "<div class='musica'>";

            if($regMusica['ALBCAPA'] != null){
                echo   "<a href='../php/musicas.php?musicaid=". $regMusica['MSCCODIGO'] ."'><img src='../images/". $regMusica['ALBCAPA'] ."'/>";
            }
            else{
                echo   "<a href='../php/musicas.php?musicaid=". $regMusica['MSCCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
            }
            echo   "<label>" . $regMusica['MSCNOME'] . "</label></a>";
            echo "<div id='estrelas'>";
            
            $cont = 1;
            while ($cont <= 5) {
            if($cont <= round($regMusica['CLSNOTA'])){
                echo  "<img class='star' id='star-". $cont ."-". $regMusica['MSCCODIGO'] ."' src='../images/star1.webp' alt='star'/>";
            }
            else{
                echo  "<img class='star' id='star-". $cont ."-". $regMusica['MSCCODIGO'] ."' src='../images/star0.webp' alt='star'/>";
            }
            $cont++;
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </nav>
</body>

</html>