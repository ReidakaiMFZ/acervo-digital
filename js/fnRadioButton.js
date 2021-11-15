function fnRadioButton(x){
    if(x == 1){
        document.getElementById("lblBanda").style.cssText = "display: inline-block";
        document.getElementById("lblArtista").style.cssText = "display: none";
        document.getElementById("txtArtista").value = "-1";
    }    
    else if(x == 2){
        document.getElementById("lblArtista").style.cssText = "display: inline-block";
        document.getElementById("lblBanda").style.cssText = "display: none";
        document.getElementById("txtBanda").value = "-1";
    }
}
function fnRadioButton2(x){
    if(x == 1){
        document.getElementById("lblMusBanda").style.cssText = "display: inline-block";
        document.getElementById("lblMusArtista").style.cssText = "display: none";
        document.getElementById("cmbArtista").value = "-1";
    }    
    else if(x == 2){
        document.getElementById("lblMusArtista").style.cssText = "display: inline-block";
        document.getElementById("lblMusBanda").style.cssText = "display: none";
        document.getElementById("cmbBanda").value = "-1";
    }
}
function fnInstrumento(x){
    if(x != -1){
        document.getElementById("lblInstrumento").style.cssText = "display: inline-block";
        document.getElementById("lblBandaFimArt").style.cssText = "display: inline-block";
        document.getElementById("lblBandaIniArt").style.cssText = "display: inline-block";
    }
    else if(x == -1){
        document.getElementById("lblInstrumento").style.cssText = "display: none";
        document.getElementById("lblBandaFimArt").style.cssText = "display: none";
        document.getElementById("lblBandaIniArt").style.cssText = "display: none";
        document.getElementById("lblInstrumento").value = "-1";
    }
}
// lblBandaFimArt
// lblBandaIniArt
