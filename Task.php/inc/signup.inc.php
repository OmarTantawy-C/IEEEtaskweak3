<?php
if(isset($_POST['submit'])){

$email = $_POST['email'];
$username = $_POST['username'];
$pwd = $_POST['pwd'];
$age = $_POST['age'];
$repeatpwd = $_POST['repeatPwd'];
include 'config.php';
include 'functions.inc.php';
if(emptyInputSignup($email,$username,$pwd,$age) !== false){
    header("location: ../signup.php?error=emptyinput");
    exit();
}
if(invalidUsername($username) !== false){
    header("location: ../signup.php?error=invalidUsername");
    exit();
}
if(invalidEmail($email) !== false){
    header("location: ../signup.php?error=invalidEmail");
    exit();
}
if(invalidAge($age) !== false){
    header("location: ../signup.php?error=invalidAge");
    exit();
}
if(pwdMatch($pwd,$repeatpwd) !== false){
    header("location: ../signup.php?error=pwdsDon'tMatch");
    exit();
}
if(userExists($conn,$username,$email) !== false){
    header("location: ../signup.php?error=userExists");
    exit();
}
createUser($conn,$email,$username,$pwd,$age);

} else {
    header("location: ../signup.php");
    exit();
}
