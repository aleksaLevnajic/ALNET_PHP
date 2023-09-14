<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function insertMenu($nameMenu, $hrefMenu, $showMenu){
        global $conn;
        
        try{
            $query="INSERT INTO menu(id_menu, name_menu, path_m, display) VALUES(NULL, :nameMenu, :path_m, :display)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":path_m", $hrefMenu);
            $send->bindParam(":display", $showMenu);
            //$send->bindParam(":priorityMenu", $priorityMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    //////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameMenu=$_POST['nameMenu'];
        $hrefMenu=$_POST['hrefMenu'];
        $showMenu=$_POST['showMenu'];
        //$priorityMenu=$_POST['priorityMenu'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameMenu=="" || $hrefMenu=="" || $showMenu==""){
            $valid=false;
        }

        if($valid){
            $insertMenu=insertMenu($nameMenu, $hrefMenu, $showMenu);
        }

        if($insertMenu){
           $msg="You have successfully inserted one row in table menu!";
           $code=201;
        }
        else{
            $msg="Server error.";
            $code=500;
        }
    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("location: 404.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>