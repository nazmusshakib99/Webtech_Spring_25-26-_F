<?php  

class db{
function connection(){
    $db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="final_lab";


$connection= new mysqli($db_host,$db_user,$db_password,$db_name);
if($connection->connect_error)
    {
        die("database Connection failed".$connection->connect_error);
    }

return $connection;
}
function signup($connection,$tablename,$username,$password,$email,$gender,$country){
    $sql= "INSERT INTO ".$tablename."(username,password,email,gender,country) VALUES 
    ('".$username."','".$password."','".$email."','".$gender."','".$country."')";
    $result=$connection->query($sql);
    return $result;
}

function signin($connection,$tablename,$username,$password){
    // $sql="SELECT * FROM".$tablename."WHERE username='".$username."' AND password='".$password."'";
        $sql = "SELECT * FROM ".$tablename." WHERE username='".$username."' AND password='".$password."'";
    $result=$connection->query($sql);
    return $result;
}

function getAllUsers($connection, $tablename)
{
    $sql = "SELECT * FROM ".$tablename;

    $result = $connection->query($sql);

    return $result;
}

}
?>