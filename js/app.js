let hearts=document.getElementsByClassName('heart');
let menu=false;
/* Signup ----------------------------------------------*/

function validarContraseña() {
    let expresion, passwd, longitud, mayuscula, hasNumero, resultadoRegex;
    let passwdInput, spanPasswd, valorSpan;
    passwd=document.forms[0]['elements']['passwd']['value'];
    expresion=/(?=.*\w+)(?=.*\S+)/;
    // expresion=/^(?=.*\d+)$/;

    passwdInput = document.getElementById('passwd');
    
    resultadoRegex=expresion.test(passwd);
    console.log(resultadoRegex);

    spanPasswd=document.getElementById('alertPasswd');
    
    if(resultadoRegex){
        valorSpan='Contraseña Correcta';
        spanPasswd.style.color='green';
    }else{
        valorSpan='Contraseña Incorrecta';
        spanPasswd.style.color='red';
    }
    spanPasswd.textContent=valorSpan;
}

function addPopUp(array){
    let popUpContainer, popUpContent, popUpContentA;
    let divPopUp;
    for(let puntosTweet of array){
        //Aqui lo que hago es crear los elementos para cada post

        //Un div con la clase popUp que es el contenedor
        //popUpContainer=document.createElement('div');
        //popUpContainer.classList.add('popUp');

        //Un enlace que es el contenedor del texto
        //popUpContentA=document.createElement('a');
        //popUpContentA.setAttribute('href','#');

        //El texto en sí
        //popUpContent=document.createElement('p');
        //popUpContent.textContent='Seguir a @nom_usr';

        //Vamos metiendo en el orden correcto el p dentro del a y este a dentro del div
        //popUpContentA.appendChild(popUpContent);
        //popUpContainer.appendChild(popUpContentA);
        //puntosTweet.appendChild(popUpContainer);

        //Pongo a escucha del evento click a todos los elementos
        //con la clase ptos, que son los tres puntos que deben 
        //mostrar el menu que acabo de crear
        puntosTweet.addEventListener('click',function(event){
            /**
             * Al hacer click se pasa por parámetro el elemento que desencadena la accion
             * Por lo que nos quedamos con el siguiente elemento hermano dentro del contenedor del que ha desencadenado la accion (puntosTweet)
             * Dicho elemento es justo el que hemos creado antes, que está dentro del div con la clase 'ptos', por lo que es hermano del target que 
             * ha desencadenado la accion, que es el <i> de los tres puntos y ese es el elemento que muestro u oculto
            */
            divPopUp=event.target.nextElementSibling;
            if(divPopUp.style.display=='block'){
                divPopUp.style.display='none';
            }else{
                divPopUp.style.display='block';
            }
        });
    }
}

function like(heart){
    let cantidadLikes;
    heart.textContent.trim();
    /**Con el elemento pasado por parámetro se evalua las clases que tenga */
    //Si tiene la clase que le da el color negro se le quita esa clase y se le añade la que le da color rojo
    if(heart.classList.contains('heart-black')){
        heart.classList.toggle('heart-black');
        heart.classList.add('heart-red');
        heart.textContent++;
        /*Y si no tiene la clase que le da el color rojo si no que tiene la que le da el color negro
        se le quita la clase del color negro y se le añade la del color rojo*/
    }else if(heart.classList.contains('heart-red')){
        heart.classList.toggle('heart-red');
        heart.classList.add('heart-black');
        heart.textContent--;
    }
}

document.addEventListener("DOMContentLoaded", function(event){
    let puntos=document.getElementsByClassName('ptos');
    addPopUp(puntos);
});

for(heart of hearts){
    
    heart.addEventListener("click", function(event){
        /*por cada click que se haga se pasa por parámetro el elemento que ha desencadenado la acción
        y se llama a la función like*/

        like(event.target);
    });
    
}

function mostrarMenu() {
    let dropdown = document.getElementsByClassName('dropdown-menu');
    if (menu) {
        dropdown[0].style.display="none";
        menu = false;
    } else {
        dropdown[0].style.display="block";
        menu = true;
    }
}

function insertarDatos(idPost, idUsuario, ruta) {

    console.log(idPost+" "+idUsuario+" "+ ruta);
    
    $.ajax({
      url: ruta,
      method: 'POST',
      data: { idPost: idPost, idUsuario: idUsuario },
      success: function(response) {
        console.log(response);
        // Aquí puedes realizar acciones adicionales después de la inserción exitosa
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
        // Aquí puedes manejar los errores en caso de que ocurra algún problema durante la inserción
      }
    });
  }