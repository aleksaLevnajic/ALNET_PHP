<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function getSingleProduct($id)
    {
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture WHERE id_product=$id";
            $data=$conn->query($upit)->fetch();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }

    //////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_POST['valueId'];
        $msg="";
        $code=200;
        
        $productId=getSingleProduct($id);
        
        if($productId){
           $msg=$productId;
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