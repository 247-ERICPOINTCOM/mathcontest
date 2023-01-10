<?php
include_once 'header.php'
?>

<section class="Log-in form">
    <h1>Welcome to Mathema</h1>
    <form action="includes\login.inc.php" method="post">

        <input type="text" name="uid" placeholder="Username/Email"> <br>
        <input type="password" name="pwd" placeholder="Password"><br>

        <button type="submit" name="submit">Log in</button>

    </form>
    <?php
    if (isset($_GET["error"])) {

        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($_GET["error"] == "incorrectlogin") {
            echo "<p>Incorrect Username or Password. </p>";
        }
    }
    ?>
</section>

<p>Terms of UsePrivacy Policy
    This site is protected by reCAPTCHA Enterprise. Google's Privacy Policy and Terms of Use apply
</p>