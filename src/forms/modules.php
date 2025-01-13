<?php
// form.php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/src/database/db.php';

// Initialise DB
$conn = init_connection();
$studentID = 1;

$addModNameErr = $addMcsErr = "";
$modules = $modules = fetchModules($conn, $studentID);

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
                $value = (int)$_POST["addMcs"];
                insertStudentModule($conn, $_POST["addModName"], $value, $studentID);
            }
        } else if ($_POST["action"] === "Remove") {
            // Code to remove the module
            $modToRemove = explode(",", $_POST["moduleDropDown"]);
            removeModule($conn, $modToRemove[0], $modToRemove[1], $studentID);
        }
    }

    if (empty($addModNameErr) && empty($addMcsErr)) {
        // Redirect to another page or display success message
        header("Location: /index.php");
        exit();
    }
}
?>
    <div class="row">
        <div class="col-md-6">
            <div class="container" style="width: 75%; min-width: 300px">
                <div class="font-weight-bold">
                    Add Module
                </div>
                <br>
                <form action="" method="POST">
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
                <form action="" method="POST">
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
