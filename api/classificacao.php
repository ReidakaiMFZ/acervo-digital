<?php
session_start();

if(isset($_SESSION['USRCODIGO']) == false){
  header('location:../pages/login.htm');
}
$conexao = mysqli_connect("localhost", "root", "", "ACERVO");
if(mysqli_connect_errno()){
  echo "<h1>Conexão falhou</h1>";
  die();
}

$queryUp = "SELECT CLSUSUARIO, CLSMUSICA FROM CLASSIFICACAO 
            WHERE CLSUSUARIO = ". (int)$_SESSION['USRCODIGO'] .
            " AND CLSMUSICA = ". (int)$_GET['txtMusicaId'];
$consultaUp = mysqli_query($conexao, $queryUp);


mysqli_begin_transaction($conexao);

if($regUp = mysqli_fetch_assoc($consultaUp)){
    mysqli_query($conexao, "UPDATE CLASSIFICACAO SET CLSNOTA = ". $_GET['txtClassificacao'] .
                " WHERE CLSUSUARIO = ". $regUp['CLSUSUARIO'] .
                " AND CLSMUSICA = ". $regUp['CLSMUSICA']
    );
}
else{
    $stmt = mysqli_stmt_init($conexao);
    mysqli_stmt_prepare($stmt, "INSERT INTO CLASSIFICACAO(CLSUSUARIO, CLSMUSICA, CLSNOTA) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iii",
        $_SESSION['USRCODIGO'],
        $_GET['txtMusicaId'],
        $_GET['txtClassificacao']
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
mysqli_commit($conexao);
mysqli_close($conexao);

header("location: ../php/musicas.php?musicaid=". $_GET['txtMusicaId'])
?>