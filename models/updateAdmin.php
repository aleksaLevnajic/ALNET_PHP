<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function updateAdmin($nameAdmin, $lastNameAdmin, $emailAdmin){
        global $conn;

        try{
            $query="UPDATE user SET firstName = :nameAdmin, lastName = :lastNameAdmin, email = :emailAdmin WHERE id_role=1";
            $send=$conn->prepare($query);
            $send->bindParam(":nameAdmin", $nameAdmin);
            $send->bindParam(":lastNameAdmin", $lastNameAdmin);
            $send->bindParam(":emailAdmin", $emailAdmin);
            
            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameAdmin=$_POST['nameAdmin'];
        $lastNameAdmin=$_POST['lastNameAdmin'];
        $emailAdmin=$_POST['emailAdmin'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameAdmin=="" || $lastNameAdmin=="" || $emailAdmin==""){
            $valid=false;
        }

        if($valid){
            $updateA=updateAdmin($nameAdmin, $lastNameAdmin, $emailAdmin);
        }

        if($updateA){
            $msg="You have successfully updated your profile!";
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