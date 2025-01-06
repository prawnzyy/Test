<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<?php
// index.php
$pageTitle = "Home Page";
$graduationPercent = 70;

// Lists / Arrays for Modules with MC
$modules = array(["AR5652 PhD Seminar", 4], ["AR5652 Phd Lesson", 8], ["AR5653 Phd Thesis", 8], ["AR6764 R-Programming", 4]);
$mcSum = 24;

// Logic code here
$currentDate = date("Y-m-d H:i:s");
$pqeDate = "2024-04-22 00:00:00";
$phdDefDate = "2026-05-22 00:00:00";

// Include the header (navigation)
include 'includes/header.php';
?>

<main style="margin-bottom: 80px;">
    <div class="row m-2" style="background-color: lightgrey;">
        <div class="col-sm-4">
            <div class="container" style="text-align: left; overflow: hidden">
                <img src="images/sherry.png" style="object-fit: cover; height: auto; width:100%">
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
            <div class="container" style="text-align: left">
                Reminders
                <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
                    <div style="float: left; display: flex; align-items: center; padding: 10px">
                        <i class="bi bi-info-circle"></i>
                        <div style="padding-left: 10px">
                            Sit in for Sherry's Thesis Defense
                            <br>
                            Due 22 April 2023
                        </div>
                    </div>
                </row>
                <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
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
        <div class="col-sm-8">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div>
                                % to Graduation
                            </div>
                            <?php
                            echo "<circle-progress value=$graduationPercent max='100'></circle-progress>"
                            ?>
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6 font-weight-bold" style="text-align: left">Completed Modules</div>
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
                                    echo "<div style='background-color: lightpink; padding: 5px; width: 250px; margin: 4px; border-radius: 6px'><div class='font-weight-bold' style='text-align: left'>$name</div>
                                            <div style='text-align: left'>{$mc} units</div></div>";
                                }

                                array_walk($modules, 'makeCard');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="container">
                        <div class="font-weight-bold" style="text-align: left">
                            PQE
                        </div>
                        <row style="display: flex">
                            <div class="col-sm-2"
                                 style="background-color: lightpink; text-align: center; font-size: 10px; padding: 5px">
                                <?php
                                $seconds = max(strtotime($pqeDate) - strtotime($currentDate), 0);
                                $days = floor($seconds / 86400);
                                echo "<div>$days</div>";
                                ?>
                                <div>Days</div>
                            </div>
                            <div class="col-sm-2"
                                 style="background-color: lightpink; text-align: center; font-size: 10px; padding: 5px">
                                <?php
                                $seconds = max(strtotime($pqeDate) - strtotime($currentDate), 0);
                                $hours = floor($seconds / 3600);
                                echo "<div>$hours</div>";
                                ?>
                                <div>Hours</div>
                            </div>
                        </row>
                        <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
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
                                    <br>
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
                        </row>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="container">
                        <div class="font-weight-bold" style="text-align: left">
                            PhD Defense
                        </div>
                        <row style="display: flex">
                            <div class="col-sm-2"
                                 style="background-color: lightpink; text-align: center; font-size: 10px; padding: 5px">
                                <?php
                                $seconds = max(strtotime($phdDefDate) - strtotime($currentDate), 0);
                                $days = floor($seconds / 86400);
                                echo "<div>$days</div>";
                                ?>
                                <div>Days</div>
                            </div>
                            <div class="col-sm-2"
                                 style="background-color: lightpink; text-align: center; font-size: 10px; padding: 5px">
                                <?php
                                $seconds = max(strtotime($phdDefDate) - strtotime($currentDate), 0);
                                $hours = floor($seconds / 3600) % 24;
                                echo "<div>$hours</div>";
                                ?>
                                <div>Hours</div>
                            </div>
                        </row>
                        <row style="background-color: lightpink; margin-top: 7px; border-radius: 8px">
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
                                    <br>
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
                        </row>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row font-weight-bold" style="text-align: left;">
                        Teaching, Research and Other Duties
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="row" style="font-size: 11px">
                                <div class="col-sm-6 font-weight-bold" style="text-align: left">Teaching Duties</div>
                                <div class="col-sm-6" style="text-align: right"> X/Y Hours Completed</div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                     aria-valuemax="100" style="width: 10%; background-color: blue !important;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row" style="font-size: 11px">
                                <div class="col-sm-6 font-weight-bold" style="text-align: left">Research Duties</div>
                                <div class="col-sm-6" style="text-align: right"> X/Y Hours Completed</div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                     aria-valuemax="100" style="width: 10%; background-color: yellow !important;"></div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row" style="font-size: 11px">
                                <div class="col-sm-6 font-weight-bold" style="text-align: left">Other Duties</div>
                                <div class="col-sm-6" style="text-align: right"> X/Y Hours Completed</div>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                     aria-valuemax="100"
                                     style="width: 10%; background-color: lightskyblue !important;"></div>
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-circle-progress/dist/circle-progress.min.js" type="module"></script>
</body>
</html>