<?php
    // admins_saveEdit.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $code = $_REQUEST['code'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];
    $stock = $_REQUEST['stock'];

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];

    if ($file_n != ''){  // If there's a name...
        $string = explode(".", $file_n);
        $ext = $string[1];
        $dir = "../files/products/";
        $file_encrypted = md5_file($file_tmp);
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
    }    

    if ($file_n == ''){    // If there's not a change only in file's field...
        $sql = "UPDATE products
                SET name = '$name', code = '$code', description = '$description', price = '$price', stock = '$stock'
                WHERE id = $id";
    }

    else{   // Change in all fields...
        $sql = "UPDATE products
                SET name = '$name', code = '$code', description = '$description', price = '$price', stock = '$stock', file_n = '$file_n', file = '$file_encrypted'
                WHERE id = $id";
    }
    
    $res = $con -> query($sql);
    
    header("Location: products_list.php");
?>