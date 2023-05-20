let resultados = document.getElementsByClassName('busqueda');
let input = document.getElementById("buscador");

function filtro() {
    busqueda = input['value'];

    if (busqueda == "") {
        for (let i = 0; i < resultados.length; i++) {
            resultados[i].style.display = "none";
        }
    } else {
        for (let i = 0; i < resultados.length; i++) {
            if (resultados[i]['text'].includes(busqueda)) {
                resultados[i].style.display = "block";
            }else{
                resultados[i].style.display = "none";
            }
        }
    }
    
}