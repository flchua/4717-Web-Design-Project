//Control section fold/unfold
function foldMeat() {
    var x = document.getElementById("meat");
    var y = document.getElementById("btnMeat");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
        console.log("if y="+y.value);
    } 
    else {
        x.style.display = "none";
        y.value = "+";
        console.log("else y="+y.value);
    }
}
function foldVege() {
    var x = document.getElementById("vege");
    var y = document.getElementById("btnVege");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
    } 
    else {
        x.style.display = "none";
        y.value = "+";
    }
}
function foldAlcohol() {
    var x = document.getElementById("alcohol");
    var y = document.getElementById("btnAlcohol");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
    } 
    else {
        x.style.display = "none";
        y.value = "+";
    }
}
function foldTea() {
    var x = document.getElementById("tea");
    var y = document.getElementById("btnTea");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
    } 
    else {
        x.style.display = "none";
        y.value = "+";
    }
}
function foldHot() {
    var x = document.getElementById("hot");
    var y = document.getElementById("btnHot");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
    } 
    else {
        x.style.display = "none";
        y.value = "+";
    }
}
function foldCold() {
    var x = document.getElementById("cold");
    var y = document.getElementById("btnCold");
    if (x.style.display === "none") {
        x.style.display = "block";
        y.value = "-";
    } 
    else {
        x.style.display = "none";
        y.value = "+";
    }	
}

