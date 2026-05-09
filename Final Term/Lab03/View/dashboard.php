<?php 
include "../Model/db.php";
session_start();

if(!isset($_SESSION["name"])){

header ("Location:../Controller/logout.php");
}
$database= new db();
$connection=$database->connection();
$result=$database-> getAllUsers($connection,"user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H2> Welcome <?php  echo $_SESSION["name"];?></H2>
    <h3>All User Information</h3>

    <table border="1">
        <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Gender</th>
    <th>Country</th>
        </tr>

<?php

while($row = $result->fetch_assoc())
{
?>

<tr>
    <td><?php echo $row["id"]; ?></td>
    <td><?php echo $row["username"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["gender"]; ?></td>
    <td><?php echo $row["country"]; ?></td>
</tr>

<?php
}
?>

</table>

</body>
</html>