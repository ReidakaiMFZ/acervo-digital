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
$queryBanda = "SELECT BDSCODIGO, BDSNOME FROM BANDAS WHERE BDSCODIGO = ". $_GET['bandaid'];
$queryAlbum = "SELECT ALBCODIGO, ALBNOME, ALBCAPA FROM ALBUNS 
                LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = ALBUNS.ALBBANDA
                WHERE BDSCODIGO = ". $_GET['bandaid'];
$consultaBanda = mysqli_query($conexao, $queryBanda);
$consultaAlbum = mysqli_query($conexao, $queryAlbum);
if(!$regBanda = mysqli_fetch_assoc($consultaBanda)){
    echo "<h1>Error 404</h1>";
    echo "<label>Not Found</label>";
    die();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../css/bandaPes.css">
    <link rel="icon" type="image/x-icon" href="../images/logo-etec.png">
    <title>Acervo - <?php echo $regBanda['BDSNOME'];?></title>
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
        <img src='../images/placeholder-de-imagens.png' alt='album'>
        <?php
        echo "<span>Nome da Banda: ". $regBanda['BDSNOME'] ."</span>";
        echo "<a href='banda.php?bandaid=". $regBanda['BDSCODIGO'] ."'><span>...</span></a>";
        ?>
    </main>
    <nav>
        <?php
        while($regAlbum = mysqli_fetch_assoc($consultaAlbum)){
            echo "<div class='musica'>";

            if($regAlbum['ALBCAPA'] != null){
                echo   "<a href='../php/album.php?albumid=". $regAlbum['ALBCODIGO'] ."'><img src='../images/". $regAlbum['ALBCAPA'] ."'/>";
            }
            else{
                echo   "<a href='../php/album.php?albumid=". $regAlbum['ALBCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
            }
            echo   "<label>" . $regAlbum['ALBNOME'] . "</label></a>";
            echo "</div>";
        }
        ?>
    </nav>
</body>

</html>