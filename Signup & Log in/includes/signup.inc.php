<?php

//
if (isset($_POST["submit"])) {

    /*$name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $username = test_input($_POST["uid"]);
    $pwd = test_input($_POST["pwd"]);
    $pwdRepeat = test_input($_POST["pwdrepeat"]);
    $country = test_input($_POST["country"]);
    $birthdate = test_input($_POST["birthdate"]);
    $gender = test_input($_POST["gender"]);*/

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'functions.inc.php';
    require_once 'dbh.inc.php';

    if (emptyInputSignUp($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaildusername");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);
} else {
    header("location: ../signup.php");
    exit();
}
