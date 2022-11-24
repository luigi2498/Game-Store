<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Usuarios</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function deleteAdmin(id) {
            if (confirm("¿Seguro que desea eliminar el registro?") == true){
                $.ajax({
                    url         : 'users_delete.php?id=' +id,
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
    // users_list.php
    require "../functions/connect.php";    // Include lib.

    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    $con = connect();
    $sql = "SELECT * FROM users WHERE status = 1 AND deleted = 0";
    $res = $con -> query($sql);

    echo "<nav class='navegacion'>
            <a class='navegacion__enlace' href='index.php'>Inicio</a>
            <a class='navegacion__enlace navegacion__enlace--activo' href='users_list.php'>Usuarios</a>
            <a class='navegacion__enlace' href='products_list.php'>Productos</a>
            <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
            <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
            <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
        </nav>";

    echo "<body><div><h3>Crear nuevo usuario: </h3><a class='boton principal' href=\"users_add.php\" class='boton_agregar'>AGREGAR</a><br><br>";

    echo "<table border='1'>
            <tr>
                <th colspan='7'><h2>Listado de usuarios</h2></th>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Correo</td>
                <td>Rol</td>
                <td>Eliminar</td>
                <td>Ver</td>
                <td>Editar</td>
            </tr>";

    while($row = $res -> fetch_array()){
        $id = $row["id"];
        $name = $row["name"];
        $second_name = $row["second_name"];
        $mail = $row["mail"];
        $role = $row["role"];
        $role_txt = ($role == 1) ? 'Administrador' : 'Proveedor';

        echo "<tr id='row$id'>
                <td>$id</td>
                <td>$name $second_name</td>
                <td>$mail</td>
                <td>$role_txt</td>
                <td><a class='boton eliminar' href=\"javascript:void(0);\" onclick=\"deleteAdmin($id);\">ELIMINAR</a><br></td>
                <td><a class='boton ver' href=\"users_details.php?id=$id\" class='boton_ver'>VER</a><br></td>
                <td><a class='boton editar' href=\"users_edit.php?id=$id\" class='boton_editar'>EDITAR</a><br></td>
              </tr>";
    }
    echo "</table></body>";
?>