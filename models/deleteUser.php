<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function delete($table, $column, $id){
        global $conn;
        
        try{
            $query="DELETE FROM $table WHERE $column=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function usersAll(){
        global $conn;

        try{
            $query="SELECT * FROM user u INNER JOIN roles r ON u.id_role=r.id_role";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    /////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataUser=$_POST['dataUser'];
        $msg="";
        $code=200;
        
        $deleteUser=delete("user", "id_user", $dataUser);
        if($deleteUser){
           $user=usersAll();
           $msg=$user;
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