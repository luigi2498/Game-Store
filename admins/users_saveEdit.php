<?php
    // users_saveEdit.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $second_name = $_REQUEST['second_name'];
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    $role = $_REQUEST['role'];
    $passEncrypted = md5($pass);

    $file_n = $_FILES['file1']['name'];
    $file_tmp = $_FILES['file1']['tmp_name'];

    if ($file_n != ''){  // If there's a name...
        $string = explode(".", $file_n);
        $ext = $string[1];
        $dir = "../files/users/";
        $file_encrypted = md5_file($file_tmp);
        $new_name = "$file_encrypted.$ext";
        copy($file_tmp, $dir.$new_name);
    }    

    if ($pass == '' && $file_n == ''){  // If there's not a change in password and file fields...
        $sql = "UPDATE users 
                SET name = '$name', second_name = '$second_name', mail = '$mail',  role = '$role' 
                WHERE id = $id";
    }

    else if ($file_n == ''){    // If there's not a change only in file's field...
        $sql = "UPDATE users
                SET name = '$name', second_name = '$second_name', mail = '$mail', pass = '$passEncrypted', role = '$role' 
                WHERE id = $id";
    }

    else{   // Change in all fields...
        $sql = "UPDATE users
                SET name = '$name', second_name = '$second_name', mail = '$mail', role = '$role', file_n = '$file_n', file = '$file_encrypted'
                WHERE id = $id";
    }
    
    $res = $con -> query($sql);

    // Audit info.
    session_start();
    $admin = $_SESSION['user'];
    date_default_timezone_set("America/Mexico_City");
    $date = date("d-m-Y");
    $time = date("h:i:sa");

    $sql = "INSERT INTO audit(user_name, statement, current_table, execution_date, execution_time)
    VALUES('$admin', 'UPDATE', 'users', '$date', '$time')";

    $res = $con -> query($sql);     // Audit statement.
    
    header("Location: users_list.php");
?>