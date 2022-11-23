<?php
    // products_save.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $name = $_REQUEST['name'];
    $code = $_REQUEST['code'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];
    $stock = $_REQUEST['stock'];

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];
    $string = explode(".", $file_n);
    $ext = $string[1];
    $dir = "../files/products/";
    $file_encrypted = md5_file($file_tmp);

    if ($file_n != ''){  // If there's a name...
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
    }

    $sql = "INSERT INTO products(name, code, description, price, stock, file_n, file)
        VALUES('$name', '$code', '$description', '$price', '$stock', '$file_n', '$file_encrypted')";
    
    $res = $con -> query($sql);

    // Audit info.
    session_start();
    $admin = $_SESSION['user'];
    date_default_timezone_set("America/Mexico_City");
    $date = date("d-m-Y");
    $time = date("h:i:sa");

    $sql = "INSERT INTO audit(user_name, statement, current_table, execution_date, execution_time)
    VALUES('$admin', 'INSERT', 'products', '$date', '$time')";

    $res = $con -> query($sql);     // Audit statement.
    
    header("Location: products_list.php");
?>