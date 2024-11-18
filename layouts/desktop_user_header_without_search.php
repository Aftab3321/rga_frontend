<?php

$user = current_user();
if (isset($user)) {
    $wallet = find_by_foreign_id("wallets", "user_id", $user['ID']);
}
?>

<header class="header_with_logo desktop-header">
    <div class="container-fluid">
        <div class="header-wrapper">
            <div class="d-flex justify-content-between px-4 align-items-center">
                <div class="left-column d-flex align-items-center gap-3">
                    <a href="#" class="text-decoration-none">
                        <div class="logo">
                            <img src="../assets/images/site_logo.svg" alt="RGA" />
                        </div>
                        <div class="div">
                            <h2 class="header_username"><?php echo (isset($user['username'])) ? $user['username'] : "John Smith"; ?></h2>
                            <a href="/scripts/logout" id="header_logout_buttton">Log Out</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>