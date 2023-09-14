<?php
     include "../config/connection.php";

     header('Content-Type: application/json');
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $idUser=$_POST['idUser'];
        $msg="";
        $code=200;
        $valid=true;
        $insertUser=insertUser($idUser);
        if($insertUser){
            for($i=0; $i<count($_POST)-1; $i++){
                $quantity=$_POST['cart'.$i]['quantity'];
                $idProducts=$_POST['cart'.$i]['id'];
                $insertToCart=insertToCart($insertUser, $quantity, $idProducts);
                if($insertToCart==false){
                    $code=500;
                }
                else{
                    $msg="Thank you for supporting us.";
                    $code=201;
                }
            }
        }
    http_response_code($code);
    echo json_encode($msg);
    }
    else{
        header("location: 404Page.php");
        $code=404;
        $msg="Page not found.";
    }
    

        //KORPA

        function insertUser($idUser){
            global $conn;
            
            try{
                $query="INSERT INTO finishshopping(id_finishshop, id_user) VALUES(NULL, :idUser)";
                $send=$conn->prepare($query);
                $send->bindParam(":idUser", $idUser);
    
                $result=$send->execute();
                if($result){
                    $lastId=$conn->lastInsertId();
                    return $lastId;
                }
                else{
                    return $result;
                }
               
            }
            catch(PDOException $e){
                $message="Server error";
            }
        }
    
    
        function insertToCart($insertUser, $quantity, $idProducts){
            global $conn;
            
            try{
                $query="INSERT INTO cart(id_cart, id_finishshop, id_product, quantity) VALUES(NULL, :insertUser, :idProducts, :quantity)";
                $send=$conn->prepare($query);
                $send->bindParam(":insertUser", $insertUser);
                $send->bindParam(":idProducts", $idProducts);
                $send->bindParam(":quantity", $quantity);
    
    
                $result=$send->execute();
                return $result;
            }
            catch(PDOException $e){
                $message="Server error";
            }
        }
?>