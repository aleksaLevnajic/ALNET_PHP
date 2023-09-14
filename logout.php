<?php 
    session_start();
    include("config/pathRedirect.php");
    include("models/functions.php");

    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        //header('Location:../index.php');
        redirect($path."index.php");
    }
?>