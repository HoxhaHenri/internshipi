<?php

session_start();

if (isset($_POST["submit"])){
    $name= $_POST["fname"];
    $surname= $_POST["Surname"];
    $email= $_POST["Email"];
    $username = $_POST["Username"];
    $password= $_POST["Password"];
    $repeatPassword= $_POST["repeatPassword"];
    $dateRegistered = date('Y-m-d H:i:s');

    require_once 'functions.php';
    require_once 'DBhandler.php';

    if (isSignUpEmpty($name, $surname, $email, $password, $repeatPassword)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=emptyinput");
        exit();
    }
    if (invalidName($name)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=invalidname");
        exit();
    }
    if (invalidSurname($surname)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=invalidnsurname");
        exit();
    }
    if (invalidEmail($email)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=invalidemail");
        exit();
    }

    if (invalidUsername($username)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=invalidusername");
        exit();
    }

    if (passwordMatch($password, $repeatPassword)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=passworddontmatch");
        exit();
    }
    if (emailTaken($conn, $email)){
        header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html?error=emailtaken");
        exit();
    }

    createUser($conn, $name, $surname, $username, $email, $password, $dateRegistered);


}
else{
   header("location: ../startbootstrap-sb-admin-2-gh-pages/register.html");
}