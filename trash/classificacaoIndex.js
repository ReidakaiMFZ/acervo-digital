function mediaNota(x) {
    var dados = new XMLHttpRequest();
    dados.open("GET", "../api/apiClassificacao.php?musicaid=" + x);
    dados.send();
    dados.onload = () => {
        var rec = JSON.parse(dados.responseText);
        var cont = 1;
        while (cont <= 5) {
            if (cont <= Math.round(rec.media)) {
                document.getElementById("star-" + cont + "-" + x).src = "../images/star1.webp";
            } else {
                document.getElementById("star-" + cont + "-" + x).src = "../images/star0.webp";
            }
            cont++;
        }
    }
}