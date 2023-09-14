<?php
    include("../config/connection.php");

    if(isset($_POST['btn']))
    {
        $name = $_POST['ime'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];

        $nameRegEx = '/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/';
        $emailRegEx = '/^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/';
        $phoneRegEx = '/^(\+\d{1,3}[- ]?)?\d{10}$/';
        $subjectRegEx = '/^[\w\d\s.]{5,150}$/';

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

        proveraRegEx($name,$nameRegEx);
        proveraRegEx($email,$emailRegEx);
        proveraRegEx($phone,$phoneRegEx);
        proveraRegEx($subject,$subjectRegEx);

        if($ispravno)
        {
            $upit ="INSERT INTO messagecontact VALUES(NULL, :namee, :email, :phone, :subjectt, NULL)";

            $priprema = $conn->prepare($upit);
            $priprema->bindParam(":namee", $name);
            $priprema->bindParam(":email", $email);
            $priprema->bindParam(":phone", $phone);
            $priprema->bindParam(":subjectt", $subject);

            try
            {
                $priprema->execute();
                $statusCode = 200;
                $message = "Message has been sent!";  
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