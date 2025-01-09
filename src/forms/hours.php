<?php
// form.php
session_start();
$pageTitle = "Form";

// Logic code here
$teachingHoursDoneErr = $teachingHoursTotalErr = $researchHoursDoneErr = $researchHoursTotalErr = $otherHoursDoneErr = $otherHoursTotalErr = "";
$teachingHoursDone = $teachingHoursTotal = $researchHoursDone = $researchHoursTotal = $otherHoursDone = $otherHoursTotal = "";

// Array to check if field should be updated
$update = array(False, False, False, False, False, False);
$order = array("teachingHoursDone", "teachingHoursTotal", "researchHoursDone", "researchHoursTotal", "otherHoursDone", "otherHoursTotal");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation for teachingHoursDone
    if (!empty($_POST["teachingHoursDone"]) && (!is_numeric($_POST["teachingHoursDone"]) || $_POST["teachingHoursDone"] < 0)) {
        $teachingHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["teachingHoursDone"])) {
            $update[0] = True;
        }
    }

// Validation for teachingHoursTotal
    if (!empty($_POST["teachingHoursTotal"]) && (!is_numeric($_POST["teachingHoursTotal"]) || $_POST["teachingHoursTotal"] < 0)) {
        $teachingHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["teachingHoursTotal"])) {
            $update[1] = True;
        }
    }

// Validation for researchHoursDone
    if (!empty($_POST["researchHoursDone"]) && (!is_numeric($_POST["researchHoursDone"]) || $_POST["researchHoursDone"] < 0)) {
        $researchHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["researchHoursDone"])) {
            $update[2] = True;
        }
    }

// Validation for researchHoursTotal
    if (!empty($_POST["researchHoursTotal"]) && (!is_numeric($_POST["researchHoursTotal"]) || $_POST["researchHoursTotal"] < 0)) {
        $researchHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["researchHoursTotal"])) {
            $update[3] = True;
        }
    }

// Validation for otherHoursDone
    if (!empty($_POST["otherHoursDone"]) && (!is_numeric($_POST["otherHoursDone"]) || $_POST["otherHoursDone"] < 0)) {
        $otherHoursDoneErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["otherHoursDone"])) {
            $update[4] = True;
        }
    }

    // Validation for otherHoursTotal
    if (!empty($_POST["otherHoursTotal"]) && (!is_numeric($_POST["otherHoursTotal"]) || $_POST["otherHoursTotal"] < 0)) {
        $otherHoursTotalErr = "Please enter a valid non-negative number.";
    } else {
        if (!empty($_POST["otherHoursTotal"])) {
            $update[5] = True;
        }
    }

    // If no error messages, redirect back to index
    if (empty($teachingHoursDoneErr) && empty($teachingHoursTotalErr) && empty($researchHoursDoneErr) &&
        empty($researchHoursTotalErr) && empty($otherHoursDoneErr) && empty($otherHoursTotalErr)) {
        // Update all necessary fields

        for ($x = 0; $x < 6; $x++) {
            if ($update[$x]) {
                $_SESSION[(string)$order[$x]] = (int)htmlspecialchars($_POST[(string)$order[$x]]);
            }
        }

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
    <div class="container" style="width: 50%">
        <form action="hours.php" method="POST" style="align-content: center">
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Teaching Hours Done:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="teachingHoursDone">
                </div>
            </div>
            <div class="error-msg"><?php echo $teachingHoursDoneErr; ?></div>
            <br>
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Teaching Hours Total:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="teachingHoursTotal">
                </div>
            </div>
            <div class="error-msg"><?php echo $teachingHoursTotalErr; ?></div>
            <br>
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Research Hours Done:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="researchHoursDone">
                </div>
            </div>
            <div class="error-msg"><?php echo $researchHoursDoneErr; ?></div>
            <br>
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Research Hours Total:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="researchHoursTotal">
                </div>
            </div>
            <div class="error-msg"><?php echo $researchHoursTotalErr; ?></div>
            <br>
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Other Hours Done:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="otherHoursDone">
                </div>
            </div>
            <div class="error-msg"><?php echo $otherHoursDoneErr; ?></div>
            <br>
            <div class="justify-content-center row mb-3">
                <label class="form-label col-lg-3 col-form-label" style="text-align: right">Other Hours Total:</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="otherHoursTotal">
                </div>
            </div>
            <div class="error-msg"><?php echo $otherHoursTotalErr; ?></div>
            <br>
            <div style="color: mediumpurple">
                *Only fill in required fills*
            </div>
            <input type="submit">
        </form>
    </div>
</section>

<!-- Include the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>

