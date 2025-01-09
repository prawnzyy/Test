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

// Set Default values ( PQE and PhD Defense Date)
$currentDate = date("Y-m-d H:i:s");

$_SESSION["pqeDate"] = !empty($_POST["pqeDate"])
    ? ($_POST["pqeDate"])
    : ($_SESSION["pqeDate"] ?? "2024-04-22 00:00:00");
$pqeDate = $_SESSION["pqeDate"];

$_SESSION["phdDefDate"] = !empty($_POST["phdDefDate"])
    ? ($_POST["phdDefDate"])
    : ($_SESSION["phdDefDate"] ?? "2026-04-22 00:00:00");
$phdDefDate = $_SESSION["phdDefDate"];

// Set Default Values ( Done and Total Hours)
$_SESSION["teachingHoursDone"] = ($_SESSION["teachingHoursDone"] ?? 10);
$_SESSION["teachingHoursTotal"] = ($_SESSION["teachingHoursTotal"] ?? 40);
$teachingHoursDone = (int)$_SESSION["teachingHoursDone"];
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

// Include the header (navigation)
include 'includes/header.php';
?>
    <main style="margin-bottom: 80px">
        <div class="row m-2">
            <div class="col-md-3 d-flex" style="flex-direction: column; align-items: stretch; justify-content: space-between;">
                <div class="row" style="margin-right: 0px;">
                    <div class="profile container-fluid flex-grow-1" style="overflow: hidden; margin-bottom: 0px">
                        <img class="profile-img" src="/images/sherry.png" alt="Profile Picture">
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
                </div>
                <div class="row" style="margin-right: 0px;">
                    <div class="profile container-fluid flex-grow-1" style="font-weight: bold; margin-bottom: 0px">
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
            </div>
            <div class="col-md-9"
                 style="display: flex; flex-direction: column; align-items: stretch; justify-content: space-between">
                <div class="row flex-grow-1">
                    <div class="container-fluid" style="margin-bottom: 0px">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="font-weight-bold">
                                    % to Graduation
                                </div>
                                <?php
                                echo "<circle-progress text-format='percent' value=$graduationPercent max='100'></circle-progress>"
                                ?>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6 font-weight-bold" style="text-align: left;">Completed Modules
                                    </div>
                                    <?php
                                    echo "<div class='col-sm-6' style='text-align: right;'> $mcSum / 64 MCs Completed</div>"
                                    ?>
                                </div>
                                <div class="module-container">
                                    <?php
                                    function makeCard($elem)
                                    {
                                        $name = $elem[0];
                                        $mc = $elem[1];
                                        echo "<div class='module-card'>
                                                <div class='name'>$name</div>
                                                <div style='text-align: left'>{$mc} units</div>
                                              </div>";
                                    }

                                    array_walk($modules, 'makeCard');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row flex-grow-1">
                    <div class="pqe col-sm-6 d-flex" style="padding-left: 0px !important;">
                        <div class="container flex-grow-1" style="margin-bottom: 0px">
                            <div class="font-weight-bold" style="text-align: left; margin-bottom: 5px">
                                PQE
                            </div>
                            <div style="display: flex">
                                <div class="clock-countdown col-xl-2 col-md-3"
                                     style="background-color: lightpink; margin-left: 0px !important;">
                                    <?php
                                    $seconds = max(strtotime($pqeDate) - strtotime($currentDate), 0);
                                    $days = floor($seconds / 86400);
                                    echo "<div>$days</div>";
                                    ?>
                                    <div>Days</div>
                                </div>
                                <div class="clock-countdown col-xl-2 col-md-3"
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
                    <div class="col-sm-6 d-flex" style="padding-right: 0px !important; padding-left: 0px !important;">
                        <div class="container flex-grow-1" style="margin-bottom: 0px">
                            <div class="font-weight-bold" style="text-align: left; margin-bottom: 5px">
                                PhD Defense
                            </div>
                            <div style="display: flex">
                                <div class="clock-countdown col-xl-2 col-md-3"
                                     style="background-color: lightpink; margin-left: 0 !important;">
                                    <?php
                                    $seconds = max(strtotime($phdDefDate) - strtotime($currentDate), 0);
                                    $days = floor($seconds / 86400);
                                    echo "<div>$days</div>";
                                    ?>
                                    <div>Days</div>
                                </div>
                                <div class="clock-countdown col-xl-2 col-md-3"
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
                <div class="row flex-grow-1">
                    <div class="container-fluid" style="margin-bottom: 0px;">
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
                                <div class="progress progress-hours" style="height: 5px">
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
                                <div class="progress progress-hours" style="height: 5px">
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
                                <div class="progress progress-hours" style="height: 5px">
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
    </main>

    <!-- Include the footer -->
<?php include 'includes/footer.php'; ?>