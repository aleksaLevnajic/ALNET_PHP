<?php
     //include "functions.php";
     include "../config/connection.php";


     header('Content-Type: application/json');

     function getAllFromTabel($nameTabel){
        global $conn;

        try{
            $query="SELECT * FROM $nameTabel";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

     function updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu){
        global $conn;

        try{
            $query="UPDATE menu SET name_menu = :nameMenu, path_m = :hrefMenu, display = :showMenu WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":showMenu", $showMenu);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }
    //////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataMenu=$_POST['dataMenu'];
        $nameMenu=$_POST['nameMenu'];
        $hrefMenu=$_POST['hrefMenu'];
        $showMenu=$_POST['showMenu'];
        //$priorityMenu=$_POST['priorityMenu'];

        $msg="";
        $code=200;
        
        $updateMenu=updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu);
        
        if($updateMenu){
           $menu=getAllFromTabel("menu");
           $msg=$menu;
           $code=200;
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