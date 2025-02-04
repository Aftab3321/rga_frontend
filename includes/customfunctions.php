<?php
function createHeader($showBackButton, $showNotifications, $pageTitle) {
    echo '<header class="mobile-header notification_header">';
    echo "<div class='container'>";
        echo "<div class='header-wrapper d-flex justify-content-between'>";
            echo "<div class='header-back'>";
            // Back Button
            if ($showBackButton) {
                echo '<button onclick="history.back()" style="background: none; border: none; cursor: pointer;">';
                echo '<i class="fa-solid fa-arrow-left"></i>'; // Replace with actual icon path
                echo '</button>';
            }
            echo "</div>";
            echo "<div class='header-title mx-auto' >";
                // Title
                echo '<h1 class="d-inline mx-auto" style="margin: 0; font-size: 1.5em;">' . htmlspecialchars($pageTitle) . '</h1>';
            echo "</div>";
            echo "<div class='header-notifications'>";
            // Notifications Icon
            if ($showNotifications) {
                echo '<div style="position: relative;">';
                echo '<span class="material-icons" style="color: #D02128; font-size: 24px;">notifications</span>'; // Replace with actual icon path
                echo '<span class="notifications-labels" >2</span>'; // Example notification count
                echo '</div>';
            }
            echo "</div>";
        echo "<div>";
    echo "<div>";

    echo '</header>';
}

//// bank home header
function createBankHomeHeader() {
    echo '<header class="desktop_bank_header">';
    echo "<div class='container-fluid'>";
        echo "<div class='header-wrapper d-flex justify-content-between'>";
            echo "<div class='header-logo d-flex gap-2'>";
                echo "<div class='logo'>";
                    echo "<img src='./assets/images/site-logo.svg' class=''>";
                echo "</div>";
                echo "<div class='header-username-wrapper'>";
                    echo "<h2 class='header-username'>John Smith</h2>";
                echo "</div>";
            echo "</div>";
            echo "<div class='header-notifications-panel'>";
                echo "";
            echo "</div>";
        echo "<div>";
    echo "<div>";

    echo '</header>';
}
?>
