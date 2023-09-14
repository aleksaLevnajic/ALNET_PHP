<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function insertRole($nameRole){
        global $conn;
        
        try{
            $query="INSERT INTO roles(id_role, role_name) VALUES(NULL, :nameRole)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameRole=$_POST['nameRole'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameRole==""){
            $valid=false;
        }

        if($valid){
            $insertRole=insertRole($nameRole);
        }

        if($insertRole){
           $msg="You have successfully inserted one row in table roles!";
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
        header("location: 404Page.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>