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
    <title>Detalles de Pedido</title>
</head>
</html>

<?php
    // banners_details.php
    require "../functions/connect.php";
    $con = connect();
    
    // orders table
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM orders WHERE id = $id";
    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $date = $row["date"];
    $user = $row["user"];
    $status = $row["status"];
    $status_txt = ($status == 0) ? 'Abierto' : 'Cerrado';

    // orders_products table
    $sql2 = "SELECT * FROM orders_products WHERE id_order = $id";
    $res2 = $con -> query($sql2);
    $total = 0;

    echo "<body>
            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace' href='admins_list.php'>Usuarios</a>
                <a class='navegacion__enlace' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "
        <table border='1'>
            <tr>
                <th colspan='5'><h2>Pedidos > Detalles</h2></th>
            <tr>
                <td>ID Producto</td>
                <td>Nombre</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Subtotal</td>
            </tr>";

    while ($row2 = $res2 -> fetch_assoc()){
        $id_op = $row2['id'];               // orders_products
        $id_order = $row2['id_order'];      // orders_products
        $id_product = $row2['id_product'];  // orders_products
        $amount = $row2['amount'];          // orders_products
        $price = $row2['price'];            // orders_products

        $sql3 = "SELECT * FROM products WHERE id = $id_product AND status = 1 AND deleted = 0";
        $res3 = $con -> query($sql3);
        
        $row3 = $res3 -> fetch_array();

        $id_order_product = $row3["id"];    // products
        $name_product = $row3["name"];      // products
        $price_product = $row3["price"];    // products
        $stock = $row3["stock"];            // products

        $subtotal = $amount * $price_product;   // subtotal
        $total = $total + $subtotal;
        
        echo "  <tr>
                    <td>$id_product</td>
                    <td>$name_product</td>
                    <td>$amount</td>
                    <td>$price_product</td>
                    <td>$$subtotal</td>                    
                </tr>";
    }
    echo "<tr>
            <td colspan='4'>Total: </td>
            <td>$$total</td>
          </tr>";

    echo "  </table><br><br>
        <a class='boton principal' href='orders_list.php' class='boton_regresar'>Regresar</a></body>";
?>