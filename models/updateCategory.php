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

    function updateCategory($dataCategory, $nameCategory){
        global $conn;

        try{
            $query="UPDATE category SET name_category = :nameCategory WHERE id_category=:dataCategory";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);
            $send->bindParam(":dataCategory", $dataCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    /////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataCategory=$_POST['dataCategory'];
        $nameCategory=$_POST['nameCategory'];

        $msg="";
        $code=200;
        
        $updateCategory=updateCategory($dataCategory, $nameCategory);
        if($updateCategory){
           $category=getAllFromTabel("category");
           $msg=$category;
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