<?php

if (isset($_POST["submit"])) {
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $dateLoggedIn = date('Y-m-d H:i:s');

    require_once 'functions.php';
    require_once 'DBhandler.php';

    if (isSignInEmpty( $email, $password)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=emptyinput");
        exit();
    }

    if(!emailTaken($conn, $email)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html?error=emailDNE");
        exit();
    }


    if (passwordExists($conn, $email, $password)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html?error=wrongPassword");
        exit();
    }

    LogInUpdate($conn, $dateLoggedIn, $email, $password);
    session_start();

    $_SESSION['email'] = $email;

}
else{
    header("location: ../startbootstrap-sb-admin-2-gh-pages/login.html");
}
