<?php
    session_start();
	include("../config/connection.php");

    if(isset($_POST['btn']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $emailRegexLog = '/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/';
        $passwordRegexLog='/^.{8,20}$/';

        $ispravno = true;
        $message = "";
        $statusCode = 200;

        function proveraRegEx($input, $regEx)
        {
            if($input = "")
            {
                $ispravno = false;
                $message = "Error occurred while data was processed. Try again.";
                $statusCode = 500;
            }
            else if(!preg_match($regEx, $input))
            {
                $ispravno = false;
                $message = "Error occurred while data was processed. Try again.";
                $statusCode = 500;
            }
        }

        proveraRegEx($email,$emailRegexLog);
        proveraRegEx($password,$passwordRegexLog);  

        if($ispravno)
        {
            global $conn;
            $upit = "SELECT * FROM user WHERE email = :email AND passwordCrypt = :pass";
            $pass = md5($password);	

            $priprema = $conn->prepare($upit);
            $priprema->bindParam(":email", $email);
            $priprema->bindParam(":pass", $pass);
        }

        try{ 
            $priprema->execute();
            if($priprema->rowCount()==1){
                $user=$priprema->fetch();
                $message="You have successfully logged in!";
                $_SESSION['user']=$user;
                //var_dump($_SESSION);
                //header("Location: ../index.php");
                //header("Location:../index.php");
                header('Location: http://localhost/web/index.php');
            }
            else{
                $message="No user found!";
                $statusCode = 400;
            }
    
        }
        catch(PDOException $e){
            $message=$e;
            $statusCode=500;
        }
        http_response_code($statusCode);
        echo json_encode($message);
    }

?>