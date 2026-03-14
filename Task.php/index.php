<?php
session_start();
include 'inc/config.php';
$sql = 'SELECT * FROM info';
$result = mysqli_query($conn,$sql);
$info = mysqli_fetch_assoc($result); 

// Add function to get personal info by username.
function getInfo($conn ,$username)
{
    $sql = "SELECT * FROM info WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo'Welcome ' . $_SESSION['username'] ?>
    You can now Fetch data from the DB
    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username">
        <input type="submit" name="search" value="Search"><br>
        <a href="/login.php">click to go back to login screen </a>
    </form>
    <?php
if(isset($_POST['search'])){

    $username = $_POST['username'];

    $user = getInfo($conn, $username);

    if($user){
        echo "<h3>User Info</h3>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Age: " . $user['age'] . "<br>";
    }else{
        echo "User not found.";
    }

}

?>
</body>
</html>