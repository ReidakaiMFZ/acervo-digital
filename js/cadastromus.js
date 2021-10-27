var select = document.getElementById("escolheInsercao");

function escolha(){
    console.log(select.value);
    if(select.value == 0){
        document.getElementById("0").style.cssText = "display: relative;";
    }
    else if(select.value == 1){
        document.getElementById("1").style.cssText = "display: relative;";
    }       
    else if(select.value == 2){
        document.getElementById("2").style.cssText = "display: relative;";
    }
    else if(select.value == 3){
        document.getElementById("3").style.display = "relative";
    }
    else if(select.value == 4){
        document.getElementById("4").style.display = "relative";
    }
    else if(select.value == 5){
        document.getElementById("5").style.display = "relative";
    }
    else if(select.value == 6){
        document.getElementById("6").style.display = "relative";
    }
    apagaResto(select.value);
}
function apagaResto(x){
    for(i = 0; i < 7;  i++){
        if(select.value == x ){
            console.log("div "+x+" foi escolhida");
        }
        else{
            document.getElementById(i).style.cssText = "display: none;";
        }
    }
}