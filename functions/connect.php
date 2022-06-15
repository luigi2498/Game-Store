<?php
    // Ubicacion del achivo:
    // ./functions/connect.php
    define("HOST", 'localhost');
    define("USER_DB", 'root');
    define("PASS_DB", '');
    define("DB", 'client01');

    function connect(){
        $con = new mysqli(HOST, USER_DB, PASS_DB, DB);
        return $con;
    }
?>