<?php
// form.php

$currentPage = "modules";
// Logic code here

if (isset($_GET['value'])) {
    $currentPage = $_GET['value'];
}

// Include the header (navigation)
include 'includes/header.php';
?>
    <script>
        function setActive(value) {
            window.location.href = `form.php?value=${value}`;
        }
    </script>
    <main style="margin-bottom: 80px">
        <ul class="nav nav-pills nav-justified">
            <li id="module" class="nav-item">
                <a data-toggle="tab" class="module nav-link <?= $currentPage === 'modules' ? 'active' : '' ?>" href="#" onclick=setActive("modules")>Modules</a>
            </li>
            <li id="PQE" class="nav-item">
                <a data-toggle="tab" class="PQE nav-link <?= $currentPage === 'countdown' ? 'active' : '' ?>" href="#" onclick=setActive("countdown")>PQE and PhD
                    Defense</a>
            </li>
            <li id="hours" class="nav-item">
                <a data-toggle="tab" class="hours nav-link <?= $currentPage === 'hours' ? 'active' : '' ?>" href="#" onclick=setActive("hours")>Teaching, Research and
                    Other Duties</a>
            </li>
        </ul>
        <?php
            include $_SERVER['DOCUMENT_ROOT'].'/src/forms/'.$currentPage.'.php';
        ?>
    </main>

    <!-- Include the footer -->
<?php include 'includes/footer.php'; ?>