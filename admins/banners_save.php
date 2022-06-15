<?php
    // banners_save.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $name = $_REQUEST['name'];

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];
    $string = explode(".", $file_n);
    $ext = $string[1];
    $dir = "../files/banners/";
    $file_encrypted = md5_file($file_tmp);

    if ($file_n != ''){  // If there's a name...
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
    }

    $sql = "INSERT INTO banners(name, file_n, file)
        VALUES('$name', '$file_n', '$file_encrypted')";
    
    $res = $con -> query($sql);
    
    header("Location: banners_list.php");
?>