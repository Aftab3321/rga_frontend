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
        <div class="settings">
            <div class="nmobile-only">
                <details>
                    <summary><i class="fa-solid fa-magnifying-glass"></i></summary>
                    <div class="details-dropdown">
                        <form action="" id="search-form">
                            <div class="search-feild-container">
                                <input type="text" class="form-control">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </details>
            </div>
        </div>
    </div>
</header>