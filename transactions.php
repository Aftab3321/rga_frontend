<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php

if (!$session->isUserLoggedIn()) {
    redirect("/login");
}

$user = current_user();
$desktop_only_sidebar = true;

$page_title = "Transactions History";
?>

<div id="root2" class="index-page transaction_page">
    <?php
        include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
        include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php');
    ?>
    <main>
        <!-- <div class="mobile-only">
            <div class="welcome-note">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="greetings">
                                <h2>Hello</h2>
                                <p>John Smith</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="available-balance">
                                <h2>Available Balance</h2>
                                <p>$<span class="aavailable-amount">23,450</span>.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="body-layout">
        <?php
            include($_SERVER['DOCUMENT_ROOT'] . '/layouts/user_sidebar.php');
        ?>
            <div class="main_page">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="transaction-section inner-section">
                            <div class="section-title">
                                <div class="row">
                                    <div class="col">
                                        <h2>All Transaction</h2>
                                    </div>
                                    <div class="col">
                                        <div class="transaction-filter d-flex">
                                            <a href="#">Clear Filter</a>
                                            <i class="fa-solid fa-filter"></i>
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-wrapper">
                                <div class="transaction-filters filters">
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Last week</option>
                                        </select>
                                    </div>
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Transactions</option>
                                        </select>
                                    </div>
                                    <div class="filter">
                                        <select name="" id="">
                                            <option value="0">Status</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-entries">
                                <div class="entries-wrapper">
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>

                                    <div class="entry_3 mortgage_payment">
                                        <div class="icon">
                                            <object data="/assets/images/site_logo.svg"></object>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">mortgage payment</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
                                        </div>
                                    </div>
                                    <div class="entry_3 in_process">
                                        <div class="icon">
                                            <span>45x45</span>
                                            <!-- <img src="/assets/Icons/wire.svg" alt=""> -->
                                        </div>
                                        <div class="entry_details">
                                            <h3 class="entry_title">Jhon Smuith</h3>
                                            <p class="entry_detail">In process</p>
                                        </div>
                                        <div class="entry_amount">
                                            <h3 class="entry-amount">$<span class="transaction_amount">-100</span></h3>
                                            <p class="transaction_date">10 Feb, 2020</p>
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