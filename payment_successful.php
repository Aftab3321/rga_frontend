<?php

$page_title = "Payment Successful";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<div id="root2" class="insurance_page payment_successful">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_profile.php');
    ?>
    <div class="page_wrapper">
        <div class="tab_main_image">
            <div class="main_image_wrapper">
                <img src="/assets/Icons/Payment Successful.svg" alt="Payment Image">
            </div>
        </div>
        <div class="insurance_detail_wrapper">
            <div class="payment_successful_container">
                <div class="payment_messages">
                    <h2>Payment Successful</h2>
                    <p class="policy">Policy No: <span class="policy_number">CB2015-2345</span></p>
                    <p class="thankyou_message">Thank you for choosing our services and trust to help you with deposit</p>
                </div>
                <div class="action_buttons">
                    <a href="/transactions" class="button secondary-button">Transaction History</a>
                    <a href="/bank_home" class="button primary-button">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-navigation desktop-only"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        sessionStorage.removeItem("no_answer_selected") ;
        sessionStorage.removeItem("question_answers_cleared");
    })
</script>
<?php include './layouts/footerEnd.php'; ?>