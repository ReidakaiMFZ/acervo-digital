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
$queryMusicas = "SELECT MSCNOME, ALBCAPA
                    FROM ALBUNS
                    LEFT JOIN FAIXAS ON FXSALBUM = ALBCODIGO
                    LEFT JOIN MUSICAS ON MSCCODIGO = FXSMUSICA
                    WHERE ALBCODIGO = ". $_GET['albumid'];
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
            echo "<div class='linha'>";
            echo  "<h2>Musicas</h2>";
            while($regMusicas = mysqli_fetch_assoc($consultaMusicas)){
                echo "<div class='album'>";
                if(isset($regMusicas['ALBCAPA'])){
                    echo "<img src='../images/". $regMusicas['ALBCAPA'] ."' alt='musica'>";
                }
                else{
                    echo "<img src='../images/placeholder-de-imagens.png' alt='musica'>";
                }
                
                echo "<label>". $regMusicas['MSCNOME'] ."</label>";
                echo "</div>";
            }
            echo "</ul>";
            echo "</div>";
        ?>
    </nav>
</body>

</html>