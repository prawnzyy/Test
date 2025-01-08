<?php
session_start();
// index.php
$pageTitle = "Home Page";

// Lists / Arrays for Modules with MC
$_SESSION["modules"] = $_SESSION["modules"] ?? array(["AR5652 PhD Seminar", 4], ["AR5652 Phd Lesson", 8], ["AR5653 Phd Thesis", 8], ["AR6764 R-Programming", 4]);
$modules = $_SESSION["modules"];
$_SESSION["mcSum"] = ($_SESSION["mcSum"] ?? 24);
$mcSum = $_SESSION["mcSum"];
$graduationPercent = $mcSum / 64 * 100;

// Setting of default
$currentDate = date("Y-m-d H:i:s");

$_SESSION["pqeDate"] = !empty($_POST["pqeDate"])
    ? ($_POST["pqeDate"])
    : ($_SESSION["pqeDate"] ?? "2024-04-22 00:00:00");
$pqeDate = $_SESSION["pqeDate"];

$_SESSION["phdDefDate"] = !empty($_POST["phdDefDate"])
    ? ($_POST["phdDefDate"])
    : ($_SESSION["phdDefDate"] ?? "2026-04-22 00:00:00");
$phdDefDate = $_SESSION["phdDefDate"];

// Include the header (navigation)
include 'includes/header.php';

// Set Default Values
$_SESSION["teachingHoursDone"] = ($_SESSION["teachingHoursDone"] ?? 10);
$teachingHoursDone = (int)$_SESSION["teachingHoursDone"];
$_SESSION["teachingHoursTotal"] = ($_SESSION["teachingHoursTotal"] ?? 40);
$teachingHoursTotal = (int)$_SESSION["teachingHoursTotal"];
$teachingHoursPercent = floor($teachingHoursDone / $teachingHoursTotal * 100);

$_SESSION["researchHoursDone"] = ($_SESSION["researchHoursDone"] ?? 15);
$_SESSION["researchHoursTotal"] = ($_SESSION["researchHoursTotal"] ?? 40);
$researchHoursDone = (int)$_SESSION["researchHoursDone"];
$researchHoursTotal = (int)$_SESSION["researchHoursTotal"];
$researchHoursPercent = floor($researchHoursDone / $researchHoursTotal * 100);

