    <?php

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //returns true if field is empty
    function emptyInputSignUp($name, $email, $username, $pwd, $pwdRepeat)
    {
        $result = true;
        if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //checks if username contains numbers and characters if not returns true
    function invalidUid($username)
    {
        $result = true;
        if (!preg_match("/^[a-zA-z0-9]*$/", $username)) { //built-in search algorithm
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //returns true if email is invalid
    function invalidEmail($email)
    {
        $result = true;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //built-in to check email
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function pwdMatch($pwd, $pwdRepeat)
    {
        $result = true;
        if ($pwd !== $pwdRepeat) { //built-in to check email
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function uidExists($conn, $username, $email)
    {   // ? is a placeholder
        $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
        //prepared statement, makes sure that the no code gets injected into the database
        $stmt = mysqli_Stmt_init($conn);


        //if prepared stmt has not been succeded that signup again
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        //pass data to users table
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
    }

    function
    createUser($conn, $name, $email, $username, $pwd)
    {
        $sql = "INSERT INTO users(usersName, usersEmail, usersUid, usersPwd) values(?,?,?,?);";
        //prepared statement, makes sure that the no code gets injected into the database
        $stmt = mysqli_Stmt_init($conn);


        //if prepared stmt has not been succeded that signup again
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        //hash password to make it secure and prevent hackers to have access to users database
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //bind parameters to users table
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //send user back to home-page
        header("location: ../signup.php?error=none");
        exit();
    }


    function emptyInputLogin($username, $pwd)
    {
        $result = true;
        if (empty($username) || empty($pwd)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $pwd)
    {
        $uidExist = uidExists($conn, $username, $username);

        //error handler
        if ($uidExist === false) {
            header("location: ../login.php?error=incorrectlogin");
            exit();
        }

        $pwdHashed = $uidExist["usersPwd"];            //user's existing password
        $checkPwd = password_verify($pwd, $pwdHashed); //checking the similarity of password from server and database and returns bool value

        if ($checkPwd === false) {
            header("location: ../login.php?error=incorrectlogin");
            exit();
        } else if ($checkPwd === true) {
            session_start();
            $_SESSION["userid"] = $uidExist["usersId"];
            $_SESSION["useruid"] = $uidExist["usersUid"];
            header("location: ../index.php");
            exit();
        }
    }
