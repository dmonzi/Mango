
let li, a, i;

let user={
    name:"pipo",
    username:"popiopo",
    email:"pipo@gmail.com",
    password:"123123",
    pfp:"./images/cafe.jpg",
    admin: true
}

window.addEventListener("DOMContentLoaded", verAdmin);

/**
 * Comprobar si el usuario que ha iniciado sesión es admin, y si lo es, añadir un botón para acceder al panel
 * @param none
 * @returns none
 */

function verAdmin() {
    if (user.admin) {
        li = document.getElementById('last-li');

        a = document.createElement('a');
        i = document.createElement('i');

        // <i class="fa-solid fa-screwdriver-wrench"></i>
        i.classList.add('fa-solid', 'fa-screwdriver-wrench');
        a.setAttribute('href', 'admin.html');
        a.classList.add('admin-btn');

        a.appendChild(i);
        li.appendChild(a);
    }
}

function vaciarArea() {
    document.forms[0]['elements'][1]['value']="";
}
