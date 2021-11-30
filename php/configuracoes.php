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
$query = mysqli_query($conexao, 
   "SELECT USRCODIGO, USRNOME, USRLOGIN, USREMAIL, USRSENHA
    FROM USUARIOS 
    WHERE USRCODIGO = ". $_SESSION['USRCODIGO']
);
$perfil = mysqli_fetch_assoc($query);

if(isset($_GET['a'])){
    session_destroy();
    header("location: ../pages/login.htm");
}
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/configuracao.css">
    <link rel="icon" type="image/x-icon" href="../images/logo-etec.png">
    <title>Acervo - Configurações</title>
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
        <div id='conta'>
            <h2>Conta</h2>
            <?php echo "<span>email: ". $perfil['USREMAIL'] ."</span>";?>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
        </div>
        <div id="lorem">
            <h2>Lorem ipsum</h2>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
        </div>
        <div id="ipsum">
            <h2>Lorem ipsum</h2>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
            <span>Lorem ipsum</span>
        </div>
        <form action="configuracoes.php" method="get">
            <input type="hidden" name="a" value='1'/>
            <button>Sair</button>
        </form>
    </main>
</body>

</html>