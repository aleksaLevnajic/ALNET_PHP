<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function insertCategory($nameCategory){
        global $conn;
        
        try{
            $query="INSERT INTO category(id_category, name_category) VALUES(NULL, :nameCategory)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    ///
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameCategory=$_POST['nameCategory'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameCategory==""){
            $valid=false;
        }

        if($valid){
            $insertCategory=insertCategory($nameCategory);
        }

        if($insertCategory){
           $msg="You have successfully inserted one row in table category!";
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