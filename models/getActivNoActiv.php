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
     if(isset($_GET['button'])){

        $msg="";
        $code=200;
        
        $getSurvey=getAllFromTabel("survey");
        if($getSurvey){
           $msg=$getSurvey;
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