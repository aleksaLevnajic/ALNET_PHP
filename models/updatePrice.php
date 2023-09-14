<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function updatePrice($dataPrice, $price){
        global $conn;

        try{
            $query="UPDATE price SET price = :price WHERE id_price=:dataPrice";
            $send=$conn->prepare($query);
            $send->bindParam(":price", $price);
            $send->bindParam(":dataPrice", $dataPrice);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataPrice=$_POST['dataPrice'];
        $price=$_POST['priceOld'];

        $msg="";
        $code=200;
        
        $updatePrice=updatePrice($dataPrice, $price);
        if($updatePrice){
           $msg="You have successfully updated this row!";
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