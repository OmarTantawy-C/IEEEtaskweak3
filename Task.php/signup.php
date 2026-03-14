<?php
include 'inc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h2>Sign up</h2>
<!-- Build a simple form to collect username and personal info and store it on MySQL db. -->
<form action="/inc/signup.inc.php" method="POST">
    
    <label>Email:</label><br>
    <input type="email" name="email" ><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" ><br><br>

    <label>Password:</label><br>
    <input type="password" name="pwd" ><br><br>
    
    <label>Repeat Password</label><br>
    <input type="password" name="repeatPwd" ><br><br>

    <label>Age:</label><br>
    <input type="text" name="age" ><br><br>

    <button type="submit" name="submit">Sign Up</button><br><br>

</form>
Already signed up ?
   <a href="login.php">login from here</a><br><br>
   <?php
        if(isset($_GET["error"])){
            if ($_GET["error"] == "emptyinput"){
                echo "<p>Fill in all fields</p>";
            }
            else if ($_GET["error"] == "invalidUsername"){
                echo "<p>Choose a proper username!</p>";
            }
            else if ($_GET["error"] == "invalidEmail"){
                echo "<p>Choose a proper email!</p>";
            }
            else if ($_GET["error"] == "invalidAge"){
                echo "<p>Choose a proper age!</p>";
            }
            else if ($_GET["error"] == "pwdsDon'tMatch"){
                echo "<p>Passwords Don't match!</p>";
            }
            else if ($_GET["error"] == "userExists"){
                echo "<p>User already taken!</p>";
            }
            else if ($_GET["error"] == "stmtfailed"){
                echo "<p>Something went wrong, try again!</p>";
            }
            else if ($_GET["error"] == "none"){
                echo "<p>You are now signed in you can now log in.!</p>";
            }
            

            }

   ?>

</body>
</html>