$_SESSION["otherHoursDone"] = ($_SESSION["otherHoursDone"] ?? 30);
$_SESSION["otherHoursTotal"] = ($_SESSION["otherHoursTotal"] ?? 40);
$otherHoursDone = (int)$_SESSION["otherHoursDone"];
$otherHoursTotal = (int)$_SESSION["otherHoursTotal"];
$otherHoursPercent = floor($otherHoursDone / $otherHoursTotal * 100);
?>

    <main style="margin-bottom: 80px">
        <div class="row m-2">
            <div class="col-sm-3" style="height: 100%">
                <div class="container" style="text-align: left; overflow: hidden; height: 60%;">
                    <img class="profile-img" src="/images/sherry.png">
                    <b>Sherry Tan Xue Er
                        <br>
                        PGF Scholar</b>
                    <br>
                    Yr 4 PhD Student
                    <br>
                    School of Medicine
                    <br>
                    Department of Biochemistry
                </div>
                <div class="container" style="text-align: left; height: 40%; font-weight: bold">
                    Reminders
                    <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px; font-weight: normal !important;">
                        <div style="float: left; display: flex; align-items: center; padding: 10px">
                            <i class="bi bi-info-circle"></i>
                            <div style="padding-left: 10px">
                                Sit in for Sherry's Thesis Defense
                                <br>
                                Due 22 April 2023
                            </div>
                        </div>
                    </row>
                    <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px; font-weight: normal !important;">
                        <div style="float: left; display: flex; align-items: center; padding: 10px">
                            <i class="bi bi-info-circle"></i>
                            <div style="padding-left: 10px">
                                Sit in for Sherry's Thesis Defense
                                <br>
                                Due 22 April 2023
                            </div>
                        </div>
                    </row>
                </div>
            </div>
            <div class="col-sm-9" style="height: 100%;">
                <div class="row" style="height: 30%;">
                    <div class="container-fluid" style="margin-bottom: 0 !important;">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="font-weight-bold">
                                    % to Graduation
                                </div>
                                <?php
                                echo "<circle-progress radius='200' value=$graduationPercent max='100'></circle-progress>"
                                ?>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6 font-weight-bold" style="text-align: left">Completed Modules
                                    </div>
                                    <?php
                                    echo "<div class='col-sm-6' style='text-align: right'> $mcSum / 64 MCs Completed</div>"
                                    ?>
                                </div>
                                <div class="module-container">
                                    <?php
                                    function makeCard($elem)
                                    {
                                        $name = $elem[0];
                                        $mc = $elem[1];
                                        echo "<div style='background-color: lightpink; padding: 5px; width: 200px; margin: 4px; border-radius: 6px'><div class='font-weight-bold' style='text-align: left'>$name</div>
                                            <div style='text-align: left'>{$mc} units</div></div>";
                                    }

                                    array_walk($modules, 'makeCard');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height: 40%;">
                    <div class="col-sm-6" style="padding-left: 0px !important;">
                        <div class="container">
                            <div class="font-weight-bold" style="text-align: left; margin-bottom: 5px">
                                PQE
                            </div>
                            <div style="display: flex">
                                <div class="col-sm-2"
                                     style="background-color: lightpink; margin-left: 0 !important;">
                                    <?php
                                    $seconds = max(strtotime($pqeDate) - strtotime($currentDate), 0);
                                    $days = floor($seconds / 86400);
                                    echo "<div>$days</div>";
                                    ?>
                                    <div>Days</div>
                                </div>
                                <div class="col-sm-2"
                                     style="background-color: lightpink;">
                                    <?php
                                    $seconds = max(strtotime($pqeDate) - strtotime($currentDate), 0);
                                    $hours = floor($seconds / 3600) % 24;
                                    echo "<div>$hours</div>";
                                    ?>
                                    <div>Hours</div>
                                </div>
                            </div>
                            <div style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
                                <div style="float: left; display: flex; align-items: center; padding: 10px">
                                    <?php
                                    if ($currentDate < $pqeDate) {
                                        echo "<i class='bi bi-info-circle' ></i>";
                                    } else {
                                        echo "<i class='bi bi-check2-all' style='color: green'></i>";
                                    }
                                    ?>
                                    <div style="padding-left: 10px; text-align: left">
                                        <div class="font-weight-bold">PhD Qualifying Oral Examination</div>
                                        <?php
                                        $timestamp = strtotime($pqeDate); // Convert to a timestamp
                                        $formattedDate = date('j F Y', $timestamp); // Format
                                        if ($currentDate < $pqeDate) {
                                            echo "Due ", $formattedDate;
                                        } else {
                                            echo "Done ", $formattedDate;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding-right: 0px !important; padding-left: 0px !important;">
                        <div class="container">
                            <div class="font-weight-bold" style="text-align: left; margin-bottom: 5px">
                                PhD Defense
                            </div>
                            <div style="display: flex">
                                <div class="col-sm-2"
                                     style="background-color: lightpink; margin-left: 0 !important;">
                                    <?php
                                    $seconds = max(strtotime($phdDefDate) - strtotime($currentDate), 0);
                                    $days = floor($seconds / 86400);
                                    echo "<div>$days</div>";
                                    ?>
                                    <div>Days</div>
                                </div>
                                <div class="col-sm-2"
                                     style="background-color: lightpink;">
                                    <?php
                                    $seconds = max(strtotime($phdDefDate) - strtotime($currentDate), 0);
                                    $hours = floor($seconds / 3600) % 24;
                                    echo "<div>$hours</div>";
                                    ?>
                                    <div>Hours</div>
                                </div>
                            </div>
                            <div style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
                                <div class="col-sm-6"
                                     style="float: left; display: flex; align-items: center; padding: 10px">
                                    <?php
                                    if ($currentDate < $phdDefDate) {
                                        echo "<i class='bi bi-info-circle' ></i>";
                                    } else {
                                        echo "<i class='bi bi-check2-all' style='color: green'></i>";
                                    }
                                    ?>

                                    <div style="padding-left: 10px; text-align: left">
                                        <div class="font-weight-bold">PhD Oral Defense</div>
                                        <?php
                                        $timestamp = strtotime($phdDefDate); // Convert to a timestamp
                                        $formattedDate = date('j F Y', $timestamp); // Format
                                        if ($currentDate < $phdDefDate) {
                                            echo "Due ", $formattedDate;
                                        } else {
                                            echo "Done ", $formattedDate;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height: 30%; display: flex; align-self: end">
                    <div class="container-fluid" style="margin-top: 0 !important;">
                        <div class="row font-weight-bold" style="text-align: left; padding-left: 15px">
                            Teaching, Research and Other Duties
                        </div>
                        <br>
                        <div class="row hours-font">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6 font-weight-bold" style="text-align: left">Teaching Duties
                                    </div>
                                    <div class="col-sm-6" style="text-align: right"> <?= $teachingHoursDone ?>
                                        / <?= $teachingHoursTotal ?> Hours Completed
                                    </div>
                                </div>
                                <div class="progress" style="height: 5px">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow=<?= $teachingHoursPercent ?> aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: <?= $teachingHoursPercent ?>%; background-color: blue !important;"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6 font-weight-bold" style="text-align: left">Research Duties
                                    </div>
                                    <div class="col-sm-6" style="text-align: right;"> <?= $researchHoursDone ?>
                                        / <?= $researchHoursTotal ?> Hours Completed
                                    </div>
                                </div>
                                <div class="progress" style="height: 5px">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow=<?= $researchHoursPercent ?> aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: <?= $researchHoursPercent ?>%; background-color: yellow !important;"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6 font-weight-bold" style="text-align: left">Other Duties</div>
                                    <div class="col-sm-6" style="text-align: right"> <?= $otherHoursDone ?>
                                        / <?= $otherHoursTotal ?> Hours Completed
                                    </div>
                                </div>
                                <div class="progress" style="height: 5px">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow=<?= $otherHoursPercent ?> aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width: <?= $otherHoursPercent ?>%; background-color: lightskyblue !important;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    <h2>Welcome to NUSGS UI/UX Test</h2>-->
        <!--    <p>This is the homepage where you will need to display the dashboard. Have fun :D</p>-->
    </main>

    <!-- Include the footer -->
<?php include 'includes/footer.php'; ?>