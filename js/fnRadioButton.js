function fnRadioButton(x){
    if(x == 1){
        document.getElementById("lblBanda").style.cssText = "display: inline-block";
        document.getElementById("lblArtista").style.cssText = "display: none";
    }    
    else if(x == 2){
        document.getElementById("lblArtista").style.cssText = "display: inline-block";
        document.getElementById("lblBanda").style.cssText = "display: none";
    }
}
