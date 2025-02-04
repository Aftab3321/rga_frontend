<?php
?>
<header class="mobile-header notification_header">
    <div class='container'>
        <div class='header-wrapper d-flex align-items-center justify-content-between'>
            <div class='header-back'>
                <?php if (!isset($hide_back_button)): ?>
                    <button onclick="history.back()" style="background: none; border: none; cursor: pointer;">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                <?php endif; ?>
            </div>
            <div class='header-title mx-auto'>
                <h1 class="d-inline mx-auto" style="margin: 0; font-size: 1.5em;">
                    <?php echo ($page_title != null) ? ($page_title) : ("Page Title Not Set"); ?>
                </h1>
            </div>
            <div class='header-notifications'>
                <?php if (!isset($hide_notifications)): ?>
                    <div class="notifications">
                        <a href="/all_notifications">
                            <span class="material-icons" style="color: #d02128; font-size: 35px">notifications</span>
                            <span class="notifications-labels">2</span>
                        </a>
                        
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>