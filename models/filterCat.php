<?php
     //include "functions.php";
     include "../config/connection.php";

     header('Content-Type: application/json');

     function filterCat($id){
        global $conn;

        try{
            $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category
            INNER JOIN brand b ON p.id_brand=b.id_brand INNER JOIN price pr ON p.id_price=pr.id_price WHERE c.id_category=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->execute();
            $result=$send->fetchAll();
            return $result;

        }
        catch(PDOException $e){
            $message="Server error";
        }
    
    }

    ////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['value'])
        {
            $id=$_POST['value'];
            $msg="";
            $code=200;
            $valueCat=filterCat($id);
            //var_dump($valueCat);
            if($valueCat){
            $msg=$valueCat;
            $code=200;
            //var_dump($code);
            }
            else{
                $msg="Server error!!!";
                $code=500;
            }
        } 
        else{
            $msg="No value";
            $code=500;
        }       
        
    http_response_code($code);
    echo json_encode($msg);
    //var_dump($msg);
    }
    else{
        header("location: 404.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>