<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function search($valueS){
        global $conn;

        try{
            $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category INNER JOIN brand b ON p.id_brand=b.id_brand
             INNER JOIN price r ON p.id_price=r.id_price INNER JOIN picture pc ON p.id_picture=pc.id_picture
              WHERE p.name LIKE '%$valueS%' OR b.brand_name LIKE '%$valueS%'";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    /////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $valueS=$_POST['valueS'];
        $msg="";
        $code=200;
        
        $valueSearch=search($valueS);
        if($valueSearch){
           $msg=$valueSearch;
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