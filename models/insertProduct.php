<?php
     include "functions.php";

     header('Content-Type: application/json');

     function insertProduct($nameProduct, $descProduct, $priceValue, $catValue, $brandValue, $pictureValue, $priceValue){
        global $conn;
        
        try{
               
            $query="INSERT INTO product(id_product, name, description, id_category, id_brand, id_picture, id_price) VALUES(NULL, :nameProduct, :descr, :catValue, :brandVal, :picVal, :priceVal)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProduct", $nameProduct);
            $send->bindParam(":descr", $descProduct);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":brandVal", $brandValue);
            $send->bindParam(":picVal", $pictureValue);
            $send->bindParam(":priceVal", $priceValue);

            $result=$send->execute();
            if($result){
                $lastID=$conn->lastInsertId();
                $queryPrice="INSERT INTO price(price_now, id_products) VALUES(:priceProduct, :lastID)";
                $sendPrice=$conn->prepare($queryPrice);
                $sendPrice->bindParam(":priceProduct", $priceProduct);
                $sendPrice->bindParam(":lastID", $lastID);
                $result=$sendPrice->execute();
            }
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
            echo $e->getMessage();
        }
    }

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $nameProduct=$_POST['nameProduct'];
        $descProduct=$_POST['descProduct'];
        $catValue=$_POST['catValue'];
        $brandValue=$_POST['brandValue'];
        $priceValue=$_POST['priceValue']
        $filePicture=$_FILES['filePicture'];
        $tmpName=$filePicture['tmp_name'];
        $type=$filePicture['type'];
        $name=$filePicture['name'];
        $src="../images/";
        $typeNew=explode("/", $type);
        $msg="";
        $code=200;
        $valid=true;

        if($typeNew[1]!="png" && $typeNew[1]!="jpg" && $typeNew[1]!="jpeg"){
            $valid=false;
        }

        if($nameProduct=="" || $descProduct=="" || $catValue=="0" || $brandValue=="0" || $priceValue=="0"){
            $valid=false;     
        }

        if($valid){
            try{
                //$lastID=$conn->lastInsertId();
                $pathEx = explode("/", $src);
                $path = $pathEx[1]."/".$name;
                $queryPrice="INSERT INTO picture(path, alt) VALUES(:pathh, :alt)";
                $sendPrice=$conn->prepare($queryPrice);
                $sendPrice->bindParam(":pathh", $path);
                $sendPrice->bindParam(":alt", "Nova slika proizvoda");
                $result=$sendPrice->execute();

            }
            catch(PDOException $e){
                $message="Server error";
                echo $e->getMessage();
            }

            $insertProduct=insertProduct($nameProduct, $descProduct, $priceValue, $catValue, $brandValue, $pictureValue, $priceValue);
        }

        if($insertProduct){
            $result=move_uploaded_file($tmpName, $src.$name);
            if($result){
                $msg="You have successfully inserted one row in table products!";
                $code=201;
            }
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