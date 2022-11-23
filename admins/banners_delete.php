<?php
    // admins_delete.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];

    if ($id > 0){
        // $sql = "DELETE FROM admins WHERE id = $id";
        $sql = "UPDATE banners SET deleted = 1 WHERE id = $id";
        $res = $con -> query($sql);
    }

    header("Location: banners_list.php");
?>