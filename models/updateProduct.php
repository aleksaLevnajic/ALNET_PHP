<?php
      //include "functions.php";
      include "../config/connection.php";


     header('Content-Type: application/json');

     function updateProduct($dataProducts, $nameProducts, $catValue, $description, $brand, $name){
        global $conn;

        try{
            $query="UPDATE product SET name = :nameProducts, description = :descriptionn, id_category = :catValue, id_brand = :brandValue, path=:name WHERE id_product=:dataProduct";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProducts", $nameProducts);
            //$send->bindParam(":name", $name);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":descriptionn", $description);
            $send->bindParam(":brand", $description);
            $send->bindParam(":dataProducts", $dataProducts);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message=$e->getMessage();
            echo $e->getMessage();
        } 
    }

    /////
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataProducts=$_POST['dataProducts'];
        $nameProducts=$_POST['nameProducts'];
        $catValue=$_POST['catValue'];
        $msg="";
        $code=200;
        $valid=true;
       
        if(empty($_FILES['filePicture'])){
            $name=$_POST['filePicture'];
        }
        else{
            $filePicture=$_FILES['filePicture'];
            $tmpName=$filePicture['tmp_name'];
            $type=$filePicture['type'];
            $name=$filePicture['name'];
            $src="../img/gallery/";
            $typeNew=explode("/", $type);

            if($typeNew[1]!="png" && $typeNew[1]!="jpg" && $typeNew[1]!="jpeg"){
                $valid=false;
            }
        }
        if($valid){
            $updateProduct=updateProduct($dataProducts, $nameProducts, $catValue, $delivery, $name);
        }
        
        if($updateProduct){
            if(!empty($_FILES['filePicture'])){
                $result=move_uploaded_file($tmpName, $src.$name);
            }
           $products=getProducts();
           $cat=getAllFromTabel("category");
           $arrayBack=([
                "products"=>$products,
                "cat"=>$cat,
                "msg"=>"You have you have successfully updated this row!"
           ]);
           $msg=$arrayBack;
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