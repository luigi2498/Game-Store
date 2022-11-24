<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Detalles de Producto</title>    
    <!-- FIX -->
    <style>
        img {
            width: 200px;
            height: 200px;
        }
    </style>
    <!-- FIX -->
</head>
</html>

<?php
    // products_details.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM products WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row["name"];
    $code = $row["code"];
    $description = $row["description"];
    $price = $row["price"];
    $stock = $row["stock"];
    
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
                <a class='navegacion__enlace' href='users_list.php'>Usuarios</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "
        <table border='1'>
            <tr>
                <th colspan='6'><h2>Productos > Detalles</h2></th>
            <tr>
                <td>Imagen</td>
                <td>Nombre</td>
                <td>Código</td>
                <td>Descripción</td>
                <td>Precio</td>
                <td>Stock</td>
            </tr>";

    echo "  <tr> <td>";
                if ($file_n != ''){
                    echo "<img src='../files/products/$new_name'>";
                }
                echo "
                <td>$name</td>
                <td>$code</td>
                <td>$description</td>
                <td>$price</td>
                <td>$stock</td>
            </tr>
        </table><br><br>";

    echo "<a class='boton principal' href='products_list.php' class='boton_regresar'>Regresar</a></body>";
?>