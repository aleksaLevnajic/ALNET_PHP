<?php

define("SERVER", "localhost");
define("DATABASE", "id20460939_bazaphp");
define("USERNAME", "id20460939_root");
define("PASSWORD", "6=h<&k#oRBa93DNP");

//define("SERVER", "localhost");
//define("DATABASE", "bazaphp");
//define("USERNAME", "root");
//define("PASSWORD", "");

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
?>