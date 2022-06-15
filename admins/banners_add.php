<?php
    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Alta de Banners</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function validate(){     // Validate filled fields with JS.
            var name = document.Form1.name.value;
            var file = document.Form1.file1.value;

            if (name == "" || file == ""){
                $('#mensaje').html('Error: faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            }

            else{ 
                document.Form1.method='post';
                document.Form1.action='banners_save.php';
                document.Form1.submit();
            }
        }

        function clearField(){     // Clear message's field.
            $('#mensaje').html('');
        }
    </script>
</head>
<!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->
<body>
    <nav class="navegacion">
        <a class="navegacion__enlace" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="admins_list.php">Administradores</a>
        <a class="navegacion__enlace" href="products_list.php">Productos</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="banners_list.php">Banners</a>
        <a class='navegacion__enlace' href="orders_list.php">Pedidos</a>
        <a class="navegacion__enlace" href="logout.php">Cerrar sesión</a>
    </nav>

    <br><br>

    <div>
        <form class="formulario" name="Form1" enctype="multipart/form-data">
            <legend>Alta de banners</legend>
            <div class="campo">
                <label>Nombre: </label>
                <input class="inputText" type="text" name="name" id="name" placeholder="Escribe el nombre">
            </div>
            <div class="campo">
                <label>Imagen: </label>
                <input type="file" id="file1" name="file1">
            </div>
            <div>
                <label></label>
                <input class="boton subir" type="submit" value="Guardar" class="boton_agregar" onclick="validate(); return false;">
            </div>
            <div class="campo mensaje" id="mensaje"></div>
        </form>
    </div>
    <br><a class="boton principal" href="banners_list.php">Regresar</a>
</body>

<footer>

</footer>
</html>