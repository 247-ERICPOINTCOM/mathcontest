   <?php
    require_once 'includes\dbh.inc.php';
    mysqli_select_db($conn, 'quizdbase');

    if (isset($_POST['submit'])) {
        if (!empty($_POST['quizcheck'])) {
            $count = count($_POST['quizcheck']);
            echo "You attempted $count questions";

            $result = 0;
            $unattempted = 0;
            $i = 1;
            $selected = $_POST['quizcheck'];

            $sql = "select * from questions";
            $query = mysqli_query($conn, $sql);

            while ($rows = mysqli_fetch_array($query)) {

                if (empty($_POST['quizcheck'])) {
                } else {
                    $checked = $rows['ans_id'] == $selected[$i];
                    if ($checked) {
                        $result++;
                    }
                }
                $i++;
            }
            echo "<br> Your score is $result ";
        }
    }
