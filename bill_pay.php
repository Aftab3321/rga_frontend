<?php 
$page_title = "Bill Pay";

?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php

$desktop_only_sidebar = true;
?>

<div id="root2" class="pay_bill_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php');
    ?>
    <main>
        <div class="body-layout">
            <?php
                include($_SERVER['DOCUMENT_ROOT'] . '/layouts/user_sidebar.php');
            ?>
            <div class="main_page">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-section inner-section">
                            <div class="section-title desktop-only d-md-flex justify-content-between align-items-center">
                                <h2>Bill Pay</h2>
                            </div>
                            <div class="pay_bill_grid--container">
                                <div class="pay_bill-wrapper">
                                    <ul class="grid-items">
                                        <li><a href="#">
                                                <div class="pay_bill-item electricity">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/flash.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Electricity</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item water_bill">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/water.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Water</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item gas_bill">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/gas.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Gas Bill</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item food_order">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/shop.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Food Order</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item airfair">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/ticket.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Airfair</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item cable_bill">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/wire.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Cable</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item internet_bill">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/_015---Wifi.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Internet</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item hotel_booking">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/booking.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Hotel Booking</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item train_tickets">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/train.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Train Tickets</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item bus_tickets">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/bus.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Bus Tickets</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item movie_tickets">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/Lottery Ticket.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Movie Tickets</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a href="#">
                                                <div class="pay_bill-item other_bills">
                                                    <div class="pay_bill-icon">
                                                        <img src="/assets/Icons/dollar_bills.svg">
                                                    </div>
                                                    <div class="pay_bill-title">
                                                        <p>Other Bills</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_bill_section">
                                    <div class="more_bills_container">
                                        <div class="more_bills_details">
                                            <h2>More bills to pay hey?</h2>
                                            <p>Do you want to know your risk appetite?</p>
                                            <a href="/bank_home">
                                                <button class="button more_bills_button">Unlock your risk vault</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-navigation desktop-only"><?php include_once("./layouts/bottom_navigation.php") ?></div>
        </div>
    </main>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<?php include './layouts/footerEnd.php'; ?>