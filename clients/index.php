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

    $sql = "SELECT * FROM products WHERE status = 1 AND deleted = 0 ORDER BY RAND() LIMIT 7";
    $res = $con -> query($sql);

    $sql2 = "SELECT * FROM banners WHERE status = 1 AND deleted = 0 ORDER BY RAND()";
    $res2 = $con -> query($sql2);

    echo "<body>
        <header class='header'>
            <a href='index.php'>
                <img class='header__logo' src='../files/img/logo.png' alt='logotipo'>
            </a>
        </header>

        <nav class='navegacion'>
            <a class='navegacion__enlace navegacion__enlace--activo' href='index.php'>Inicio</a>
            <a class='navegacion__enlace' href='products.php'>Productos</a>
            <a class='navegacion__enlace' href='contact.php'>Contacto</a>
            <a class='navegacion__enlace' href='cart01.php'>Carrito</a>
        </nav>

        <main class='contenedor'>
            <h1>Productos que te pueden interesar</h1>

            <div class='grid'>";

    while($row = $res -> fetch_array()){
        $id = $row["id"];
        $name = $row["name"];
        $description = $row["description"];
        $price = $row["price"];

        $file_n = $row['file_n'];           // Full file's name.
        $file_encrypted = $row['file'];     // Encrypted file's name.

        if ($file_n != ''){
            $string = explode(".", $file_n);    // Take file's extension.
            $ext = $string[1];                  // After the dot.
            $new_name = "$file_encrypted.$ext"; // Full string encrypted file's name.
        }
        
        echo "
                <div class='producto'>
                    <a href='product.php?id=$id'>
                        <img class='producto__imagen' src='../files/products/$new_name' alt='Imagen consola'>
                        <div class='producto__informacion'>
                            <p class='producto__nombre'>$name</p>
                            <p class='producto__precio'>$$price</p>
                        </div>
                    </a>
                </div> <!--.producto-->";
    }

    while($row2 = $res2 -> fetch_array()){
        $file_n = $row2['file_n'];           // Full file's name.
        $file_encrypted = $row2['file'];     // Encrypted file's name.

        if ($file_n != ''){
            $string = explode(".", $file_n);    // Take file's extension.
            $ext = $string[1];                  // After the dot.
            $new_name = "$file_encrypted.$ext"; // Full string encrypted file's name.
        }

        echo"
                <div class='grafico grafico--juegos' 
                    style=\"background-image: url('../files/banners/$new_name');\">
                </div> <!--.grafico-->";
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