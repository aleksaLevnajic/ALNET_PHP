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

     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dataCat=$_POST['dataCat'];
        $msg="";
        $code=200;
        
        $deleteCategory=delete("category", "id_category", $dataCat);
        
        if($deleteCategory){
           $category=getAllFromTabel("category");
           $msg=$category;
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
        header("location: 404Page.php");
        $code=404;
        $msg="Page not found.";
    }
    
?>