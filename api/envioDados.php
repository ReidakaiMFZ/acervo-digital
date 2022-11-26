<?php
session_start();
include '../php/config.php';
if(isset($_SESSION['USRCODIGO']) == false)
{
  header('location:../pages/login.htm');
}
if(mysqli_connect_errno()){
  header("location: cadastromus.php");
}

if($_POST['TipoInsert'] == 0){ //Album
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    if($_FILES['inpCapa']['name'] != ""){
        $nome = pathinfo($_FILES['inpCapa']['name'], PATHINFO_FILENAME) . date("Ymd", time()) . "." . pathinfo($_FILES['inpCapa']['name'], PATHINFO_EXTENSION);
    }
    else{
        $nome = NULL;
    }
    $txtGravadora = $_POST["txtGravadora"] != -1 ? $_POST["txtGravadora"] : null;
    $txtGenero = $_POST["txtGenero"] != -1 ? $_POST["txtGenero"] : null;

    if($_POST["txtAlbum"] == ""){header('Location: ../php/cadastromus.php?s=0&error=1'); die();}
    else if($_POST["txtMidia"] == ""){header('Location: ../php/cadastromus.php?s=0&error=2'); die();}

    if($_POST["txtBanda"] != -1){
        mysqli_stmt_prepare($stmt, "INSERT INTO albuns(ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBBANDA, ALBMIDIA, ALBCAPA) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siisiis", 
            $_POST["txtAlbum"], 
            $txtGravadora,
            $txtGenero,
            $_POST["inpData"],
            $_POST["txtBanda"],
            $_POST["txtMidia"],
            $nome
        );
    }
    else if($_POST["txtArtista"] != -1){
        mysqli_stmt_prepare($stmt, "INSERT INTO albuns(ALBNOME, ALBGRAVADORA, ALBGENERO, ALBDTLANCAMENTO, ALBARTISTA, ALBMIDIA, ALBCAPA) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siisiis", 
            $_POST["txtAlbum"], 
            $txtGravadora, 
            $txtGenero, 
            $_POST["inpData"], 
            $_POST["txtArtista"], 
            $_POST["txtMidia"],
            $nome
        );
    }
    if($nome != null){
        move_uploaded_file($_FILES['inpCapa']['tmp_name'], "../images/".$nome);
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

}
else if($_POST['TipoInsert'] == 1){ //Artistas
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    if($_POST['txtArtista']){header("location: ../php/cadastromus.php?s=1&errors=1"); die();}
    else if($_POST['txtDtInicioArt']){header("location: ../php/cadastromus.php?s=1&errors=2"); die();}
    else if($_POST['txtArtistaApres']){header("location: ../php/cadastromus.php?s=1&errors=3"); die();}

    if($_POST["txtDtInicioArt"] != ""){
        mysqli_stmt_prepare($stmt, "INSERT INTO artistas(ARTNOME, ARTDTINICIO, ARTDTTERMINO, ARTAPRESENTACAO) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", 
            $_POST['txtArtista'], 
            $_POST["txtDtInicioArt"], 
            $_POST["txtDtTerminoArt"], 
            $_POST["txtArtistaApres"]
        );
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO artistas(ARTNOME, ARTDTINICIO, ARTAPRESENTACAO) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", 
            $_POST['txtArtista'], 
            $_POST["txtDtInicioArt"], 
            $_POST["txtArtistaApres"]
        );        
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($_POST['cmbArtBanda'] != -1){
        $stmt2 = mysqli_stmt_init($conexao);

        $query = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT MAX(ARTCODIGO) maximo FROM ARTISTAS"));

        if($_POST["txtBandaFimArt"] != ""){
            mysqli_stmt_prepare($stmt2, "INSERT INTO INTEGRANTES(ITGBANDA, ITGARTISTA, ITGDTINICIO, ITGDTTERMINO, ITGINSTRUMENTO) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "iissi", 
                $_POST['cmbArtBanda'],
                $query['maximo'],
                $_POST['txtBandaIniArt'],
                $_POST['txtBandaFimArt'],
                $_POST['cmbInstrumento']
            );
        }
        else{
            mysqli_stmt_prepare($stmt2, "INSERT INTO INTEGRANTES(ITGBANDA, ITGARTISTA, ITGDTINICIO, ITGINSTRUMENTO) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "iisi", 
                $_POST['cmbArtBanda'],
                $query['maximo'],
                $_POST['txtBandaIniArt'],
                $_POST['cmbInstrumento']
            );
        }
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }

    mysqli_commit($conexao);
    mysqli_close($conexao);


}
else if($_POST['TipoInsert'] == 2){ //bandas
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    if($_POST['txtBanda'] == ""){header('location: ../php/cadastromus.php?s=2&errors=1'); die();}
    else if($_POST['txtDtInicioBnd'] == ""){header('location: ../php/cadastromus.php?s=2&errors=2'); die();}
    else if($_POST['txtBandaApres'] == ""){header('location: ../php/cadastromus.php?s=2&errors=3'); die();}

    if($_POST["txtDtTerminoBnd"] != ""){
        mysqli_stmt_prepare($stmt, "INSERT INTO bandas(BDSNOME, BDSDTINICIO, BDSDTTERMINO, BDSAPRESENTACAO) VALUES  (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", 
            $_POST['txtBanda'], 
            $_POST["txtDtInicioBnd"], 
            $_POST["txtDtTerminoBnd"], 
            $_POST["txtBandaApres"]
        );
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO bandas(BDSNOME, BDSDTINICIO, BDSAPRESENTACAO) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", 
            $_POST['txtBanda'], 
            $_POST["txtDtInicioBnd"], 
            $_POST["txtBandaApres"]
        );        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert'] == 3){ //generos
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    if($_POST['txtGenero'] == ""){header('location: ../php/cadastromus.php?s=3&errors=1'); die();}
    else if($_POST['txtGeneroApres'] == ""){header('location: ../php/cadastromus.php?s=3&errors=2'); die();}

    mysqli_stmt_prepare($stmt, "INSERT INTO generos(GNRNOME, GNRDESCRICAO) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", 
        $_POST["txtGenero"], 
        $_POST["txtGeneroApres"]
    );

    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert'] == 4){ //gravadoras
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);
    
    if($_POST['txtGravadora'] == ""){header('location: ../php/cadastromus.php?s=4&errors=1'); die();}
    else if($_POST['txtFundDt'] == ""){header('location: ../php/cadastromus.php?s=4&errors=2'); die();}

    if($_POST["txtFalenDt"] != ""){
        mysqli_stmt_prepare($stmt, "INSERT INTO gravadoras(GRVNOME, GRVDTFUNDACAO, GRVDTFALENCIA) VALUES  (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", 
            $_POST['txtGravadora'], 
            $_POST["txtFundDt"], 
            $_POST["txtFalenDt"]
        );
    }
    else{
        mysqli_stmt_prepare($stmt, "INSERT INTO gravadoras(GRVNOME, GRVDTFUNDACAO) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", 
            $_POST['txtGravadora'], 
            $_POST["txtFundDt"]
        );        
    }
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert']== 5){ //instrumentos
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    if($_POST['txtInstrumento'] != ""){
        mysqli_stmt_prepare($stmt, "INSERT INTO instrumentos(INSNOME) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $_POST['txtInstrumento']);
    }
    else{
        header('location: ../php/cadastromus.php?s=5&errors=1');
        die();
    }
    
    mysqli_stmt_execute($stmt);
    mysqli_commit($conexao);

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
}
else if($_POST['TipoInsert']== 6){ //Musicas
    mysqli_begin_transaction($conexao);
    $stmt = mysqli_stmt_init($conexao);

    if($_POST['txtMusica'] == ""){
        header('location: ../php/cadastromus.php?s=6&errors=1');
        die();
    }
    else if($_POST['txtTempoMus'] == ""){
        header('location: ../php/cadastromus.php?s=6&errors=2');
        die();
    }
    else if($_POST['cmbGenero'] == "-1"){
        header('location: ../php/cadastromus.php?s=6&errors=3');
        die();
    }
    else if($_POST['txtUrlMusica'] == ""){
        header('location: ../php/cadastromus.php?s=6&errors=4');
        die();
    }
    else if($_POST['txtUrlSomMusica'] == ""){
        header('location: ../php/cadastromus.php?s=6&errors=5');
        die();
    }
    else if($_POST['txtLetraMus'] == ""){
        header('location: ../php/cadastromus.php?s=6&errors=7');
        die();
    }
    

    if($_POST['cmbArtista'] != -1){
        if(isset($_POST['txtLetraMus'])){
            mysqli_stmt_prepare($stmt, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCARTISTA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiisss", 
                $_POST['txtMusica'],
                $_POST['txtTempoMus'],
                $_POST['cmbGenero'],
                $_POST['cmbArtista'],
                $_POST['txtLetraMus'],
                $_POST['txtUrlMusica'],
                $_POST['txtUrlSomMusica']
            );
        }
        else{
            mysqli_stmt_prepare($stmt, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCARTISTA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiiss", 
                $_POST['txtMusica'],
                $_POST['txtTempoMus'],
                $_POST['cmbGenero'],
                $_POST['cmbArtista'],
                $_POST['txtUrlMusica'],
                $_POST['txtUrlSomMusica']
            );
        }
    }
    else if($_POST['cmbBanda'] != -1){
        if(isset($_POST['txtLetraMus'])){
            mysqli_stmt_prepare($stmt, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCLETRA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiisss", 
                $_POST['txtMusica'],
                $_POST['txtTempoMus'],
                $_POST['cmbGenero'],
                $_POST['cmbBanda'],
                $_POST['txtLetraMus'],
                $_POST['txtUrlMusica'],
                $_POST['txtUrlSomMusica']
            );
        }
        else{
            mysqli_stmt_prepare($stmt, "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO, MSCGENERO, MSCBANDA, MSCVIDEO, MSCAUDIO) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiiss", 
                $_POST['txtMusica'],
                $_POST['txtTempoMus'],
                $_POST['cmbGenero'],
                $_POST['cmbBanda'],
                $_POST['txtUrlMusica'],
                $_POST['txtUrlSomMusica']
            );
        }
    }
    else{
        header('location: ../php/cadastromus.php?s=6&errors=6');
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($_POST['cmbAlbumMus'] != -1){
        $stmt2 = mysqli_stmt_init($conexao);
        $posicao = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT MAX(FXSPOSICAO) posicao FROM FAIXAS WHERE FXSALBUM = ". (int)$_POST['cmbAlbumMus']));
        $pos = $posicao['posicao']+1;
        $w = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT MAX(MSCCODIGO) codigo FROM MUSICAS"));

        mysqli_stmt_prepare($stmt2, "INSERT INTO faixas(FXSALBUM, FXSMUSICA, FXSPOSICAO) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt2, "iii", 
            $_POST['cmbAlbumMus'], 
            $w['codigo'], 
            $pos
        );

        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
    
    mysqli_commit($conexao);
    mysqli_close($conexao);
}
else{
    header('Location: ../php/cadastromus.php');
    die();
}

header('Location: ../php/cadastromus.php?s=' . (int)$_POST['TipoInsert']);
?>
