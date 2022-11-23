<?php
    // code validation (products_code.php)
    require "../functions/connect.php";
    $con = connect();

    // Request variables.
    $code = $_REQUEST['code'];

    $sql = "SELECT * FROM products WHERE code = '$code'
            AND status = 1 AND deleted = 0";

    $res = $con -> query($sql);
    $row = mysqli_num_rows($res);

    if ($row == 0){
        echo 1;
    }

    else{
        echo 0;
    }
?>