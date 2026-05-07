

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method ='post' action ="../Controller/loginvalidation.php">
    <?php 
    echo "<h1 style='color:red'>Log In Page</h1>"
    ?>
    <table>
        <tr><td>User Name: </td>
            <td><input type="text" id="uname" name="name"></td></tr>
             <tr><td>Password:  </td>
            <td><input type="password" id="upass" name="password"></td></tr>

             <tr><td>Email:  </td>
            <td><input type="email" id="uemail" name="email"></td></tr>

            <tr> 

                <td>Gender:</td>
                <td><input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="female">Female</td>
            </tr>

            <tr><td>Country:</td>
            <td><select name="country" id="ucountry">
                <option value="">--Select Option---</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="India">India</option>
                <option value="Pakistan">Pakistan</option>
                <option value="china">China</option>
            </select></td>
        </tr>
            <tr></tr>
            <tr>
                <td></td>
                <td >  <input type="submit" id="submitbutton" name = "submit"> </td>
            </tr>
       </form>
    </table>
</body>
</html>