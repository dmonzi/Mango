/* Signup ----------------------------------------------*/

function validarContraseña() {
    let input, contraseña, longitud, mayuscula, hasNumero;

    longitud, mayuscula, hasNumero = false;
    input = document.getElementById('passwd');
    contraseña = input.value;

    // Comprobar longitud
    if (contraseña.lenght >= 8) {
        hasNumero = true;
    }

    // Ver mayus
    for (let i = 0; i < contraseña.lenght; i++) {
         
    }

    // Ver numero
    for (let i = 0; i < contraseña.lenght; i++) {
        
    }

}

function addPopUp(array){
    let popUpContainer, popUpContent;
    let divPopUp;
    for(let puntosTweet of array){
        //Aqui lo que hago es crear los elementos para cada post
        popUpContainer=document.createElement('div');
        popUpContainer.classList.add('popUp');
        popUpContent=document. createElement('p');
        popUpContent.textContent='Seguir a diego';
        popUpContainer.appendChild(popUpContent);
        puntosTweet.appendChild(popUpContainer);

        //Pongo a escucha del evento click a todos los elementos
        //con la clase ptos, que son los tres puntos que deben 
        //mostrar el menu que acabo de crear
        puntosTweet.addEventListener('click',(event)=>{
            event.target.classList.toggle('seleccionado');
            divPopUp=event.target.nextElementSibling;
            if(divPopUp.style.display=='block'){
                divPopUp.style.display='none';
            }else{
            divPopUp.style.display='block';
            }
        });
    }
}



window.addEventListener("DOMContentLoaded", (event) => {
    let puntos=document.getElementsByClassName('ptos');
    addPopUp(puntos);
});