<?php  
 
include "../Model/db.php";
$username = $_POST["username"] ?? "";

if(!$username){
    echo "username required";
}
else{
    $database=new db();
    $connection=$database->connection();
    $result=$database->checkusername($connection,"user",$username);
    if($result->num_rows>0){
        echo "Name Already Taken";

    }
    else{
         echo "UserName Avaialble";
    }
}

?>

