<?php
    // save.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $name = $_REQUEST['name'];
    $second_name = $_REQUEST['second_name'];
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    $role = $_REQUEST['rol'];
    $passEncrypted = md5($pass);

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];
    $string = explode(".", $file_n);
    $ext = $string[1];
    $dir = "../files/users/";
    $file_encrypted = md5_file($file_tmp);

    if ($file_n != ''){  // If there's a name...
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
    }

    $sql = "INSERT INTO admins(name, second_name, mail, pass, role, file_n, file)
        VALUES('$name', '$second_name', '$mail', '$passEncrypted', '$role', '$file_n', '$file_encrypted')";
    
    $res = $con -> query($sql);
    
    header("Location: admins_list.php");
?>