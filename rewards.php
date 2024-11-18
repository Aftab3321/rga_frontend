<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
if (!$session->isUserLoggedIn()) {
    redirect("/login", false);
}
$page_title = "Tips $ Rewards";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<div id="root2" class="rewards_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    ?>

    <div class="back_button_strip">
        <div class="back_button">
            <button onclick="history.back()" style="background: none; cursor: pointer;">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="page_title">
                <h1>Rewards</h1>
            </div>
        </div>
        <div class="settings">
            <div class="rewards_filter">
                <div class="reward_labels">
                    <div class="weekly_label label_button">
                        <label for="weekly_toggle">Weekly</label>
                        <input type="radio" checked name="rewards_toggle" class="rewards_toggle" id="weekly_toggle">
                    </div>
                    <div class="alltime_toggle label_button">
                        <label for="alltime_toggle">All Time</label>
                        <input type="radio" name="rewards_toggle" class="rewards_toggle" id="alltime_toggle">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rewards_page_wrapper">
        <div class="rewards_container">
            <div class="rewards">

            </div>
        </div>
        <div class="tips_rewards_button">
            <button class="primary-button">Tips and Rewards</button>
        </div>
    </div>
    <div class="bottom-navigation desktop-only"><?php include_once("./layouts/bottom_navigation.php") ?></div>

</div>




<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
        $(document).ready(() => {

            var rewards = [
                {
                    "backgroundcolor": "#C9F2E9",
                    "icon": "Financial Tip.svg",
                    "flag": "",
                    "title": "Financial Tip",
                    "description": "Use Free Booking Services",
                    "medal": "Gold Medal.svg"
                },
                {
                    "backgroundcolor": "#FFD6DD",
                    "icon": "Discount.svg",
                    "flag": "",
                    "title": "Coupon",
                    "description": "10% off Meal Kit",
                    "medal": "Silver Medal.svg"
                },
                {
                    "backgroundcolor": "#C4D0FB",
                    "icon": "Coupon.svg",
                    "flag": "",
                    "title": "Coupon",
                    "description": "Free Movie Voucher",
                    "medal": "Bronze Medal.svg"
                },
                {
                    "backgroundcolor": "#BF83FF",
                    "icon": "Bank With Receipt.svg",
                    "flag": "",
                    "title": "Financial Tip",
                    "description": "Review Bank Statements",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#C4D0FB",
                    "icon": "Calender.svg",
                    "flag": "",
                    "title": "Financial Tip",
                    "description": "Review Subscriptions",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#FFD6DD",
                    "icon": "Ticket_2.svg",
                    "flag": "",
                    "title": "Coupon",
                    "description": "Free Movie Voucher",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#C4D0FB",
                    "icon": "boy-red.svg",
                    "flag": "norway-flag.svg",
                    "title": "Justin Bator",
                    "description": "448 points",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#BF83FF",
                    "icon": "girl.svg",
                    "flag": "germany-flag.svg",
                    "title": "Cooper Lipshuts",
                    "description": "448 points",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#C9F2E9",
                    "icon": "man.svg",
                    "flag": "indonesia-flag.svg",
                    "title": "Alfredo Septimus",
                    "description": "448 points",
                    "medal": ""
                },
                {
                    "backgroundcolor": "#FFD6DD",
                    "icon": "boy-blue.svg",
                    "flag": "turkey-flag.svg",
                    "title": "Paityn Aminoff",
                    "description": "448 points",
                    "medal": ""
                },
            ];

            $.each(rewards, (index, item) => {
                let reward_div = $("<div>").addClass("reward");
                let serial_div = $("<div>").addClass("serial_number");
                let serial_heading = $("<h2>");
                let serial_span = $("<span id='serial'>");
                serial_span.append(index + 1);
                serial_heading.append(serial_span);
                serial_div.append(serial_heading);
                reward_div.append(serial_div);



                let reward_icon = $("<div class='reward_icon'>");
                    reward_icon.css("background-color", item.backgroundcolor);
                let reward_img = $("<img src='' alt='Icon Image'>");
                let reward_flag = $("<img src='' alt='Flag Image'>");
                reward_img.attr("src", "/assets/icons/"+item.icon);
                reward_icon.append(reward_img);
                if (item.flag != "") {
                    reward_flag.attr("src", "/assets/icons/"+item.flag);
                    reward_flag.addClass("flag-icon");
                    reward_icon.append(reward_flag);
                }
                reward_div.append(reward_icon);


                let reward_info = $("<div class='reward_info'>");
                let info_heading = $("<h2>").append(item.title);
                let info_description = $("<p>").append(item.description);
                reward_info.append(info_heading);
                reward_info.append(info_description);
                reward_div.append(reward_info);



                let reward_medal = $("<div class='reward_medal'>");
                if (item.medal != "") {
                    let medal_image = $("<img alt='Medal Image'>").attr("src", "/assets/icons/"+item.medal);
                    reward_medal.append(medal_image);
                }
                reward_div.append(reward_medal);

                $(".rewards").append(reward_div);


                console.log(index + 1 + " => " + item.backgroundcolor);
            })
            
            
            
        })
    </script>
<?php include './layouts/footerEnd.php'; ?>