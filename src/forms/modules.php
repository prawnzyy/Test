<?php
// form.php
session_start();
$pageTitle = "Form";

$addModNameErr = $addMcsErr = "";
$modules = $_SESSION["modules"] ?? array(["AR5652 PhD Seminar", 4], ["AR5652 Phd Lesson", 8], ["AR5653 Phd Thesis", 8], ["AR6764 R-Programming", 4]);;

// Logic code here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "Add") {
            // Code to add the module
            if (empty($_POST["addModName"])) {
                $addModNameErr = "Mod name cannot be empty.";

            }
            if (!is_numeric($_POST["addMcs"]) || !($_POST["addMcs"] == 4 || $_POST["addMcs"] == 8)) {
                $addMcsErr = "Module MCs must be either 4 or 8.";
            }
            if (empty($addModNameErr) && empty($addMcsErr)) {
                // Only add to modules if no errors
                $_SESSION["modules"][] = [$_POST["addModName"], $_POST["addMcs"]];
                $_SESSION["mcSum"] = $_SESSION["mcSum"] + $_POST["addMcs"];
            }
        } else if ($_POST["action"] === "Remove") {
            // Code to remove the module
            $modToRemove = explode(",", $_POST["moduleDropDown"]);
            $index = 0;
            foreach ($modules as $mod) {
                if ($mod[0] == $modToRemove[0] && $mod[1] == $modToRemove[1]) {
                    break;
                }
                $index = $index + 1;
            }
            $_SESSION["mcSum"] -= $modToRemove[1];
            array_splice($modules, $index, 1);
            $_SESSION["modules"] = $modules;
        }
    }

    if (empty($addModNameErr) && empty($addMcsErr)) {
        // Redirect to another page or display success message
        header("Location: /index.php");
        exit();
    }
}

// Include the header (navigation)
include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php');
?>
<section id="content" , style="margin-bottom: 80px">
    <ul class="nav nav-pills nav-justified" style="justify-content: center">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/src/forms/modules.php">Modules</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/countdown.php">PQE and PhD Defense</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/src/forms/hours.php">Teaching, Research and Other Duties</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-6">
            <div class="container" style="width: 75%; min-width: 300px">
                <div class="font-weight-bold">
                    Add Module
                </div>
                <br>
                <form action="modules.php" method="POST">
                    <div class="justify-content-center row mb-3">
                        <label class="form-label col-lg-4 col-form-label" style="text-align: right">Module Name:</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="addModName">
                        </div>
                    </div>
                    <div class="error-msg"><?php echo $addModNameErr; ?></div>
                    <br>
                    <div class="justify-content-center row mb-3">
                        <label class="form-label col-lg-4 col-form-label" style="text-align: right">Number of Mcs ( 4 /
                            8 ):</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="addMcs">
                        </div>
                    </div>
                    <div class="error-msg"><?php echo $addMcsErr; ?></div>
                    <br>
                    <input type="submit" name="action" value="Add">
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="container" style="width: 75%; min-width: 300px">
                <div class="font-weight-bold">
                    Remove Module
                </div>
                <br>
                <form action="modules.php" method="POST">
                    <select name="moduleDropDown">
                        <?php
                        foreach ($modules as $module) {
                            echo "<option value='$module[0],$module[1]'>$module[0] ($module[1] mcs)</option>";
                        }
                        ?>
                    </select><br>
                    <br>
                    <input type="submit" name="action" value="Remove">
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Include the footer -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
