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

    function deleteMenu($dataMenu){
        global $conn;
        
        try{
            $query="DELETE FROM menu WHERE id_menu=:menu";
            $send=$conn->prepare($query);
            $send->bindParam(":menu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataMenu=$_POST['dataMenu'];
        $msg="";
        $code=200;
        
        $deleteMenu=deleteMenu($dataMenu);
        
        if($deleteMenu){
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