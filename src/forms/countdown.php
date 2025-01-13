<?php
// form.php
// $pageTitle = "Form";

require $_SERVER['DOCUMENT_ROOT'] . '/src/database/db.php';

// Initialise DB
$conn = init_connection();
$studentID = 1;
$order = array("pqeDate", "phdDefDate");
$mapName = array("pqedate", 'phddefense');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $final = array();
    for ($x = 0; $x < 2; $x++) {
        $final[$mapName[$x]] = htmlspecialchars($_POST[(string)$order[$x]]);
    }
    updateCountdown($conn, $final, $studentID);
     header("Location: /index.php");
     exit();
}

// Logic code here
?>
<div class="container" style="width: 70%;">
    <form action="" method="POST">
        <div>
            <label for="PQE Due Date" class="font-weight-bold">PQE Due Date</label>
            <input id="pqeDueDate" class="form-control" type="date" name="pqeDate"/>
        </div>
        <br>
        <div>
            <label for="PhD Defense Due Date" class="font-weight-bold">PhD Defense Due Date</label>
            <input id="phdDueDate" class="form-control" type="date" name="phdDefDate"/>
        </div>
        <br>
        <input type="submit">
    </form>
</div>


