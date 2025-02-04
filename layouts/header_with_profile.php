<header class="mobile-header notification_header">
    <div class="back_button_strip back_button_strip_new">
        <div class="back_button">
            <button onclick="history.back()" style="background: none; cursor: pointer;">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="page_title">
                <h1>
                    <?php echo ($page_title != null) ? ($page_title) : ("Page Title Now Set"); ?>
                </h1>
            </div>
        </div>
        <div class="settings mobile-only">
            <div class="profile-image">
                <img src="/assets/images/profile.png" alt="Profile Image">
            </div>
        </div>
    </div>
</header>