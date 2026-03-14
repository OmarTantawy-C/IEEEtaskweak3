<?php
include 'inc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<section>
<form action="inc/login.inc.php" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" ><br><br>

    <label>Password:</label><br>
    <input type="password" name="pwd" ><br><br>

    <button type="submit" name="submit">Login</button><br><br>
</form>

You don't have an account ?
<a href="signup.php">sign up here</a>
<?php
if(isset($_GET["error"])){
            if ($_GET["error"] == "emptyinput"){
                echo "<p>Fill in all fields</p>";
            }
            else if ($_GET["error"] == "wronglogin"){
                echo "<p>Incorrect login!</p>";
            }
}
?>


</body>
</html>