<?php
   //include("../config/connection.php");
   //include "config/connection.php";
   //config/connection.php

   function redirect($path)
    {
        header("Location: $path");
    }
    
    function getSingleProduct($id)
    {
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture WHERE id_product=$id";
            $data=$conn->query($upit)->fetchAll();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getProducts(){
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture";
            $data=$conn->query($upit)->fetchAll();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getCategories()
    {
        global $conn;
        try{
            $upit = "SELECT * FROM category";
            $data = $conn->query($upit)->fetchAll();
            return $data;
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getBrands()
    {
        global $conn;
        try{
            $upit = "SELECT * FROM brand";
            $data = $conn->query($upit)->fetchAll();
            return $data;
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }



    //ANKETA
    function surveyQuestion(){
        global $conn;
        try{
            $upit="SELECT * FROM survey WHERE active=1";
            $result=$conn->query($upit)->fetchAll();
            //var_dump($result);
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function surveyAnswer(){
        global $conn;
        try{
            $upit="SELECT * FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey";
            $result=$conn->query($upit)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function alreadyAnswered($id, $user){
        global $conn;

        try{
            $upit="SELECT * FROM surveyvotes v INNER JOIN answer a ON v.id_answer=a.id_answer WHERE v.id_user=:user AND a.id_survey=:id";
            $send=$conn->prepare($upit);
            $send->bindParam(":user", $user);
            $send->bindParam(":id", $id);

            $send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function sendSurvey($value, $user){
        global $conn;
        var_dump($conn);
        try{
            $upit="INSERT INTO surveyvotes (id_user, id_answer) VALUES(:idU, :idA)";
            $send=$conn->prepare($upit);
            $send->bindParam(":idU", $user);
            $send->bindParam(":idA", $value);

            $result= $send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }
////////
    
    

    



    //PAGINACIJA

    // function returnProductsPag($limit = 0){
    //     global $conn;

    //     try{
    //     $query = "SELECT * FROM product p INNER JOIN category c ON p.id_catEGORY=c.id_catEGORY INNER JOIN brand b
    //      ON p.id_brand=b.id_brand INNER JOIN price r ON p.id_price=r.id_price LIMIT :limit, :offset";

    //     $send = $conn->prepare($query);

    //     $limit = ($limit) * OFFSET;
    //     $send->bindParam(":limit", $limit, PDO::PARAM_INT); 

    //     $offset = OFFSET;
    //     $send->bindParam(":offset", $offset, PDO::PARAM_INT);

    //     $send->execute(); 

    //     $result = $send->fetchAll();

    //     return $result;
    //     }
    //     catch(PDOException $e){
    //         echo $e->getMessage();
    //         $message="Server error";
    //     }

    // }

    // function returnNumberProducts(){
    //     global $conn;
    //     $query = "SELECT COUNT(*) AS num FROM product";
    //     $result = $conn->query($query)->fetch();

    //     return $result;
    // }

    // function returnNumberPages(){
    //     $numberP = returnNumberProducts();
    //     $number= ceil($numberP->num / OFFSET);

    //     return $number;
    // }

?>