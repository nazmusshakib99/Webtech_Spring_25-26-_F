<?php

include "../Model/db.php";
session_start();

$datafile = "data.json";



function validateName($name) {
    if (empty($name)) {
        return "Name is required";
    }

    if (strlen($name) < 5) {
        return "Name must be at least 5 characters";
    }

    return "";
}

function validatePassword($password) {
    if (empty($password)) {
        return "Password is required";
    }

    if (strlen($password) < 4) {
        return "Password must be at least 4 characters";
    }

    return "";
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    $nameError = validateName($name);
    $passwordError = validatePassword($password);

    if (
        empty($nameError) &&
        empty($passwordError) 
      
    ) {

        $_SESSION["name"] = $name;

        setcookie("name", $name, time() + 3600, "/");

        echo "Login Successful <br>";


        $formdata = array(
            "name" => $name,
            "password" => $password,
          
        );
         

        if (file_exists($datafile)) {
            $existingData = file_get_contents($datafile);
            $tempData = json_decode($existingData, true);
        }

        if (!is_array($tempData)) {
            $tempData = array();
        }

 
        $tempData[] = $formdata;

   
        $jsondata = json_encode($tempData, JSON_PRETTY_PRINT);


        if (file_put_contents($datafile, $jsondata)) {
            echo "Data Saved Successfully <br>";
        } else {
            echo "No data saved";
        }

        $database=new db();
        $connection=$database->connection();
        $result=$database->signin($connection,"user",$name,$password);
        if($result){

         Header("Location:../View/dashboard.php");
        }
else{
         echo $connection->error;
}        

    } else {


        echo $nameError . "<br>";
        echo $passwordError . "<br>";
      
    }
}


if (isset($_SESSION["name"]) || isset($_COOKIE["name"])) {
    echo "Welcome Back";
} else {
    echo "Please Login";
}

?>