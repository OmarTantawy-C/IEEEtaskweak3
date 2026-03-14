<?php 
function emptyInputSignup($email,$username,$pwd,$age){
    $result = '';
    if(empty($email) || empty($username) || empty($pwd) || empty($age)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidUsername($username){
       
 $result = '';
    if(!preg_match("/^[a-zA-z0-9]*$/", $username)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = '';
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidAge($age){
    $result = '';
    if(!filter_var($age, FILTER_VALIDATE_INT) || $age < 1 || $age > 130){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd,$repeatpwd){
    $result = '';
    if($pwd !== $repeatpwd){
        $result = true;
    } else{
        $result = false;
    }
    return $result;    
}
function userExists($conn,$username,$email){
    $sql = "SELECT * FROM info Where username =  ? or email = ? ;"; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php");
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "ss",$username,$email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn,$email,$username,$pwd,$age){
    $sql = "INSERT INTO info(email,username,password,age) VALUE (?,?,?,?) ;"; 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    } 
 $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss",$email,$username,$hashedpwd,$age);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();

}
function emptyInputLogin($username,$pwd){
    $result = '';
    if(empty($username) || empty($pwd)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}
function loginUser($conn, $username, $pwd){
    $userExists = userExists($conn,$username,$username);
    if ($userExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $userExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["username"] = $userExists["username"];
        header("location: ../index.php");
        exit();
    }
}