<?php
include_once 'header.php'
?>

<section class="sign-up form">
    <h1>Welcome to Mathema</h1>
    <form action="includes\signup.inc.php" method="post">

        Full name* <input type="text" name="name" id="Full-Name"> <br>
        E-mail* <input type="text" name="email"><br>
        Username* <input type="text" name="uid" placeholder="Type your Username here"> <br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="pwdrepeat" placeholder="Confirm Passsword"><br>
        <!--Country* <input type="text" name="country"><br>
        Birth Date* <input type="date" name="birthdate"><br>
        Gender <input type="radio" name="gender">Female
        <input type="radio" name="gender">Male
        <input type="radio" name="gender">Others <br>-->

        <button type="submit" name="submit">Sign Up</button>

    </form>
    <?php
    if (isset($_GET["error"])) {

        if ($_GET["error"] == "emptyinput") {             //use case
            echo "<p>Fill in all fields!</p>";
        } else if ($_GET["error"] == "invaildusername") {
            echo "<p>Choose a proper username!</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p>Choose a proper email!</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passwords doesn't match!</p>";
        } else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong, try again!</p>";
        } else if ($_GET["error"] == "usernametaken") {
            echo "<p>Username already taken!</p>";
        } else if ($_GET["error"] == "none") {
            echo "<p>You have signed up!</p>";
            header("location: ../login.php");   //redirected to login page
        }
    }
    ?>

</section>

<p>Terms of UsePrivacy Policy
    This site is protected by reCAPTCHA Enterprise. Google's Privacy Policy and Terms of Use apply
</p>