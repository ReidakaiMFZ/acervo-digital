<?php
session_start();
if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}
$conexao = mysqli_connect("192.168.0.12", "Aluno2DS", "SenhaBD2","ACERVO");

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
else if($_POST['TipoInsert'] == 2){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    
    if(isset($_POST["BDSDTTERMINO"])){
        mysqli_stmt_prepare($stmt, "INSERT INTO bandas(BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES  (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtBanda'], $_POST["txtDtInicioBnd"], $_POST["txtDtTerminoBnd"], $_POST["txtBandaApres"]);
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO bandas(BDSNOME, BDSDTINICIO, BDSAPRESENTACAO) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtBanda'], $_POST["txtDtInicioBnd"], $_POST["txtBandaApres"]);        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert'] == 3){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    mysqli_stmt_prepare($stmt, "INSERT INTO generos(GNRNOME, GNRDESCRICAO) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $_POST["txtGenero"], $_POST["txtGeneroApres"]);

    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert'] == 4){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    
    if(isset($_POST["txtFalenDt"])){
        mysqli_stmt_prepare($stmt, "INSERT INTO gravadoras(GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES  (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $_POST['txtGravadora'], $_POST["txtFundDt"], $_POST["txtFalenDt"]);
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO gravadoras(GRVNOME, GRVDTFUNDACAO) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $_POST['txtGravadora'], $_POST["txtFundDt"]);        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert' == 5]){
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    mysqli_stmt_prepare($stmt, "INSERT INTO instrumentos(INSNOME) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "s", $_POST['txtGravadora']);        
    
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert' == 6]){

}
header('Location: cadastromus.php?x='.$_POST['TipoInsert']);
?>