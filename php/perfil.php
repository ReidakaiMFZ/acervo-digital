<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false)
{
    header('location:../login.htm');
}

$conexao = mysqli_connect("localhost", "root", "", "acervo");
$query = mysqli_query($conexao, "SELECT USRCODIGO, USRNOME, USRLOGIN, USREMAIL
    FROM usuarios WHERE USRCODIGO = ". $_SESSION['USRCODIGO']);

if (isset($_GET['nomeperfil'])){
    mysqli_begin_transaction($conexao);
    try{
        $stmt = mysqli_prepare($conexao, "UPDATE usuarios SET USRNOME='". $_GET['nomeperfil'] ."' WHERE USRCODIGO = " . $_SESSION['USRCODIGO']);
        mysqli_stmt_execute($stmt);
        mysqli_commit($conexao);
    }
    catch (mysqli_sql_exception $exception){
        mysqli_rollback($conexao);
        throw $exception;
    }
}
$perfil = mysqli_fetch_assoc($query);
?>

<html lang="pt-br">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Acervo - Perfil</title>
</head>

<body>
  <header>
    <h3><a href="../php/">Inicio</a></h3>
    <h3><a href="#">Biblioteca</a></h3>
    <h3><a href="cadastromus.php">Cadastrar</a></h3>

    <form class="pesquisa" action="search.php" method="get">
      <input name="txtPesquisa" class="txtPesquisa" placeholder="Pesquisar..." />
      <button type="submit" class="btnPesquisa"></button>
    </form>

    <div class="perfil">
      <a href="#"><img src="../images/engrenagem.png"></a>
    </div>
  </header>
  <img id="headerperfil"src="../images/header-background.jpg" alt="">
  <form method="GET" id="perfilmain">
    <img id="fotoperfil" src="../images/unknown.ico" alt="" />
    <input type="text" id="nomeperfil" name="nomeperfil" value="<?php echo $perfil['USRNOME']?>"/>
  </form>

</body>
<?php
if(isset($_GET['nomeperfil']))
{
  echo "<script>window.location.search = '';</script>";
}
?>
</html>