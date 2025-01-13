<?php
session_start();
date_default_timezone_set('Asia/Singapore');

require 'src/database/db.php';

// Initialise DB
$conn = init_connection();
//resetDB($conn);

// index.php
$pageTitle = "Home Page";
$studentID = 1; // HARDCODED VALUE!

function mcSum($modules) :int {
    $total = 0;
    foreach ($modules as $module) {
        $total += $module[1];
    }
    return $total;
}

// Fetch Modules
$modules = fetchModules($conn, $studentID);
$mcSum = mcSum($modules);
$graduationPercent = $mcSum / 64 * 100;

// Fetch Countdown dates ( PQE and PhD Defense Date)
$currentDate = date("Y-m-d H:i:s");
$dates = fetchDates($conn, $studentID);
$pqeDate = $dates[0];
$phdDefDate = $dates[1];

// Fetch Hours
$hours = fetchHours($conn, $studentID);
$typeHours = array("teachingHours", "researchHours", "otherHours");

for ($i = 0; $i < count($typeHours); $i++) {
    ${$typeHours[$i] . "Done"}  = $hours[$i * 2];
    ${$typeHours[$i] . "Total"}  = $hours[($i * 2) + 1];
    ${$typeHours[$i] . "Percent"}  = ${$typeHours[$i] . "Done"} / ${$typeHours[$i] . "Total"} * 100;
}

// Include the header (navigation)
include 'includes/header.php';
?>
    <main style="margin-bottom: 80px">
        <div class="row m-2">
            <div class="main-col2 col-md-3">
                <div class="profile container-fluid flex-grow-1" style="overflow: hidden;">
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

                <div class="profile container-fluid flex-grow-1" style="font-weight: bold;">
                    Reminders
                    <row class="reminder">
                        <div style="float: left; display: flex; align-items: center; padding: 10px">
                            <i class="bi bi-info-circle"></i>
                            <div style="padding-left: 10px">
                                Sit in for Sherry's Thesis Defense
                                <br>
                                Due 22 April 2023
                            </div>
                        </div>
                    </row>
                    <row class="reminder">
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
            <div class="main-col col-md-9">
                <div class="div flex-grow-1">
                    <div class="container-fluid">
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
                <div class="middle div flex-grow-1" style="display: flex; flex-direction: row">
                    <?php
                    $pqeDates = array($pqeDate, $phdDefDate);
                    $count = -1;
                    foreach ($pqeDates as $pqeDate) {
                        $count++;
                        ?>
                        <div class="pqe col-sm-6 d-flex" style="padding-left: 0px !important;">
                            <div class="container flex-grow-1">
                                <div class="font-weight-bold" style="text-align: left; margin-bottom: 5px">
                                    <?php echo $count ? "PhD Defense" : "PQE" ?>
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
                                            <div class="font-weight-bold">
                                                <?php echo $count ? "Phd Oral Defense" : "PhD Qualifying Oral Examination" ?>
                                            </div>
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
                    <?php }
                    ?>
                </div>
                <div class="div flex-grow-1" style="align-content: end">
                    <div class="container-fluid">
                        <div class="row font-weight-bold" style="text-align: left; padding-left: 15px">
                            Teaching, Research and Other Duties
                        </div>
                        <br>
                        <div class="row hours-font">
                            <?php
                            $duties = array("Teaching Duties", "Research Duties", "Other Duties");
                            $hours = array([$teachingHoursDone, $teachingHoursTotal, $teachingHoursPercent],
                                [$researchHoursDone, $researchHoursTotal, $researchHoursPercent],
                                [$otherHoursDone, $otherHoursTotal, $otherHoursPercent]);
                            for ($x = 0; $x < 3; $x++) {
                                ?>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-6 font-weight-bold" style="text-align: left">
                                            <?php echo $duties[$x] ?>
                                        </div>
                                        <div class="col-sm-6" style="text-align: right"> <?= $hours[$x][0] ?>
                                            / <?= $hours[$x][1] ?> Hours Completed
                                        </div>
                                    </div>
                                    <div class="progress progress-hours" style="height: 5px">
                                        <div class="progress-bar" role="progressbar"
                                             aria-valuenow=<?= $hours[$x][2] ?> aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width: <?= $hours[$x][2] ?>%; background-color: blue !important;"></div>
                                    </div>
                                </div>
                            <?php
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include the footer -->
<?php include 'includes/footer.php'; ?>