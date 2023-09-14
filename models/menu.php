<?php
   include "./config/connection.php";

   global $conn;

    $upit="SELECT * FROM menu WHERE display=1";
    //Provera da li je korisnik ulogovan
    if(isset($_SESSION['user'])){  
        $user=$_SESSION['user'];
        if($user->id_role == 1){
            //Ako je admin
            $upit.=" OR display=3 OR display=2";
            
        }
        else{
            //Ako je korisnik
            $upit.="  OR display=2";
        }
    }
             //Nije ulogovan
    else{
        $upit.=" OR display=0";
    }
    try{  
        //global $conn;      
        $menu=$conn->query($upit)->fetchAll();
        //var_dump($menu);
    }
    catch(PDOException $e){
        $greska=$e;
    }


?>