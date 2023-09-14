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

     function updateBrand($dataBrand, $nameBrand){
        global $conn;

        try{
            $query="UPDATE brand SET brand_name = :nameBrand WHERE id_brand=:dataBrand";
            $send=$conn->prepare($query);
            $send->bindParam(":nameBrand", $nameBrand);
            $send->bindParam(":dataBrand", $dataBrand);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataBrand=$_POST['dataArtist'];
        $nameBrand=$_POST['nameArtist'];

        $msg="";
        $code=200;
        
        $updateBrand=updateBrand($dataBrand, $nameBrand);
        if($updateBrand){
           $brands=getAllFromTabel("brand");
           $msg=$brands;
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