<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <!-- FIX -->
    <!-- <style>
        img {
            width: 600px;
            height: 200px;
        }
    </style> -->
    <!-- FIX -->
    <title>Detalles de Producto</title>
</head>
</html>

<?php
    // banners_details.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM banners WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row["name"];
    
    $file_n = $row['file_n'];           // Full file's name.
    $file_encrypted = $row['file'];     // Encrypted file's name.

    if ($file_n != ''){
        $string = explode(".", $file_n);    // Take file's extension.
        $ext = $string[1];                  // After the dot.
        $new_name = "$file_encrypted.$ext"; // Full string encrypted file's name.
    }

    echo "<body>
            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace' href='admins_list.php'>Administradores</a>
                <a class='navegacion__enlace' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "
        <table border='1'>
            <tr>
                <th colspan='2'><h2>Banners > Detalles</h2></th>
            <tr>
                <td>Imagen</td>
                <td>Nombre</td>
            </tr>";

    echo "  <tr> <td>";
                if ($file_n != ''){
                    echo "<img src='../files/banners/$new_name'>";
                }
                echo "
                <td>$name</td>
            </tr>
        </table><br><br>";

    echo "<a class='boton principal' href='banners_list.php' class='boton_regresar'>Regresar</a></body>";
?>