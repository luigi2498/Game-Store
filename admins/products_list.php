<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Productos</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function deleteProduct(id) {
            if (confirm("¿Seguro que desea eliminar el registro?") == true){
                $.ajax({
                    url         : 'products_delete.php?id=' +id,
                    type        : 'post',
                    dataType    : 'text',
                })
                alert('Registro ' + id + ' eliminado con exito.');
                $('#row' + id).hide();
            }

            else{
                alert("Registro no eliminado...");
            }            
        }
    </script>
</head>
</html>

<?php
    // admins_list.php
    require "../functions/connect.php";    // Include lib.

    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    $con = connect();
    $sql = "SELECT * FROM products WHERE status = 1 AND deleted = 0";
    $res = $con -> query($sql);

    echo "<nav class='navegacion'>
            <a class='navegacion__enlace' href='index.php'>Inicio</a>
            <a class='navegacion__enlace' href='admins_list.php'>Administradores</a>
            <a class='navegacion__enlace navegacion__enlace--activo' href='products_list.php'>Productos</a>
            <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
            <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
            <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
        </nav>";

    echo "<body><div><h3>Agregar un nuevo producto: </h3><a class='boton principal' href=\"products_add.php\" class='boton_agregar'>AGREGAR</a><br><br>";

    echo "<table border='1'>
            <tr>
                <th colspan='9'><h2>Listado de productos</h2></th>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Código</td>
                <td>Descripción</td>
                <td>Precio</td>
                <td>Stock</td>
                <td>Eliminar</td>
                <td>Ver</td>
                <td>Editar</td>
            </tr>";

    while($row = $res -> fetch_array()){
        $id = $row["id"];
        $name = $row["name"];
        $code = $row["code"];
        $description = $row["description"];
        $price = $row["price"];
        $stock = $row["stock"];

        echo "<tr id='row$id'>
                <td>$id</td>
                <td>$name</td>
                <td>$code</td>
                <td>$description</td>
                <td>$$price</td>
                <td>$stock</td>
                <td><a class='boton eliminar' href=\"javascript:void(0);\" onclick=\"deleteProduct($id);\">ELIMINAR</a><br></td>
                <td><a class='boton ver' href=\"products_details.php?id=$id\" class='boton_ver'>VER</a><br></td>
                <td><a class='boton editar' href=\"products_edit.php?id=$id\" class='boton_editar'>EDITAR</a><br></td>
              </tr>";
    }
    echo "</table></body>";
?>