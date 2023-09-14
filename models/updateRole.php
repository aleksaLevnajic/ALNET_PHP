<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function updateRole($dataUser, $role){
        global $conn;

        try{
            $query="UPDATE user SET id_role = :dataId WHERE id_user=:dataUser";
            $send=$conn->prepare($query);
            $send->bindParam(":dataId", $role);
            $send->bindParam(":dataUser", $dataUser);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataUser=$_POST['dataUser'];
        $role=$_POST['role'];

        $msg="";
        $code=200;
        
        $updateRole=updateRole($dataUser, $role);
        if($updateRole){
           $msg="You have successfully updated this users role!";
           $code=200;
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