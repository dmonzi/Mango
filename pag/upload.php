<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/style-responsive.css">
        <link rel="icon" type="image/png" href="../images/logo.png">
        <title>Mango_upload</title>
    </head>
<body>
    <header>
        <!-- nav insertado con php -->
        <?php 
            include('../theme/nav.php')
        ?>
    </header>
    <main>
        <div class="principal">
            <h1>Crea tu nuevo post</h1>
            <form id="contenidoTweet" method="POST" action="../theme/guardarPost.php" enctype="multipart/form-data">
                <textarea name="contenido" cols="100" rows="10" placeholder="Escribe aquí!" require></textarea>
                <input type="submit" name="publicar" value="Publicar">
                <!-- <label for="foto-post">Añadir una imagen: </label> -->
                <!-- <input type="file" id="foto-post" name="foto" accept=".png, .jpeg, .jpg"> -->
            </form>
        </div>
    </main>
</body>
<script src="../js/app.js"></script>
<script src="../icons/fontawesome.js"></script>
</html>