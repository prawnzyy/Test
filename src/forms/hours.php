<?php
// form.php
session_start();
$pageTitle = "Form";

// Logic code here
$teachingHoursDoneErr = $teachingHoursTotalErr = $researchHoursDoneErr = $researchHoursTotalErr = $otherHoursDoneErr = $otherHoursTotalErr = "";
$teachingHoursDone = $teachingHoursTotal = $researchHoursDone = $researchHoursTotal = $otherHoursDone = $otherHoursTotal = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation for teachingHoursDone
    if (!empty($_POST["teachingHoursDone"]) && (!is_numeric($_POST["teachingHoursDone"]) || $_POST["teachingHoursDone"] < 0)) {
        $teachingHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["teachingHoursDone"])) {
            $_SESSION["teachingHoursDone"] = (int)htmlspecialchars($_POST["teachingHoursDone"]);
        }
    }

// Validation for teachingHoursTotal
    if (!empty($_POST["teachingHoursTotal"]) && (!is_numeric($_POST["teachingHoursTotal"]) || $_POST["teachingHoursTotal"] < 0)) {
        $teachingHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["teachingHoursTotal"])) {
            $_SESSION["teachingHoursTotal"] = (int)htmlspecialchars($_POST["teachingHoursTotal"]);
        }
    }

// Validation for researchHoursDone
    if (!empty($_POST["researchHoursDone"]) && (!is_numeric($_POST["researchHoursDone"]) || $_POST["researchHoursDone"] < 0)) {
        $researchHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["researchHoursDone"])) {
            $_SESSION["researchHoursDone"] = (int)htmlspecialchars($_POST["researchHoursDone"]);
        }
    }

// Validation for researchHoursTotal
    if (!empty($_POST["researchHoursTotal"]) && (!is_numeric($_POST["researchHoursTotal"]) || $_POST["researchHoursTotal"] < 0)) {
        $researchHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["researchHoursTotal"])) {
            $_SESSION["researchHoursTotal"] = (int)htmlspecialchars($_POST["researchHoursTotal"]);
        }
    }

// Validation for otherHoursDone
    if (!empty($_POST["otherHoursDone"]) && (!is_numeric($_POST["otherHoursDone"]) || $_POST["otherHoursDone"] < 0)) {
        $otherHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["otherHoursDone"])) {
            $_SESSION["otherHoursDone"] = (int)htmlspecialchars($_POST["otherHoursDone"]);
        }
    }

// Validation for otherHoursTotal
    if (!empty($_POST["otherHoursTotal"]) && (!is_numeric($_POST["otherHoursTotal"]) || $_POST["otherHoursTotal"] < 0)) {
        $otherHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["otherHoursTotal"])) {
            $_SESSION["otherHoursTotal"] = (int)htmlspecialchars($_POST["otherHoursTotal"]);
        }
    }

    // If all fields are valid, you can proceed to save the data or process it further
    if (empty($teachingHoursDoneErr) && empty($teachingHoursTotalErr) && empty($researchHoursDoneErr) &&
        empty($researchHoursTotalErr) && empty($otherHoursDoneErr) && empty($otherHoursTotalErr)) {
        // Redirect to another page or display success message
        header("Location: /index.php");
        exit();
    }
}

// Include the header (navigation)
include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');
?>
<section id="content" style="margin-bottom: 80px">
    <ul class="nav nav-pills nav-justified" style="justify-content: center">
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/modules.php">Modules</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/countdown.php">PQE and PhD Defense</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/forms/hours.php">Teaching, Research and Other
                Duties</a>
        </li>
    </ul>
    <div class="container">
        <form action="hours.php" method="POST">
            Teaching Hours Done: <input type="text" name="teachingHoursDone">
            <div><?php echo $teachingHoursDoneErr;?></div><br>
            Teaching Hours Total: <input type="text" name="teachingHoursTotal">
            <div><?php echo $teachingHoursTotalErr;?></div><br>
            Research Hours Done: <input type="text" name="researchHoursDone">
            <div><?php echo $researchHoursDoneErr;?></div><br>
            Research Hours Total: <input type="text" name="researchHoursTotal">
            <div><?php echo $researchHoursTotalErr;?></div><br>
            Other Hours Done: <input type="text" name="otherHoursDone">
            <div><?php echo $otherHoursDoneErr;?></div><br>
            Other Hours Total: <input type="text" name="otherHoursTotal">
            <div><?php echo $otherHoursTotalErr;?></div><br>
            <input type="submit" onclick="return inputValidation(event)">
        </form>
    </div>
</section>

<!-- Include the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

