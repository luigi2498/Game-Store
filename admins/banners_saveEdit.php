<?php
    // banners_saveEdit.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];

    if ($file_n != ''){  // If there's a file...
        $string = explode(".", $file_n);
        $ext = $string[1];
        $dir = "../files/banners/";
        $file_encrypted = md5_file($file_tmp);
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
        $sql = "UPDATE banners SET name = '$name', file_n = '$file_n', file = '$file_encrypted' WHERE id = $id";
    }    

    else{   // Change in all fields...
        $sql = "UPDATE banners SET name = '$name' WHERE id = $id";
    }
    
    $res = $con -> query($sql);
    
    header("Location: banners_list.php");
?>