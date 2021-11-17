var a = "00:01:59";
var b = a.split(":");
var seg;

if(b[0] != "00"){
    seg = parseInt(b[0], 10)* 60;
    seg += parseInt(b[1], 10);
}
else{
    seg = parseInt(b[1], 10)* 60;
    seg += parseInt(b[2], 10);
}
document.getElementById("musicaProgresso").max = seg;
document.getElementById("maximo").textContent = b[1]+":"+b[2];

function atualizaMusica(){
    if(document.getElementById("musicaProgresso").max > document.getElementById("musicaProgresso").value){
        document.getElementById("musicaProgresso").value += 1;
    }
}
