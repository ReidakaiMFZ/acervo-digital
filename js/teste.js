const a = document.getElementById('maximo').textContent;
var b = a.split(":");
var seg;

var obj = document.getElementById("musicaProgresso");
var tmp;

var i = 0;
var i2 = 0;

if(b[0] != "00"){
    seg = parseInt(b[0], 10) * 60;
    seg += parseInt(b[1], 10);
    document.getElementById("maximo").textContent = b[0]+":"+b[1];
}
else{
    seg = parseInt(b[1], 10)* 60;
    seg += parseInt(b[2], 10);
    document.getElementById("maximo").textContent = b[1]+":"+b[2];
}
obj.max = seg;

function atualizaMusica(){
    if(obj.max > document.getElementById("musicaProgresso").value){
        obj.value += 1;
    }
}
function iniciar(){
    if(i == 0){
        tmp = setInterval(atualizaMusica, 1000);
        i = 1;
    }
    else{
        clearInterval(tmp);
        i = 0;
    }
}
function mostraLetras(){
    if(i2 == 0){
        document.getElementById("txtLetras").style.cssText = "display: absolute;";
        document.getElementById("txtLetras").style.cssText = "display: absolute;";
        i2 = 1;
    }
    else{
        document.getElementById("txtLetras").style.cssText = "display: none;";
        i2 = 0;
    }
}

