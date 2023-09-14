<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function deleteMessage($idMessage){
        global $conn;
        
        try{
            $query="DELETE FROM messagecontact WHERE id_message=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $idMessage);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

     function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM messagecontact";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    //////

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $idMessage=$_POST['id'];
        $msg="";
        $code=200;
        
        $deleteMessage=deleteMessage($idMessage);
        
        if($deleteMessage){
           $messages=messagesReturn();
           $msg=$messages;
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