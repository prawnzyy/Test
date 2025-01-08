<?php
// form.php
$pageTitle = "Form";

// Logic code here
// Input Validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["pqeDate"])) {
        $pqeDate = null;
    }
    if (empty($_POST["phdDefDate"])) {
        $phdDefDate = null;
    }
}

// Include the header (navigation)
include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');
?>
<section>
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/modules.php">Modules</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/forms/countdown.php">PQE and PhD Defense</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/hours.php">Teaching, Research and Other Duties</a>
        </li>
    </ul>
    <div class="container" style="width: 70%;">
        <form action="<?php echo htmlspecialchars("index.php");?>" method="POST">
            <div>
                <label for="PQE Due Date">PQE Due Date</label>
                <input id="pqeDueDate" class="form-control" type="date" name="pqeDate"/>
            </div>
            <br>
            <div>
                <label for="PhD Defense Due Date">PhD Defense Due Date</label>
                <input id="phdDueDate" class="form-control" type="date" name="phdDefDate"/>
            </div>
            <br>
            <input type="submit">
        </form>
    </div>
</section>

<!-- Include the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

