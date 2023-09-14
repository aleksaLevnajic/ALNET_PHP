<?php

    if(isset($_POST['btn']))
    {
        $msg = "Suc";
        echo json_encode($msg);
        //header("Location: index.php");
    }

?>