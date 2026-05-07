<?php
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

function validateEmail($email) {
    if (empty($email)) {
        return "Email is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }

    return "";
}

function validateGender($gender) {
    if (empty($gender)) {
        return "Gender is required";
    }

    return "";
}

function validateCountry($country) {
    if (empty($country)) {
        return "Country is required";
    }

    return "";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $gender = $_POST["gender"] ?? "";
    $country = $_POST["country"];


    $nameError = validateName($name);
    $passwordError = validatePassword($password);
    $emailError = validateEmail($email);
    $genderError = validateGender($gender);
    $countryError = validateCountry($country);

    if (
        empty($nameError) &&
        empty($passwordError) &&
        empty($emailError) &&
        empty($genderError) &&
        empty($countryError)
    ) {

        $_SESSION["name"] = $name;

        setcookie("name", $name, time() + 3600, "/");

        echo "Login Successful <br>";


        $formdata = array(
            "name" => $name,
            "password" => $password,
            "email" => $email,
            "gender" => $gender,
            "country" => $country
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

    } else {


        echo $nameError . "<br>";
        echo $passwordError . "<br>";
        echo $emailError . "<br>";
        echo $genderError . "<br>";
        echo $countryError . "<br>";
    }
}


if (isset($_SESSION["name"]) || isset($_COOKIE["name"])) {
    echo "Welcome Back";
} else {
    echo "Please Login";
}

?>