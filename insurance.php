<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
$user = current_user();
if (isset($user) && $user['gender'] === Null || $user['age'] < 18) {
    redirect("/plan_details?source=insurance&tab=life_insurance", false);
}
$page_title = "Select Plan";
$user = current_user();
$thisUsersAge = $user['age'];
$thisUserGender = $user['gender'];
$packages = [
    "Life" => [
        "price" => [
            "1" => ["18-30" => 19.7, "31-50" => 17.8, "51+" => 81.6, "0" => 0],
            "2" => ["18-30" => 11.0, "31-50" => 14.1, "51+" => 58.8, "0" => 0],
        ],
        "contents" => [
            "Sum Insured" => 300000,
            "Payable on" => "Death or diagnosis of terminal illness",
            "Options & Extras" => "None included",
            "Premium Frequency" => "Monthly"
        ]
    ],
    "trauma" => [
        "price" => [
            "1" => ["18-30" => 19.8, "31-50" => 47.6, "51+" => 271.2, "0" => 0],
            "2" => ["18-30" => 27.2, "31-50" => 51.5, "51+" => 181.6, "0" => 0],
        ],
        "contents" => [
            "Sum Insured" => 100000,
            "Payable on" => "Diagnosis of one of the trauma conditions",
            "Options & Extras" => "None included",
            "Premium Frequency" => "Monthly"
        ]
    ],
    "disability" => [
        "price" => [
            "1" => ["18-30" => 24.7, "31-50" => 38.0, "51+" => 121.8, "0" => 0],
            "2" => ["18-30" => 33.8, "31-50" => 54.8, "51+" => 177.3, "0" => 0],
        ],
        "contents" => [
            "Monthly Benefit" => 3000,
            "Replacement Ratio" => "70%",
            "Waiting Period" => "30 Days",
            "Payable on" => "Loss of ability to work due to sickness or accident",
            "Benefit Period" => "5 Years",
            "Premium Frequency" => "Annual"
        ]
    ]
]
?> 
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<div id="root2" class="insurance_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_profile.php');
    ?>
    <div class="insurance_page_wrapper page_wrapper">
        <ul class="categories nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" 
                    href="#life_insurance">
                    <div class="category_1 category_item">
                        <div class="icon_wrapper">
                            <img src="/assets/Icons/life_primary.svg" alt="">
                        </div>
                        <div class="category_title">
                            <h2>The Life</h2>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab"
                    href="#trauma_insurance">
                    <div class="category_2 category_item">
                        <div class="icon_wrapper">
                            <img src="/assets/Icons/trauma_primary.svg" alt="">
                        </div>
                        <div class="category_title">
                            <h2>Trauma</h2>
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab"
                    href="#income_protection">
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
            <div class="tab-content">
                <div class="tab-pane active" id="life_insurance">
                    <form action="" class="insurance_form" data-tab="life_insurance">
                        <div class="insurance_form_contents">
                            <div class="insurance_title page_main_title">
                                <h2>
                                    Life Insurance
                                </h2>
                            </div>

                            <div class="insurance_details">
                                <?php foreach($packages['Life']['contents'] as $key => $value): ?>
                                    <div class="item date_of_guarantee">
                                        <h2 class="item_title"><?php echo $key; ?></h2>
                                        <p class="item_value w-50 text-wrap text-end"><?php echo $value; ?></p>
                                    </div>
                                <?php endforeach; ?>

                                <?php 
                                    $userAge = ($thisUsersAge >= 18 && $thisUsersAge <= 30) ? "18-30" :
                                    (($thisUsersAge >= 31 && $thisUsersAge <= 50) ? "31-50" :
                                    (($thisUsersAge >= 51) ? "51+" : "0"));
                                ?>
                                <div class="item vehicle_insurance">
                                    <h2 class="item_title">Premium</h2>
                                    <p class="item_value amount">$<span id="vehicle_insurance_amount" class="add_amount"><?php echo $packages['Life']['price'][$thisUserGender][$userAge]; ?></span></p>
                                </div>
                                
                                <!-- <div class="item date_of_guarantee">
                                    <h2 class="item_title">Date of Guarantee</h2>
                                    <p class="item_value">20 Apr, 2020</p>
                                </div>
                                <div class="item type_of_insurance">
                                    <h2 class="item_title">Type of Insurance</h2>
                                    <p class="item_value">Standard</p>
                                </div>
                                <div class="item time_duration">
                                    <h2 class="item_title">Time</h2>
                                    <p class="item_value">5 Years</p>
                                </div>
                                <div class="item expiration">
                                    <h2 class="item_title">Expire of Guarantee</h2>
                                    <p class="item_value">20 Apr, 2025</p>
                                </div>
                                <div class="item vehicle_insurance">
                                    <h2 class="item_title">Vehicle Insurance</h2>
                                    <p class="item_value amount">$<span id="vehicle_insurance_amount" class="add_amount">200</span>.00</p>
                                </div>
                                <div class="item vehicle_tax">
                                    <h2 class="item_title">Vehicle Tax</h2>
                                    <p class="item_value amount">$<span id="vehicle_tax_amount" class="add_amount">200</span>.00</p>
                                </div>
                                <div class="item commercial_insurance">
                                    <h2 class="item_title">Commercial Insurance</h2>
                                    <p class="item_value amount">$<span id="commercial_insurance_amount" class="add_amount">250</span>.00</p>
                                </div>
                                <div class="item total">
                                    <h2 class="item_title total_amount">Total amount</h2>
                                    <p class="item_value amount total_amount">$<span id="total_amount">250</span>.00</p>
                                </div> -->
                            </div>
                        </div>
                        <div class="insurance_form_action">
                            <button class="button primary-button">Yes Please!</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="trauma_insurance">
                    <div class="insurance_title page_main_title">
                        <form action="" class="insurance_form" data-tab="trauma_insurance">
                            <div class="insurance_form_contents">
                                <div class="insurance_title page_main_title">
                                    <h2>
                                        Trauma
                                    </h2>
                                </div>
                                <div class="insurance_details">
                                    <?php foreach($packages['trauma']['contents'] as $key => $value): ?>
                                        <div class="item date_of_guarantee">
                                            <h2 class="item_title"><?php echo $key; ?></h2>
                                            <p class="item_value w-50 text-wrap text-end"><?php echo $value; ?></p>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php 
                                        $userAge = ($thisUsersAge >= 18 && $thisUsersAge <= 30) ? "18-30" :
                                        (($thisUsersAge >= 31 && $thisUsersAge <= 50) ? "31-50" :
                                        (($thisUsersAge >= 51) ? "51+" : "0"));
                                    ?>
                                    <div class="item vehicle_insurance">
                                        <h2 class="item_title">Premium</h2>
                                        <p class="item_value amount">$<span id="vehicle_insurance_amount" class="add_amount"><?php echo $packages['trauma']['price'][$thisUserGender][$userAge]; ?></span></p>
                                    </div>


                                    <!-- <div class="item date_of_guarantee">
                                        <h2 class="item_title">Date of Guarantee</h2>
                                        <p class="item_value">20 Apr, 2020</p>
                                    </div>
                                    <div class="item type_of_insurance">
                                        <h2 class="item_title">Type of Insurance</h2>
                                        <p class="item_value">Standard</p>
                                    </div>
                                    <div class="item time_duration">
                                        <h2 class="item_title">Time</h2>
                                        <p class="item_value">5 Years</p>
                                    </div>
                                    <div class="item expiration">
                                        <h2 class="item_title">Expire of Guarantee</h2>
                                        <p class="item_value">20 Apr, 2025</p>
                                    </div>
                                    <div class="item vehicle_insurance">
                                        <h2 class="item_title">Vehicle Insurance</h2>
                                        <p class="item_value amount">$<span id="vehicle_insurance_amount" class="add_amount">200</span>.00</p>
                                    </div>
                                    <div class="item vehicle_tax">
                                        <h2 class="item_title">Vehicle Tax</h2>
                                        <p class="item_value amount">$<span id="vehicle_tax_amount" class="add_amount">200</span>.00</p>
                                    </div>
                                    <div class="item commercial_insurance">
                                        <h2 class="item_title">Commercial Insurance</h2>
                                        <p class="item_value amount">$<span id="commercial_insurance_amount" class="add_amount">250</span>.00</p>
                                    </div>
                                    <div class="item total">
                                        <h2 class="item_title total_amount">Total amount</h2>
                                        <p class="item_value amount total_amount">$<span id="total_amount">250</span>.00</p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="insurance_form_action">
                                <button class="button primary-button">Yes Please!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="income_protection">
                    <div class="insurance_title page_main_title">
                        <form action="" class="insurance_form" data-tab="income_protection">
                            <div class="insurance_form_contents">
                                <div class="insurance_title page_main_title">
                                    <h2>
                                        Income Protection
                                    </h2> 
                                </div>
                                <div class="insurance_details">
                                    <?php foreach($packages['disability']['contents'] as $key => $value): ?>
                                        <div class="item date_of_guarantee">
                                            <h2 class="item_title"><?php echo $key; ?></h2>
                                            <p class="item_value w-50 text-wrap text-end"><?php echo $value; ?></p>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php 
                                        $userAge = ($thisUsersAge >= 18 && $thisUsersAge <= 30) ? "18-30" :
                                        (($thisUsersAge >= 31 && $thisUsersAge <= 50) ? "31-50" :
                                        (($thisUsersAge >= 51) ? "51+" : "0"));
                                    ?>
                                    <div class="item vehicle_insurance">
                                        <h2 class="item_title">Premium</h2>
                                        <p class="item_value amount">$<span id="vehicle_insurance_amount" class="add_amount"><?php echo $packages['disability']['price'][$thisUserGender][$userAge]; ?></span></p>
                                    </div>

                                </div>
                            </div>
                            <div class="insurance_form_action">
                                <button class="button primary-button">Yes Please!</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
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
    async function getUserInfo() {

    }
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
                var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + urlParams.toString(); // Construct the new URL with updated params
                history.pushState({
                    path: newUrl
                }, '', newUrl);
            });


        } catch (error) {
            console.error("no tabs are active currently");
        }



        // $("ul.categories li").on("click", (e) => {
        //     e.preventDefault();
        //     $("ul.categories li").removeClass("active");
        //     $(e.currentTarget).addClass("active");
        // })

        var total_amount = 0;
        $(".add_amount").each((index, element) => {
            total_amount += parseInt($(element).text())
        })
        $("#total_amount").text(total_amount);


        $(".insurance_form").on("submit", async (e) => {
            e.preventDefault();
            var tab = $(e.currentTarget).data("tab");
            var gender;
            var dob;

            var formData = {
                "requestType": "getCurrentUserInformation"
            };

            // Await the AJAX call directly without using .done()
            const response = await makeAjaxCall("/scripts/requestAPI.php", "POST", formData);


            gender = response.gender;
            dob = response.date_of_birth;
            if (gender === null || dob === null) {
                window.location.assign("/plan_details?tab=" + tab);
            } else {
                window.location.assign("/answer_questions");
            }
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>