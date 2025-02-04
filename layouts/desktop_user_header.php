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
                <!-- <div class="right-column">
                    <div class="d-flex align-items-center justify-content-between gap-5">
                        <div class="search-bar--wrapper">
                            <div class="search">
                                <i class="material-icons">search</i>
                                <input
                                    type="text"
                                    placeholder="Search your WordPlace"
                                    name="search"
                                    id="search" />
                            </div>
                        </div>
                        <div class="notifications-panel d-flex align-items-end gap-3">
                            <div class="available_balance">
                                <h2 class="the_balance">
                                    $<span class="balance_span"><?php //echo (isset($wallet['balance'])) ? $wallet['balance'] : 0 ?></span>
                                </h2>
                                <p class="balance_message">Available Balance</p>
                            </div>
                            <div class="notifications">
                                <details>
                                    <summary>
                                        
                                        <i class="material-icons " style="color: #d02128; font-size: 35px">notifications</i>
                                        <span class="notifications-labels">2</span>
                                    </summary>
                                    <div class="details-dropdown">
                                        <div class="notification">
                                            <div class="logo-image">
                                                <div class="icon_notification">
                                                    <img src="/assets/Icons/Risk_Notification.svg">
                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <div class="notification-title">
                                                    <h2>Understanding your risk appetite can protect your finances and your home.</h2>
                                                </div>
                                                <div class="notification-details">
                                                    <p>Find out your risk appetite now.</p>
                                                </div>
                                                <div class="notification-action">
                                                    <a href="/bank_home" class="button text-decoration-none primary-button">Risk Vault</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification">
                                            <div class="logo-image">
                                                <div class="icon_notification">
                                                    <span>45x45</span>
                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <div class="notification-title">
                                                    <h2>Your money is already in your account! The $32,000 you withdrew on 05/08/2020 was credited</h2>
                                                </div>
                                                <div class="notification-meta">
                                                    <div class="date-mata">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <span class="date">20 Feb, 2020</span>
                                                    </div>
                                                    <div class="time-mata">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <span class="time">12.00 am</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification">
                                            <div class="logo-image">
                                                <div class="icon_notification">
                                                    <span>45x45</span>
                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <div class="notification-title">
                                                    <h2>We will be in maintenance! We will be offline on 05/07/2020 from 3:00 am to 7:00 am</h2>
                                                </div>
                                                <div class="notification-meta">
                                                    <div class="date-mata">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <span class="date">20 Feb, 2020</span>
                                                    </div>
                                                    <div class="time-mata">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <span class="time">12.00 am</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="notification">
                                            <div class="logo-image">
                                                <div class="icon_notification">
                                                    <span>45x45</span>
                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <div class="notification-title">
                                                    <h2>Discover the best places to eat
                                                        near you. There’s a lot of choice!</h2>
                                                </div>
                                                <div class="notification-meta">
                                                    <div class="date-mata">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <span class="date">20 Feb, 2020</span>
                                                    </div>
                                                    <div class="time-mata">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <span class="time">12.00 am</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</header>