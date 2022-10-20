// Scroll up

document.getElementById("button-up").addEventListener("click", scrollUp);

function scrollUp(){

    var currentScroll = document.documentElement.scrollTop;

    if (currentScroll > 0){
        // window.requestAnimationFrame(scrollUp);
        window.scrollTo (0, 0);
    }
}


///

buttonUp = document.getElementById("button-up");

window.onscroll = function(){

    var scroll = document.documentElement.scrollTop;

    if (scroll > 500){
        buttonUp.style.transform = "scale(1)";
    }else if(scroll < 500){
        buttonUp.style.transform = "scale(0)";
    }

}



//Funcion select

// function seleccionarTipo(){
//     let tipoElemento = document.getElementById("tipoElemento");

//     let tipo = tipoElemento.value;

//     console.log(tipo);
    
// }

//