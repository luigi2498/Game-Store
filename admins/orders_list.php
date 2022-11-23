<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Pedidos</title>
    <script src="../js/jquery-3.6.0.js"></script>
</head>
</html>

<?php
    // orders_list.php
    require "../functions/connect.php";    // Include lib.

    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    $con = connect();
    $sql = "SELECT * FROM orders WHERE status = 1";
    $res = $con -> query($sql);

    echo "<nav class='navegacion'>
            <a class='navegacion__enlace' href='index.php'>Inicio</a>
            <a class='navegacion__enlace' href='admins_list.php'>Usuarios</a>
            <a class='navegacion__enlace' href='products_list.php'>Productos</a>
            <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
            <a class='navegacion__enlace navegacion__enlace--activo' href='orders_list.php'>Pedidos</a>
            <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
        </nav>";

    echo "<body><div>
            <p></p>
            <table border='1'>
            <tr>
                <th colspan='5'><h2>Listado de pedidos cerrados</h2></th>
            <tr>
                <td>ID</td>
                <td>Fecha</td>
                <td>Usuario</td>
                <td>Estado</td>
                <td>Ver</td>
            </tr>";

    while($row = $res -> fetch_array()){
        $id = $row["id"];
        $date = $row["date"];
        $user = $row["user"];
        $status = $row["status"];
        $status_txt = ($status == 0) ? 'Abierto' : 'Cerrado';

        echo "<tr id='row$id'>
                <td>$id</td>
                <td>$date</td>
                <td>$user</td>
                <td>$status_txt</td>
                <td><a class='boton ver' href=\"orders_details.php?id=$id\" class='boton_ver'>VER</a><br></td>
              </tr>";
    }
    echo "</table></body>";
?>