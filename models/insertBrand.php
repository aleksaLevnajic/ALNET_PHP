<?php
      //include "functions.php";
      include "../config/connection.php";

     header('Content-Type: application/json');

     function insertBrand($nameBrand){
        global $conn;
        
        try{
            $query="INSERT INTO brand(id_brand, brand_name) VALUES(NULL, :nameBrand)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameBrand", $nameBrand);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameBrand=$_POST['nameArtist'];
        $msg="";
        $code=200;
        $valid=true;

        if($nameBrand==""){
            $valid=false;
        }

        if($valid){
            $insertBrand=insertBrand($nameBrand);
        }

        if($insertBrand){
           $msg="You have successfully inserted one row in table brands!";
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