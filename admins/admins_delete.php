<?php
    // admins_delete.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];

    if ($id > 0){
        // $sql = "DELETE FROM admins WHERE id = $id";
        $sql = "UPDATE admins SET deleted = 1 WHERE id = $id";
        $res = $con -> query($sql);
    }

    header("Location: admins_list.php");
?>