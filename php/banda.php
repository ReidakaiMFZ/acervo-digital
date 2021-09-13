<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "acervo");

$intId = $_GET['bandaid'];
$strBandas = "SELECT BDSNOME, ARTNOME, BDSDTINICIO, BDSDTTERMINO, ARTDTINICIO, ARTDTTERMINO, BDSAPRESENTACAO, INSNOME 
FROM bandas 
LEFT JOIN integrantes ON integrantes.ITGBANDA = BDSCODIGO
LEFT JOIN artistas ON artistas.ARTCODIGO = ITGARTISTA
LEFT JOIN instrumentos ON instrumentos.INSCODIGO = ITGINSTRUMENTO
WHERE BDSCODIGO = ".$intId.
" ORDER BY ARTNOME;" ;
$queryBanda  = mysqli_query($conexao, $strBandas);

$regBanda = mysqli_fetch_array($queryBanda);

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/banda.css">
    <title>Acervo - <?php echo $regBanda['BDSNOME'];?></title>
</head>
<body>
    <div class="tudo">
    
        <header>

            <h3><a href="index.php">Inicio</a></h3>
            <h3><a href="#">Biblioteca</a></h3>
            <h3><a href="#">Cadastrar</a></h3>
          
            <div class="pesquisa">
              <input id="txtPesquisa" type="search" class="txtPesquisa" placeholder="Pesquisar..." />
              <input type="image" class="btnPesquisa" src="../images/search-site-pw2.png" alt="">
            </div>
          
            <div class="perfil">
              <img src="../images/unknown.ico">
              <h3>
                <a href="#">perfil</a>
              </h3>
            </div>    
        </header>


        <div class='conteiners'>
        <?php
            echo "<h1>". $regBanda['BDSNOME'] ."</h1>";
            echo "<p>". $regBanda['BDSAPRESENTACAO'] ."</p>";
        ?>
        </div>

        <div class="conteiners">
            <ul>
            <?php
                $time = strtotime($regBanda['BDSDTINICIO']);
                $myFormatForView = date("d/M/Y", $time);
                echo "<li>Nome de banda: ". $regBanda['BDSNOME'] ."</li>";
                echo "<li>Inicío de banda: ". $myFormatForView ."</li>";
                if($regBanda['BDSDTTERMINO'] != null)
                {
                    $time = strtotime($regBanda['BDSDTTERMINO']);
                    $myFormatForView = date("d/M/Y", $time);
                    echo "<li>Fim da banda: ". $myFormatForView ."</li>";
                }
                else
                {
                    echo "<li>Fim da banda: Não acabou</li>";
                }
            ?>    
            </ul>
        </div>
    
        <div class="tabelas">
            <table>
                
                <th>
                    <h5>Integrantes</h5>
                </th>
                <?php
                mysqli_free_result($queryBanda);
                $queryBanda  = mysqli_query($conexao, $strBandas);
                while ($contadorBandas = mysqli_fetch_assoc($queryBanda))
                {
                    echo "<tr>";
                    echo     "<td>". $contadorBandas['ARTNOME'] ."</td>";
                    echo "</tr>"; 
                }
                mysqli_free_result($queryBanda);
                $queryBanda  = mysqli_query($conexao, $strBandas);
                ?>
                
            </table>

            <table>
                <th>
                    <h5>Instrumento</h5>
                </th>
                
                <?php
                while ($contadorBandas = mysqli_fetch_assoc($queryBanda))
                {
                    echo "<tr>";
                    echo     "<td>". $contadorBandas['INSNOME'] ."</td>";
                    echo "</tr>"; 
                }
                mysqli_free_result($queryBanda);
                $queryBanda  = mysqli_query($conexao, $strBandas);
                ?>

            </table>
            
            <table>
                <th>
                    <h5>Inicío de carreira</h5>
                </th>
        
                <?php
                while ($contadorBandas = mysqli_fetch_assoc($queryBanda))
                {
                    $time = strtotime($contadorBandas['ARTDTINICIO']);
                    $myFormatForView = date("d/M/Y", $time);
                    echo "<tr>";
                    echo     "<td>". $myFormatForView ."</td>";
                    echo "</tr>"; 
                }
                mysqli_free_result($queryBanda);
                $queryBanda  = mysqli_query($conexao, $strBandas);
                ?>
                
            </table>

            <table>
                <th>
                    <h5>Final de carreira</h5>
                </th>
                
                <?php
                while ($contadorBandas = mysqli_fetch_assoc($queryBanda))
                {
                    if($contadorBandas['ARTDTTERMINO'] != null)
                    {
                        $time = strtotime($contadorBandas['ARTDTTERMINO']);
                        $myFormatForView = date("d/M/Y", $time);
                        echo "<tr>";
                        echo     "<td>". $myFormatForView ."</td>";
                        echo "</tr>";
                    }
                    else 
                    {
                        echo "<tr>";
                        echo     "<td>Não finalizou</td>";
                        echo "</tr>";
                    }
                }
                mysqli_free_result($queryBanda);
                mysqli_close($conexao);
                ?> 
            </table>

        </div>
        <div class="espaco"></div>
    </div>

</body>
</html>