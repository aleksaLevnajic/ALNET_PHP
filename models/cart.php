<?php
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['id'];
        echo("$id");
    }


?>
