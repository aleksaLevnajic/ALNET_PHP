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


    function updateRoleUser($dataRole, $nameRole){
        global $conn;

        try{
            $query="UPDATE roles SET role_name = :nameRole WHERE id_role=:dataRole";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);
            $send->bindParam(":dataRole", $dataRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataRole=$_POST['dataRole'];
        $nameRole=$_POST['nameRole'];

        $msg="";
        $code=200;
        
        $updateRoleUser=updateRoleUser($dataRole, $nameRole);
        if($updateRoleUser){
           $rolesUser=getAllFromTabel("roles");
           $msg=$rolesUser;
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
        header("location: 404Page.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>