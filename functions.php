<?php


//Register Functions!!!!!!!!
function isSignUpEmpty($name, $surname, $email, $password, $repeatPassword){
    return empty($name) || empty($surname) || empty($email) || empty($password) || empty($repeatPassword);
}

function invalidName($name){
    return !preg_match("/^[a-zA-Z]*$/", $name);
}

function invalidSurname($surname){
    return !preg_match("/^[a-zA-Z]*$/", $surname);
}

function invalidEmail($email){
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function invalidUsername($username){
    return !preg_match("/^[a-zA-Z]*$/", $username);
}

function passwordMatch($password, $repeatPassword){
    return !($password == $repeatPassword);
}

function emailTaken($conn, $email){
    $query = "SELECT * FROM users WHERE Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=emptyinput");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        return true;
    }
    else{
        return false;
    }
}

function createUser($conn, $name, $surname, $email, $username, $password, $dateRegistered){
    $query = "INSERT INTO users (Name, Surname, Username, Email, Passhash, DateRegistered) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=couldntPrepareStatement");
        exit();
    }

   $hashedPassword =  hash('md5', $password);

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $surname, $username, $email, $hashedPassword, $dateRegistered);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=none");
}

//LogInFunctions!!!!!!!!!!

function isSignInEmpty($email, $password){
    return empty($email) || empty($password);
}

function passwordExists($conn, $email, $password){
    $query = "SELECT * FROM users WHERE Email = ? AND PassHash = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html?error=couldntPrepareStatement");
        exit();
    }

    $hashedPassword = hash('md5', $password);

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        return false;
    }
    else{
        return true;
    }

}

function LogInUpdate($conn ,$dateLoggedIn, $email, $password){
    $query="UPDATE users SET LastLogIn=? WHERE Email= ?" ;
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html?error=couldntPrepareStatement");
        exit();
    }

    $hashedPassword = hash('md5', $password);

    mysqli_stmt_bind_param($stmt, "ss", $dateLoggedIn, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}


function validateUser($conn, $email){
    $query = "SELECT * FROM users WHERE Email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html?error=couldntPrepareStatement");
        exit();
    }
}


