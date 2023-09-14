<?php
    include("../config/connection.php");

    //echo "usli";
    //var_dump($_POST['btn']);
    if(isset($_POST['btn']))
    {
        echo "usli";
        $firstName = $_POST["ime"];
        $lastName = $_POST["prezime"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $firstNameRegEx = '/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/';
        $lastNameRegEx = '/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/';
        $emailRegEx = '/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/';
        $passowrdRegEx = '/^\w.{8,20}$/';

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

        proveraRegEx($firstName,$firstNameRegEx);
        proveraRegEx($lastName,$lastNameRegEx);
        proveraRegEx($email,$emailRegEx);
        proveraRegEx($password,$passowrdRegEx);

        
        if($ispravno)
        {
            $upit = "INSERT INTO user VALUES(null,:firstName,:lastName,:email,:passwordd,null, 2)";
            $pass = md5($password);

            $priprema = $conn->prepare($upit);
            $priprema->bindParam(":firstName", $firstName);
            $priprema->bindParam(":lastName", $lastName);
            $priprema->bindParam(":email", $email);
            $priprema->bindParam(":passwordd", $pass);
            try
            {
                $priprema->execute();
                $statusCode = 201;
                $message = "You have been registered successfully!";    
            }
            catch(PDOException $ex)
            {
                $message = "Server error, try later.";
                $statusCode = 500;
            }

        }
        http_response_code($statusCode);
        echo json_encode($message);
    }
    else
    {
        header("Location: ../404.php");
    }

?>