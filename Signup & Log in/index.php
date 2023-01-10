<?php
include_once 'header.php'
?>

<section class="index-intro">
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<p> Hello " . $_SESSION["useruid"] . "</p>";
    }
    ?>

    <h2>This is the Home page of Mathema Contest Website</h2>
    <h3>....... body of homepage ............... </h3>


</section>





<?php
include_once 'footer.php'
?>