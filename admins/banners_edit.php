<?php
    // banners_edit.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM banners WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row['name'];

    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'>
        <link rel='preload' href='../css/styles.css' as='style'>
        <link rel='stylesheet' href='../css/styles.css'>
        <title>Editar banner</title>
        <script src='../js/jquery-3.6.0.js'></script>
        <script>
            function validate(){     // Validate filled fields with JS.
                var name = document.Form1.name.value;

                if (name == ''){
                    $('#mensaje').html('Error: faltan campos por llenar...');
                    setTimeout(\"$('#mensaje').html('');\", 5000);
                }

                else{ 
                    document.Form1.method='post';
                    document.Form1.action='banners_saveEdit.php';
                    document.Form1.submit();
                }
            }
    
            function clearField(){     // Clear message's field.
                $('#mensaje').html('');
            }
        </script>
    </head>
    <!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->";

    echo "<body>
            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace' href='admins_list.php'>Usuarios</a>
                <a class='navegacion__enlace' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "<div>
            <form class='formulario' name='Form1' enctype='multipart/form-data'>
                <legend>Editar Banner</legend>
                <div class='campo'>
                    <label>Nombre: </label>
                    <input class='inputText' type='text' name='name' id='name' placeholder='Escribe el nombre' value='$name'>
                </div>
                <div class='campo'>
                    <label>Imagen: </label>
                    <input type='file' id='file1' name='file1'>
                </div>
                <input type='hidden' name='id' id='id' value='$id'>
                <div>
                    <label></label>
                    <input class='boton subir' type='submit' value='Guardar' class='boton_agregar' onclick='validate(); return false;'>
                </div>
                <div class='campo mensaje' id='mensaje'></div>
            </form></div><br>
            <br><a class='boton principal' href='banners_list.php' class='boton_regresar'>Regresar</a></body>
          </html>";
?>