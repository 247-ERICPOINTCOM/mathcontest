<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quizdemo</title>


    //countdown for 20 minutes
    <script language="javascript">
        function initCountdown(e) {
            var min,
                sec,
                hund;
            startTimer;

            var divCOuntdown = document.getElementById("divCountdown");

            if (Math.floor(e / 60) == 0) {
                min = 0;
            } else {
                min = Math.floor(e / 60);
            }

            if (e % 60 == 0) {
                sec = 0;
            } else {
                sec = e - 60 * min;
            }
            hund = 0;
            startTimer = setInterval(startCountdown, 10);

            function startCountdown() {
                hund--;
                if (hund == 0 && sec == 0 && min == 0) {
                    clearInterval(startTimer);

                } else if (hund < 0 && sec > 0) {
                    sec--;
                    hund = 99;

                } else if (hund < 0 && sec == 0 && min > 0) {
                    min--;
                    sec = 59;
                    hund = 99;

                }

                if (hund == 0 && sec == 0 && min == 0) {
                    divCountdown.innerHTML = "OUTATIME";

                } else {

                    divCountdown.innerHTML = min + ":" + sec + ":" + hund;
                }
            }
        }
    </script>

</head>

<body>

    <div id="divCountdown" onload="initCountdown(10)"></div>

    <form action="check.php" method="post">

        <?php
        // $start_time = strtotime("now");
        // $end_time = strtotime("today + 1 year");
        // $time_left = $end_time - $start_time;
        // echo "You have $time_left seconds left... <br />";

        //creating connection
        require_once 'includes\dbh.inc.php';
        mysqli_select_db($conn, 'quizdbase');

        //fetching questions and options from database
        for ($i = 1; $i <= 4; $i++) {
            $queDisplay = "select * from questions where qid = $i";
            $quequery = mysqli_query($conn, $queDisplay);
            while ($rows = mysqli_fetch_array($quequery)) {
                echo '<div>' . $rows['question'] . '</div>';
                $queOption = "select * from answers where ans_id = $i";
                $optionquery = mysqli_query($conn, $queOption);
                while ($rows = mysqli_fetch_array($optionquery)) {
                    echo '<input type="radio" name = "quizcheck[' . $rows['ans_id'] . ']"value = ' . $rows["aid"] . '>';
                    echo $rows['answer'];
                }
            }
        } ?>

        <br><button type="submit" name="submit"> Submit </button>

    </form>


</body>

</html>