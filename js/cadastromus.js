function escolha(){
    var select = document.getElementById("escolheInsercao");

    if(select.value == 0){
        document.getElementById("insercao00").style.cssText = "display: relative;";
    }
    else if(select.value == 1){
        document.getElementById("insercao01").style.cssText = "display: relative;";
    }       
    else if(select.value == 2){
        document.getElementById("insercao02").style.cssText = "display: relative;";
    }
    else if(select.value == 3){
        document.getElementById("insercao03").style.cssText = "display: relative;";
    }
    else if(select.value == 4){
        document.getElementById("insercao04").style.cssText = "display: relative;";
    }
    else if(select.value == 5){
        document.getElementById("insercao05").style.cssText = "display: relative;";
    }
    else if(select.value == 6){
        document.getElementById("insercao06").style.cssText = "display: relative;";
    }
    apagaResto(select.value);
}

function apagaResto(x){
    for(i = 0; i<=6; i++){
        if(i != x){
            document.getElementById("insercao0" + i).style.cssText = "display: none;";
        }
    }
}