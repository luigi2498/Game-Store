<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Detalles de Administrador</title>    
    <!-- FIX -->
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
    <!-- FIX -->
</head>
</html>

<?php
    // admins_details.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM admins WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row['name'];
    $second_name = $row['second_name'];
    $mail = $row['mail'];
    $role = $row['role'];
    $status = $row['status'];
    $role_txt = ($role == 1) ? 'Gerente' : 'Ejecutivo';
    $status_txt = ($status == 1) ? 'Activo' : 'Inactivo';
    
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
                <a class='navegacion__enlace navegacion__enlace--activo' href='admins_list.php'>Administradores</a>
                <a class='navegacion__enlace' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "
        <table border='1'>
            <tr>
                <th colspan='5'><h2>Administradores > Detalles</h2></th>
            <tr>
                <td>Foto</td>
                <td>Nombre</td>
                <td>Correo</td>
                <td>Rol</td>
                <td>Estado</td>
            </tr>";

    echo "  <tr> <td>";
                if ($file_n != ''){
                    echo "<img src='../files/users/$new_name'>";
                }
                echo "
                </td>
                <td>$name $second_name</td>
                <td>$mail</td>
                <td>$role_txt</td>
                <td>$status_txt</td>
            </tr>
        </table><br><br>";

    echo "<a class='boton principal' href='admins_list.php' class='boton_regresar'>Regresar</a></body>";
?>