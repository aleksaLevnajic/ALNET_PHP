<?php
     //include "functions.php";
     include("../config/connection.php");

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='GET'){
        $msg="";
        $code=200;
        
        function getProducts(){
            global $conn;
            try{
                $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
                 JOIN picture pi ON pi.id_picture = p.id_picture JOIN brand b ON p.id_brand = b.id_brand";
                $data=$conn->query($upit)->fetchAll();
                return $data;
                
            }
            catch(PDOException $e){
                $data="Error";
                $code=500;
            }
        }
        

        $products=getProducts();
        //var_dump($products);
        if($products){
           $msg=$products;
           $code=200;
        }
        else{
           $msg="Server error";
           $code=500;
        }
    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("Location: 404.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>