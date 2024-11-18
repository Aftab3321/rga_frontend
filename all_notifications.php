<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php

if (!$session->isUserLoggedIn()) {
    redirect("/login");
}

$user = current_user();

$page_title = "Notification";
$hide_notifications = true;
?>

<div id="root2" class="index-page notifications_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php');
    ?>
    <main>
        <div class="body-layout">
            <div class="notifications mt-4">
                <div class="notifications_wrapper">
                    <div class="notification" id="notification_1">
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
                        <div class="cross_button">
                            <a href="#" data-id='1' class='remove_notifiation'>
                                <span class="material-symbols-outlined">
                                    backspace
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="notification" id="notification_2">
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
                        <div class="cross_button">
                            <a href="#" data-id='2' class='remove_notifiation'>
                                <span class="material-symbols-outlined">
                                    backspace
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="notification" id="notification_3">
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
                        <div class="cross_button">
                            <a href="#" data-id='3' class='remove_notifiation'>
                                <span class="material-symbols-outlined">
                                    backspace
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="notification" id="notification_4">
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
                        <div class="cross_button">
                            <a href="#" data-id='4' class='remove_notifiation'>
                                <span class="material-symbols-outlined">
                                    backspace
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-navigation">
                <nav>
                    <ul>
                        <li class="active">
                            <a href="#">
                                <i class="fa-solid fa-house"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <p>History</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-credit-card"></i>
                                <p>Card</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-user"></i>
                                <p>profile</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        $(".notifications_page .bottom-navigation li").on("click", (e) => {
            e.preventDefault();
            $(".notifications_page .bottom-navigation li").removeClass("active");
            $(e.currentTarget).addClass("active");
        })


        $(document).on("click", ".remove_notifiation", (e) => {
            e.preventDefault();
            let data_id = $(e.currentTarget).data("id");
            let notification_id = "notification_" + data_id;
            $("#"+notification_id).remove();
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>