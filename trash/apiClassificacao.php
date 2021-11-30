<?php
$conexao = mysqli_connect("localhost", "root", "", "acervo");

$query = "SELECT CLSMUSICA musica, AVG(CLSNOTA) media FROM CLASSIFICACAO WHERE CLSMUSICA = " . $_GET['musicaid'];
$consulta = mysqli_query($conexao, $query);
$reg = mysqli_fetch_assoc($consulta);

echo json_encode($reg);
?>