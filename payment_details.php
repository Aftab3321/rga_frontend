<?php

$page_title = "Payment";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<div id="root2" class="insurance_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_profile.php');
    ?>
    <div class="page_wrapper">
        <div class="tab_main_image">
            <div class="main_image_wrapper">
                <img src="/assets/Icons/Payment hero illustration.svg" alt="Payment Image">
            </div>
        </div>
        <div class="insurance_detail_wrapper">
            <div class="card_details">
                <p class="card_details">Visa <span class="card_number">**********250</span></p>
                <a href="#" class="change_card_link">Change</a>
            </div>
            <div class="select_payment_method">
                <div class="method_card">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    Credit / Debit / ATM Card
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="accordion-body-card-details">
                                        <form action="" method="" id="card_info_form">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="full_name_card"
                                                    placeholder="Your Full Name">
                                                <label for="full_name_card">Your Full Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control"
                                                    id="card_num_card" placeholder="Card Number">
                                                <label for="card_num_card">Card Number</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control"
                                                            id="date_on_card">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control"
                                                            id="cvv_on_card" placeholder="CVV">
                                                        <label for="cvv_on_card">CVV</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-action mt-4">
                                                <button type="submit" class="button primary-button">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Cash on Payment
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="accordion-body-card-details">
                                        <form action="" method="" id="cash_info_form">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="full_name_card"
                                                    placeholder="Your Full Name">
                                                <label for="full_name_card">Your Full Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control"
                                                    id="card_num_card" placeholder="Card Number">
                                                <label for="card_num_card">Card Number</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control"
                                                            id="date_on_card">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control"
                                                            id="cvv_on_card" placeholder="CVV">
                                                        <label for="cvv_on_card">CVV</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-action mt-4">
                                                <button type="submit" class="button primary-button">Pay Now</button>
                                            </div>
                                        </form>
                                    </div>
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










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        var sdfjskl = sessionStorage.getItem("no_answer_selected");
        console.log(sdfjskl);
        if (sessionStorage.getItem("no_answer_selected") === 'true' || sessionStorage.getItem("question_answers_cleared") === null) {
            window.location.assign("/answer_questions");
        } else {
            console.log("false conditions");
        }
        $("ul.categories li").on("click", (e) => {
            e.preventDefault();
            $("ul.categories li").removeClass("active");
            $(e.currentTarget).addClass("active");
        })

        var total_amount = 0;
        $(".add_amount").each((index, element) => {
            total_amount += parseInt($(element).text())
        })
        $("#total_amount").text(total_amount);


        $("#card_info_form").on("submit", (e) => {
            e.preventDefault();
            window.location.assign("/payment_successful")
        })
        $("#cash_info_form").on("submit", (e) => {
            e.preventDefault();
            window.location.assign("/payment_successful")
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>