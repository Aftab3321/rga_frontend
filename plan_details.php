<?php

$page_title = "Select Plan";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php
if (isset($_GET['tab'])) {
    $activeTab = $_GET['tab'];
}
?>

<div id="root2" class="insurance_page plan_details_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_profile.php');
    ?>
    <div class="page_wrapper pt-5">
        <ul class="categories nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link <?php echo (isset($activeTab) && $activeTab == "life_insurance") ? "active" : ""; ?>" data-bs-toggle="tab"
                    href="#life_insurance" id="life-tab">
                    <div class="category_1 category_item">
                        <div class="icon_wrapper">
                            <img src="/assets/Icons/life_primary.svg" alt="">
                        </div>
                        <div class="category_title">
                            <h2>Life</h2>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (isset($activeTab) && $activeTab == "trauma_insurance") ? "active" : ""; ?>" data-bs-toggle="tab"
                    href="#trauma_insurance" id="trauma-tab">
                    <div class="category_2 category_item">
                        <div class="icon_wrapper">
                            <img src="/assets/Icons/trauma_primary.svg" alt="">
                        </div>
                        <div class="category_title">
                            <h2>Critical Illness</h2>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (isset($activeTab) && $activeTab == "income_protection") ? "active" : ""; ?>" data-bs-toggle="tab"
                    href="#income_protection" id="income-tab">
                    <div class="category_3 category_item">
                        <div class="icon_wrapper">
                            <img src="/assets/Icons/income_protection.svg" alt="">
                        </div>
                        <div class="category_title">
                            <h2>Income Protection</h2>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
        <div class="insurance_detail_wrapper">
            <div class="tab-pane active" id="life_insurance">
                <form action="" id="userDetails--form" data-tab="<?php echo (isset($activeTab)) ? $activeTab : ""; ?>">
                    <div class="insurance_form-contents">
                        <div class="insurance_title page_main_title">
                            <h2>
                                Enter Details
                            </h2>
                        </div>
                        <div class="insurance_personal_details">
                            <div class="form-group">
                                <h2 class="fs-5 fw-bold">Date of birth</h2>
                                <div class="dob_wrapper">
                                    <input type="date" id="date_of_birth_input" name="dob" placeholder="Date of birth" class="date_of_birth">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <h2 class="fs-5 fw-bold">Gender</h2>
                                <div class="gender_wrapper">

                                    <div class="male radio_button">
                                        <label for="gender_male">Male</label>
                                        <input type="radio" name="gender" value="1" id="gender_male">
                                    </div>
                                    <div class="female radio_button">
                                        <label for="gender_female">Female</label>
                                        <input type="radio" name="gender" value="2" id="gender_female">
                                    </div>
                                    <div class="other radio_button">
                                        <label for="gender_other">Other</label>
                                        <input type="radio" name="gender" value="3" id="gender_other">
                                    </div>
                                </div>
                            </div>
                            <div class="insurance_form_action mt-5">
                                <button type="submit" class="button primary-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="tab-content">
                <div class="tab-pane" id="trauma_insurance">
                    <div class="insurance_title page_main_title">
                        <h2>
                            Trauma
                        </h2>
                    </div>
                </div>
                <div class="tab-pane" id="income_protection">
                    <div class="insurance_title page_main_title">
                        <h2>
                            Income Protection
                        </h2>
                    </div>
                </div>

            </div> -->
        </div>
        <!-- <div class="tips_rewards_button">
                <button class="primary-button">Tips and Rewards</button>
            </div> -->
    </div>
    <div class="bottom-navigation desktop-only"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        
        try {
            var urlParams = new URLSearchParams(window.location.search);

            // Get the 'tab' parameter value
            var tab = urlParams.get('tab');

            if (tab) {
                console.log(tab);
                // Activate the tab with the corresponding ID
                $('.nav-item a[href="#' + tab + '"]').tab('show');
            }

            // Update the URL when a user clicks on a tab
            $('.nav-item a').on('click', function(e) {
                e.preventDefault();
                var tabId = $(this).attr('href').substring(1); // Get the tab ID (without the #)

                // Activate the clicked tab
                $(this).tab('show');


                urlParams.set('tab', tabId); // Update the 'tab' parameter
                // Update the query string in the URL without reloading the page
                var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + urlParams.toString(); // Construct the new URL with updated params
                history.pushState({
                    path: newUrl
                }, '', newUrl);
            });


        } catch (error) {
            console.error("no tabs are active currently");
        }



        $("#userDetails--form").on("submit", (e) => {
            
            e.preventDefault();
            var activeTab = $(e.currentTarget).data("tab");
            var data = $(e.currentTarget).serialize();

            var formData = {
                "requestType": "addUserGender",
                "formData": data
            }
            console.log(formData);
            makeAjaxCall("/scripts/requestAPI.php", "POST", formData)
                .done((response) => {
                    if (response.message.includes("inserted successfully")) {
                        window.location.assign("/insurance?tab=" + activeTab);
                    }
                })
                .fail((xhr, status, error) => {
                    console.log(xhr.responseText);
                })
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>