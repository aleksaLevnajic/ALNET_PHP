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

    function getProducts(){
        global $conn;

        try{
            $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category 
            INNER JOIN brand b ON p.id_brand=b.id_brand INNER JOIN price r ON p.id_price=r.id_price 
            INNER JOIN picture pc ON p.id_picture=pc.id_picture ORDER BY p.id_product";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

     function delete($table, $column, $id){
        global $conn;
        
        try{
            $query="DELETE FROM $table WHERE $column=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }
    //////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataProduct=$_POST['dataProduct'];
        $msg="";
        $code=200;
        
        $deleteProduct=delete("product", "id_product", $dataProduct);
        
        if($deleteProduct){
           $products=getProducts();
           $cat=getAllFromTabel("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat
           ]);
           $msg=$arrayBack;
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