<!DOCTYPE html>
<html>
      <head> <Script src ="../Controller/JS/Checkusername.js"> </Script></head>
<body>

<h1 style="color:blue;">Registration Page</h1>

<form method="post" action="../Controller/registrationvalidation.php">

<table>

<tr>
    <td>Name:</td>
    <td><input type="text" id="name" name="name" onkeyup=checkUser()></td>
    <td> <p id="usernameresponse"></p></td>
</tr>

<tr>
    <td>Password:</td>
    <td><input type="password" name="password"></td>
</tr>

<tr>
    <td>Email:</td>
    <td><input type="email" name="email"></td>
</tr>
<tr>
    <td>Gender:</td>
    <td>
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female
    </td>
</tr>

<tr>
    <td>Country:</td>
    <td>
        <select name="country">
            <option value="Bangladesh">Bangladesh</option>
            <option value="India">India</option>
            <option value="USA">USA</option>
        </select>
    </td>
</tr>


<tr>
    <td></td>
    <td>
        <input type="submit" value="Register">
    </td>
</tr>

</table>

</form>

</body>
</html>