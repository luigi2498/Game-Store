<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../css/normalize.css" as="style">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/stylesClient.css" as="style">
    <link rel="stylesheet" href="../css/stylesClient.css">
    <title>FrontEnd Store</title>
    <link rel="icon" type="image/png" href="../files/img/alien.png"/>
    <script src="../js/jquery-3.6.0.js"></script>    
</head>
</html>

<?php
    require "../functions/connect.php";    // Include lib.
    $con = connect();

    session_start();

    $user = session_id();

    $sql = "SELECT * FROM orders WHERE status = 0 AND user = '$user'";
    $res = $con -> query($sql);
    $row = $res -> fetch_array();
    $emptyRow = mysqli_num_rows($res);

    echo "<body>
            <header class='header'>
                <a href='index.php'>
                    <img class='header__logo' src='../files/img/logo.png' alt='logotipo'>
                </a>
            </header>

            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace' href='products.php'>Productos</a>
                <a class='navegacion__enlace' href='contact.php'>Contacto</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='#'>Carrito</a>
            </nav>

            <main class='contenedor'>";                

    if ($emptyRow == 0){    // If the cart is empty...
        echo "<h1>¡Oops! Aún no hay productos en tu carrito.</h1>";
    }    

    else{       // If there's an active session and an unclosed order...

        $id = $row['id'];           // orders
        $date = $row['date'];       // orders
        $status = $row['status'];   // orders

        $total = 0;     // total

        $sql2 = "SELECT * FROM orders_products WHERE id_order = $id";
        $res2 = $con -> query($sql2);

        echo "<div class='grid'>
            <div><table border='1'>
                <tr>
                    <th colspan='5'><h1>Tus productos en carrito</h1></th>
                <tr>
                    <td class='navegacion__enlace--activo'>Producto</td>
                    <td class='navegacion__enlace--activo'>Precio</td>
                    <td class='navegacion__enlace--activo'>Cantidad</td>
                    <td class='navegacion__enlace--activo'>Subtotal</td>
                    <td class='navegacion__enlace--activo'>Eliminar</td>
                </tr>";

        while($row2 = $res2 -> fetch_array()){
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

            echo "<tr>
                    <td><a class='navegacion__enlace' href='product.php?id=$id_order_product'>$name_product</a></td>
                    <td>$price_product</td>
                    <td><a class='navegacion__enlace' href='decrement_item.php?id=$id_order_product&amount=$amount'>-</a>$amount<a class='navegacion__enlace' href='increment_item.php?id=$id_order_product&amount=$amount&stock=$stock'>+</a></td>
                    <td>$subtotal</td>
                    <td><a class='navegacion__enlace' href='delete_cart.php?id=$id_order_product'>Eliminar</a></td>
                </tr>";
        }

        echo "<tr>
                    <td colspan='3'>Total</td>
                    <td colspan='2'>$total</td>
                </tr>
               <tr>
                    <td colspan='3'></td>
                    <td colspan='2'><a class='navegacion__enlace boton__final' href='cart02.php'>Continuar</a></td>
                </tr>
            </table></div>";
    }

    echo"                
            </div>
        </main>

        <footer class='footer'>
            <p class='footer__texto'>
                Front-End Store (Andrés Aguilar) - Todos los derechos reservados 2022.
            </p>
        </footer>
    </body>";
?>