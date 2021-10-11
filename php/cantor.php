<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../login.htm');
}

$conexao=mysqli_connect("localhost", "root", "", "acervo");

$intId = $_GET['artistaid'];
$consultaArtista = "SELECT ARTNOME,ARTDTINICIO,ARTDTTERMINO,ARTAPRESENTACAO FROM artistas WHERE ARTCODIGO = ".$intId;
$queryArtista = mysqli_query($conexao, $consultaArtista);

if($dados = mysqli_fetch_array($queryArtista))
{

}
else
{
    echo "<h1>Error 404</h1>";
    echo "<label>Not Found</label>";
    die();
}

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cantor.css">
    <title>Acervo - <?php echo $dados['ARTNOME']?></title>
</head>
<body>

<header>
<h3><a href="../php/">Inicio</a></h3>
<h3><a href="#">Biblioteca</a></h3>
<h3><a href="#">Cadastrar</a></h3>

<form class="pesquisa" action="search.php" method="get">
    <input type='text' name='txtPesquisa' class='txtPesquisa' placeholder='Pesquisar...'/>
    <button type="submit" class="btnPesquisa"></button>
  </form>

<div class="perfil">
  <img src="../images/unknown.ico">
  <h3>
    <a href="#">perfil</a>
  </h3>
</div>    
</header>
    
    <section>
        <h1><?php echo $dados["ARTNOME"];     ?></h1>
        <p> <?php echo $dados["ARTAPRESENTACAO"];     ?></p>
    </section>
    <div class="corpo">
        <ul>
            <li>Nome do cantor:<?php echo $dados["ARTNOME"];     ?></li>
            <li>Instrumento:<?php echo $dados["ARTNOME"];     ?></li>
            <?php
            $time = strtotime($dados['ARTDTINICIO']);
            $myFormatForView = date("d/M/Y", $time);

            echo "<li>Início de carreira: ". $myFormatForView ."</li>"; 

            $time2 = strtotime($dados['ARTDTTERMINO']);
            $myFormatForView2 = date("d/M/Y", $time2);

            echo "<li>Fim de carreira: ". $myFormatForView2 ."</li>";
            ?>
        </ul>
    </div>
    
</body>
</html>