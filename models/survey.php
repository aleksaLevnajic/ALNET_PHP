<?php
    //include("functions.php");
    include("../config/connection.php");

    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id=$_POST['id'];
        $value=$_POST['value'];
        $user=$_POST['user'];
        $msg="";
        $code=200;

        try{
            $upit="SELECT * FROM surveyvotes v INNER JOIN answer a ON v.id_answer=a.id_answer WHERE v.id_user=:user AND a.id_survey=:id";
            $send=$conn->prepare($upit);
            $send->bindParam(":user", $user);
            $send->bindParam(":id", $id);

            $send->execute();
            $result=$send->fetchAll();
            $answerSurvey = $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }

        try{
            $upit="INSERT INTO surveyvotes (id_user, id_answer) VALUES(:idU, :idA)";
            $send=$conn->prepare($upit);
            $send->bindParam(":idU", $user);
            $send->bindParam(":idA", $value);

            $result= $send->execute();
            $sendSurvey = $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
        
        //$answerSurvey=alreadyAnswered($id, $user);
        if(count($answerSurvey)){
            $msg="You have already answered.";
        }
        else{
            //$sendSurvey=sendSurvey($value, $user);
            if($sendSurvey){
                $msg="Thank you for your feedback.";
                $code=201;
            }
            else{
                $msg="Server error.";
                $code=500;
            }
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