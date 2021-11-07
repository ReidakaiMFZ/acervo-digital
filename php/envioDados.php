<?php
session_start();
if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../login.htm');
}
$conexao = mysqli_connect("localhost", "root", "", "ACERVO");

if($_POST['TipoInsert'] == 0){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    
    if(isset($_POST["txtBanda"])){
        mysqli_stmt_prepare($stmt, "INSERT INTO albuns(ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siisii", $_POST["txtAlbum"], $_POST["txtGravadora"], $_POST["txtGenero"], $_POST["inpData"], $_POST["txtBanda"], $_POST["txtMidia"]);
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO albuns(ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siisii", $_POST["txtAlbum"], $_POST["txtGravadora"], $_POST["txtGenero"], $_POST["inpData"], $_POST["txtArtista"], $_POST["txtMidia"]);        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

}
else if($_POST['TipoInsert'] == 1){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    
    if(isset($_POST["ARTDTTERMINO"])){
        mysqli_stmt_prepare($stmt, "INSERT INTO artistas(ARTNOME, ARTDTINICIO, ARTDTTERMINO, ARTAPRESENTACAO) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtArtista'], $_POST["txtDtInicioArt"], $_POST["txtDtTerminoArt"], $_POST["txtArtistaApres"]);
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO artistas(ARTNOME, ARTDTINICIO, ARTAPRESENTACAO) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtArtista'], $_POST["txtDtInicioArt"], $_POST["txtArtistaApres"]);        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

}
header('Location: cadastromus.php');
?>