<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    print("<p>Se ha cerrado sesión correctamente, para volver al inicio pulse <a href='../index.php'>aquí</a></p>");
    header("Location: ../index.php");
?>