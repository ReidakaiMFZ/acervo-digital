<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/banda.css">
    <title>apresentação bandas</title>
</head>
<body>
    <div class="tudo">
    
        <header>

            <h3><a href="../php/">Inicio</a></h3>
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

<?php
        echo "<div class='conteiners'>";
        echo    "<h1>nome da banda</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam ea, doloremque quibusdam commodi dolorum eligendi deleniti facere asperiores. Distinctio et voluptas blanditiis aperiam. Odio tempore modi consequatur aliquam, saepe incidunt!</p>
        </div>

        <div class="conteiners">
            <ul>
                <li>Nome de banda:</li>
                <li>Inicío de banda:</li>
                <li>Fim da banda :</li>
            </ul>
        </div>
    
        <div class="tabelas">
            <table>
                <tr>
                    <th>
                        <h5>Integrantes</h5>
                    </th>
                <tr>
                    <td>fhdgfgdfgdgf</td>
                </tr> 
                <tr>
                    <td>uhfuheuifhds</td>
                </tr>
                <tr>
                    <td>gcyudgcdshchd</td>
                </tr>
                <tr>
                    <td>fbduhfidsjioafj</td>
                </tr>
            </table>

            <table>
                <th>
                    <h5>Instrumento</h5>
                </th>
                <tr>
                    <tr>
                        <td>fhdgfgdfgdgf</td>
                    </tr> 
                    <tr>
                        <td>uhfuheuifhds</td>
                    </tr>
                    <tr>
                        <td>gcyudgcdshchd</td>
                    </tr>
                    <tr>
                        <td>fbduhfidsjioafj</td>
                    </tr>
                </tr>
            </table>
            
            <table>
                <th>
                    <h5>Inicío de carreira</h5>
                </th>
                <tr>
                    <tr>
                        <td>fhdgfgdfgdgf</td>
                    </tr> 
                    <tr>
                        <td>uhfuheuifhds</td>
                    </tr>
                    <tr>
                        <td>gcyudgcdshchd</td>
                    </tr>
                    <tr>
                        <td>fbduhfidsjioafj</td>
                    </tr>
                </tr>
            </table>

            <table>
                <th>
                    <h5>Final de carreira</h5>
                </th>
                <tr>
                    <tr>
                        <td>fhdgfgdfgdgf</td>
                    </tr> 
                    <tr>
                        <td>uhfuheuifhds</td>
                    </tr>
                    <tr>
                        <td>gcyudgcdshchd</td>
                    </tr>
                    <tr>
                        <td>fbduhfidsjioafj</td>
                    </tr>
                </tr>
            </table>

        </div>
        <button>Sair</button>
    </div>";
?>
</body>
</html>