<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}

$conexao = mysqli_connect("localhost", "root", "", "ACERVO");
if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}
$queryFav = "SELECT MSCCODIGO, MSCNOME, BDSNOME, ARTNOME, GNRNOME, GNRCODIGO, BDSCODIGO, ARTCODIGO, ALBCAPA, CLSNOTA
             FROM MUSICAS 
             LEFT JOIN GENEROS ON GENEROS.GNRCODIGO = MUSICAS.MSCGENERO 
             LEFT JOIN BANDAS ON BANDAS.BDSCODIGO = MUSICAS.MSCBANDA 
             LEFT JOIN ARTISTAS ON ARTISTAS.ARTCODIGO = MUSICAS.MSCARTISTA 
             LEFT JOIN FAIXAS ON FAIXAS.FXSMUSICA = MUSICAS.MSCCODIGO 
             LEFT JOIN ALBUNS ON ALBUNS.ALBCODIGO = FAIXAS.FXSALBUM
             LEFT JOIN CLASSIFICACAO ON CLASSIFICACAO.CLSMUSICA = MUSICAS.MSCCODIGO
             WHERE CLASSIFICACAO.CLSUSUARIO = ". $_SESSION['USRCODIGO']. " AND CLASSIFICACAO.CLSNOTA > 2";
$consultaFav = mysqli_query($conexao, $queryFav);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/biblioteca.css">
    <link rel="icon" type="image/x-icon" href="../images/logo-etec.png">
    <title>Acervo - Biblioteca</title>
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
    if(mysqli_fetch_assoc($consultaFav)){
        mysqli_free_result($consultaFav);
        $consultaFav = mysqli_query($conexao, $queryFav);
        while($regFav = mysqli_fetch_assoc($consultaFav)){
            echo "<div class='musica'>";
    
            if($regFav['ALBCAPA'] != null){
                echo   "<a href='../php/musicas.php?musicaid=". $regFav['MSCCODIGO'] ."'><img src='../images/". $regFav['ALBCAPA'] ."'/>";
            }
            else{
                echo   "<a href='../php/musicas.php?musicaid=". $regFav['MSCCODIGO'] ."'><img src='../images/placeholder-de-imagens.png'/>";
            }
            echo   "<label>" . $regFav['MSCNOME'] . "</label></a>";
            echo "<br/>";
            if ($regFav['BDSNOME'] == NULL){
                echo "<a href='cantor.php?artistaid=". $regFav['ARTCODIGO']."'><small>" . $regFav['ARTNOME'] . "</small></a>";
            }
            else{
                echo "<a href='banda.php?bandaid=". $regFav['BDSCODIGO']."'><small>" . $regFav['BDSNOME'] . "</small></a>";
            }
            echo "<div id='estrelas'>";
            
            $cont = 1;
            while ($cont <= 5) {
            if($cont <= round($regFav['CLSNOTA'])){
                echo  "<img class='star' id='star-". $cont ."-". $regFav['MSCCODIGO'] ."' src='../images/star1.webp' alt='star'/>";
            }
            else{
                echo  "<img class='star' id='star-". $cont ."-". $regFav['MSCCODIGO'] ."' src='../images/star0.webp' alt='star'/>";
            }
            $cont++;
            }
            echo "</div>";
            echo "</div>";
        }
    }
    else{
        echo "<h1 id='nenhumaMusica'>Curta alguma musica com 3 estrelas ou mais para encontra-lá em sua biblioteca.</h1>";
    }
    ?>
</body>

</html>