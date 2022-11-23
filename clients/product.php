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
    <script>        
        function validate(){
            var amount = document.Form1.amount.value;
            var price = document.Form1.price.value;
            var total = amount * price;

            $('#total').val('$' + total);
        }

        function add_to_cart(){
            document.Form1.method='post';
            document.Form1.action='product_add_order.php';
            document.Form1.submit();
            // var amount = document.Form1.amount.value;
            // var stock = document.Form1.stock.value;

            // if (amount <= stock && amount > 0){
            //     document.Form1.method='post';
            //     document.Form1.action='product_add_order.php';
            //     document.Form1.submit();
            // }

            // else{
            //     $('#mensaje').html('Error: no puedes comprar esa cantidad...');
            //     setTimeout("$('#mensaje').html('');", 5000);
            // }
        }
    </script>
</head>
</html>

<?php
    require "../functions/connect.php";
    $con = connect();

    session_start();
    
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

    echo "
    <body>
        <header class='header'>
            <a href='index.php'>
                <img class='header__logo' src='../files/img/logo.png' alt='logotipo'>
            </a>
        </header>

        <nav class='navegacion'>
            <a class='navegacion__enlace' href='index.php'>Inicio</a>
            <a class='navegacion__enlace navegacion__enlace--activo' href='products.php'>Productos</a>
            <a class='navegacion__enlace' href='contact.php'>Contacto</a>
            <a class='navegacion__enlace' href='cart01.php'>Carrito</a>
        </nav>

        <main class='contenedor'>
            <h1>$name</h1>

            <div class='control'>
                <img class='control__imagen' src='../files/products/$new_name' alt='Imagen consola'>

                <div class='control__contenido'>
                    <p>$description</p>                    
                    <form class='formulario' name='Form1'>                                                                                                
                        <input class='formulario__campo' name='id' id='id' type='hidden' value='$id'>
                        <input class='formulario__campo' name='price' id='price' type='hidden' value='$price'>
                        <input class='formulario__campo' name='stock' id='stock' type='hidden' value='$stock'>
                        <input class='formulario__campo' type='number' name='amount' id='amount' placeholder='Cantidad' min='1' max='$stock' step='1' value='1' onclick='validate(); return false;'>
                        <input class='formulario__campo' name='total' id='total' type='text' readonly value='$price'>
                        <input class='formulario__submit' type='submit' onclick='add_to_cart(); return false;' value='Agregar al carrito'>                                           
                        <div class='mensaje' id='mensaje'></div>
                    </form>
                </div>
            </div>
        </main>

        <footer class='footer'>
            <p class='footer__texto'>
                Front-End Store (Andrés Aguilar) - Todos los derechos reservados 2022.
            </p>
        </footer>
    </body>";
?>