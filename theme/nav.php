<?php 
    session_start();

    /*Añadir el boton del panel de administración*/
    function verAdmin(){
        if ($_SESSION['admin']) {
            echo '<a href="./admin/index.php" class="admin-btn"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
        }
    }

    echo'<nav>
            <ul id="list-nav">
                <li id="home-search">
                    <div><a href="../index.php"><i class="fa-solid fa-house"></i></a></div>
                    <div id="nav-search"><a href="./search.php"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                </li>
                <li><a href="#"><img src="../images/logo3.png" alt=""></a></li>
                <li id="last-li" class="user-profile">
                    <a id="menu" onclick="mostrarMenu()"><i class="fa-solid fa-user"></i></a>';
                        verAdmin();
                        echo'<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Ver perfil</a>
                        <a class="dropdown-item" href="settings.php"><i class="fas fa-cog"></i> Ajustes</a>
                        <a class="dropdown-item" href="../theme/cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                      </div>
                </li>
            </ul>
        </nav>';
?>