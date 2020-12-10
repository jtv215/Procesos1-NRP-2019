"use strict";


try{
    var cover = document.getElementById("cover");
    var cover_title = document.getElementById("cover-title");
} catch(err) {
    // pues ná
}

try{
    var divsEnemistados = document.getElementsByClassName("endiv");
} catch(err) {
    // pues ná
}

try{
    var manualConfig = false;
    var esfIndicator = document.getElementById("esf-indicator");
    var confirmButton = document.getElementsByClassName("confirm")[0];
    var plan = document.getElementsByClassName("plan")[0];
    var planRows = document.getElementsByClassName("plan-row");
    var selR = document.getElementById("selR");
    var desR = document.getElementById("desR");
    var selM = [];
    var desM = [];

    for (let index = 0; index < planRows.length; index++) {
        desM[index] = planRows[index].children[1].innerHTML;
    };

    selR.value = JSON.stringify([]);
    desR.value = JSON.stringify(desM);
    
} catch(err) {
    // nada
}

setTimeout(
    function(){
        try{
            cover_title.style.opacity = 0;
        } catch (err) {
            // bueno
        }
    },
    1200
);


setTimeout(
    function(){
        try {
            cover.style.height = 0;
            cover.style.zIndex = -3;
        } catch (err) {
            // uh
        }
    },
    2400
);


// FUNCTIONS
// =========
function showDiv(shown, hidden){
    divsEnemistados[shown].style.display = "none";
    divsEnemistados[hidden].style.display = "block";
}


function moveUp(row){
    if (row == 0) {
        return;
    }

    planRows[row].firstElementChild.firstElementChild.setAttribute( "onClick", "moveUp("+(row-1)+");" );
    planRows[row-1].firstElementChild.firstElementChild.setAttribute( "onClick", "moveUp("+(row)+");" );
    planRows[row].firstElementChild.children[1].setAttribute( "onClick", "moveDown("+(row-1)+");" );
    planRows[row-1].firstElementChild.children[1].setAttribute( "onClick", "moveDown("+(row)+");" );
    
    var tempClass = planRows[row].getAttribute("class");
    planRows[row].setAttribute("class", planRows[row-1].getAttribute("class"));
    planRows[row-1].setAttribute("class", tempClass);

    planRows[row].children[6].innerHTML = 
    planRows[row].getAttribute("class") == "plan-row" ? 
        "<i class='fas fa-times-circle' onclick='toggleInc("+(row-1)+")'></i>" :
        "<i class='fas fa-check-circle' onclick='toggleInc("+(row-1)+")'></i>";
    planRows[row-1].children[6].innerHTML = 
    planRows[row-1].getAttribute("class") == "plan-row" ? 
        "<i class='fas fa-times-circle' onclick='toggleInc("+(row)+")'></i>" :
        "<i class='fas fa-check-circle' onclick='toggleInc("+(row)+")'></i>";

    var copy = planRows[row].innerHTML;
    planRows[row].innerHTML = planRows[row-1].innerHTML;
    planRows[row-1].innerHTML = copy;
}


function moveDown(row){
    console.log(esfIndicator.innerHTML);

    if (row == (planRows.length -1)) {
        return;
    }

    planRows[row].firstElementChild.children[1].setAttribute("onClick", "moveDown("+(row+1)+");");
    planRows[row+1].firstElementChild.children[1].setAttribute("onClick", "moveDown("+(row)+");");
    planRows[row].firstElementChild.firstElementChild.setAttribute("onClick", "moveUp("+(row+1)+");");
    planRows[row+1].firstElementChild.firstElementChild.setAttribute("onClick", "moveUp("+(row)+");");

    var tempClass = planRows[row].getAttribute("class");
    planRows[row].setAttribute("class", planRows[row+1].getAttribute("class"));
    planRows[row+1].setAttribute("class", tempClass);
    
    planRows[row].children[6].innerHTML = 
        planRows[row].getAttribute("class") == "plan-row" ? 
        "<i class='fas fa-times-circle' onclick='toggleInc("+(row+1)+")'></i>" :
        "<i class='fas fa-check-circle' onclick='toggleInc("+(row+1)+")'></i>";
    planRows[row+1].children[6].innerHTML = 
        planRows[row+1].getAttribute("class") == "plan-row" ? 
        "<i class='fas fa-times-circle' onclick='toggleInc("+(row)+")'></i>" :
        "<i class='fas fa-check-circle' onclick='toggleInc("+(row)+")'></i>";

    var copy = planRows[row].innerHTML;
    planRows[row].innerHTML = planRows[row+1].innerHTML;
    planRows[row+1].innerHTML = copy;
}


function manualToggleInc(row){
    manualConfig = true;
    toggleInc(row);
}

function toggleInc(row){
    planRows[row].children[6].innerHTML = 
        planRows[row].getAttribute("class") == "plan-row" ? 
        "<i class='fas fa-check-circle' onclick='toggleInc("+row+")'></i>" : 
        "<i class='fas fa-times-circle' onclick='toggleInc("+row+")'></i>";
    planRows[row].setAttribute("class", planRows[row].getAttribute("class") == "plan-row" ? "plan-row req-excluido" : "plan-row");
    
    if (planRows[row].getAttribute("class") == "plan-row") { // seleccionando
        esfIndicator.innerHTML = Number(esfIndicator.innerHTML) - Number(planRows[row].children[4].innerHTML);
                
        if(manualConfig){
            var counter = 0;
            var id = planRows[row].children[1].innerHTML;
            var desMCopia = desM.slice();
            desM = [];
            
            for (let index = 0; index < desMCopia.length; index++) {
                if ( id != desMCopia[index]){
                    desM[counter] = desMCopia[index];
                    counter++;
                }
            }
            
            selM[selM.length] = id; // ese req lo dejamos como seleccionado
        }
    } else { // deseleccionando
        esfIndicator.innerHTML = Number(esfIndicator.innerHTML) + Number(planRows[row].children[4].innerHTML);
        
        if(manualConfig){
            var counter = 0;
            var id = planRows[row].children[1].innerHTML;
            var selMCopia = selM.slice();
            selM = [];
            
            for (let index = 0; index < selMCopia.length; index++) {
                if ( id != selMCopia[index]){
                    selM[counter] = selMCopia[index];
                    counter++;
                }
            }
            
            desM[desM.length] = id; // ese req lo dejamos como deseleccionado
        }
    }

    if (Number(esfIndicator.innerHTML) < 0) {
        esfIndicator.parentElement.parentElement.style.backgroundColor = "#FA4251";
        confirmButton.disabled = true;
    } else {
        esfIndicator.parentElement.parentElement.style.backgroundColor = "#6c7ae0";
        confirmButton.disabled = false;
    }

    if(manualConfig){
        selR.value = JSON.stringify(selM);
        desR.value = JSON.stringify(desM);
    }
}

function unSelectAll(){
    for (let index = 0; index < planRows.length; index++) {
        if (planRows[index].getAttribute("class") == "plan-row") {
            toggleInc(index);
        }
    }
}

function autoPlan(){
    unSelectAll();
    manualConfig = false;
    
    selR.value = JSON.stringify(seleccionados);
    desR.value = JSON.stringify(deseleccionados);

    for (let index = 0; index < seleccionados.length; index++) {
        for (let index2 = 0; index2 < planRows.length; index2++) {
            if(planRows[index2].children[1].innerHTML == seleccionados[index]){
                toggleInc(index2);
            }
        }
    }
}