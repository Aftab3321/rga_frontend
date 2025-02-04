<?php

$page_title = "Profile";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php
$user = current_user();
$user_id = $db->escape($user['ID']);
$sql = $db->query("SELECT up.*, p.* FROM users_profiles up RIGHT JOIN profiles p ON up.profile_id = p.ID WHERE up.user_id = '$user_id' ORDER BY up.profile_id DESC LIMIT 1;");
$profile = ($db->num_rows($sql) > 0) ? $db->fetch_assoc($sql) : ["profile_name" => "No Profile Set"];


if ($profile['profile_name'] == "No Profile Set") {
    redirect("/bank_home", false);
}
$scoreSql = $db->query("SELECT AVG(total_score) AS score FROM user_quizzes WHERE user_id = '$user_id';");
$scoreResult = ($db->num_rows($scoreSql) < 1) ? ["score" => "0"] : $db->fetch_assoc($scoreSql); //: ["score" => "0"];
// print_r($scoreResult);
$score = ($scoreResult['score'] != "") ? $scoreResult : ["score" => "0"];
?>


<div id="root2" class="profile_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    ?>

    <div class="back_button_strip">
        <div class="back_button">
            <button onclick="history.back()" style="background: none; cursor: pointer;">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div class="page_title">
                <h1>Profile</h1>
            </div>
        </div>
        <div class="settings">
            <details>
                <summary>
                    <i class="fa-solid fa-gear"></i>
                </summary>
                <div class="settings_container">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Log Out</a></li>
                    </ul>
                </div>
            </details>
        </div>
    </div>
    <div class="profile_page_wrapper">
        <div class="d-none">
            <input type="hidden" id="currentProfileId" value="<?php echo (isset($profile['ID'])) ? $profile['ID'] : "0"; ?>">
        </div>
        
        <div class="hero_section">
            <div class="d-flex justify-content-end">
                <div class="profile-wrapper">
                    <div class="profile">
                        <div class="profile-image">
                            <img src="/assets/images/profile.png" alt="Profile Image">
                        </div>
                        <div class="profile-points d-none">
                            <i class="fa-regular fa-star"></i>
                            <span class="points">Points</span><span class="point_count"><?php echo intval($score['score']); ?></span>
                            <!-- <span class="points">Points</span><span class="point_count">590</span> -->
                        </div>
                        <div class="profile-title">
                            <h2><?php echo (isset($user)) ? $user['username'] : "Name Not Set"; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="hero_charts_wrapper">
                    <div class="recent-quiz-progress">
                        <div class="heading">
                            <div class="container-title">
                                <h2>You have played a total <span class="primary-span">24 Quizzes</span> this month!</h2>
                            </div>
                        </div>
                        <div class="progress-container">
                            <svg class="progress-circle_svg" width="200" height="200">
                                <circle class="background-circle" cx="100" cy="100" r="70"></circle>
                                <circle class="foreground-circle" cx="100" cy="100" r="70"></circle>
                            </svg>
                            <div class="percentage-text" id="percentage">
                                <div class="tasks_completed">
                                    <h2>
                                        <span id="completed_tasks_heading_span"></span><span id="total_task_heading_span"></span>
                                    </h2>
                                </div>
                                <div class="task_completed_details">
                                    <p>Quiz played</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="primary_box financial_section">
                        <div class="container-title">
                            <div style="width: 85%">
                                <h2>Suggested insurance coverages matched to your profile (illustrative only)</h2>
                                <p class="text-light fs-6 fw-bold">Click Coverage for more information</p>
                            </div>
                            <div class="chart-icon-container">
                                <i class="material-icons">leaderboard</i>
                            </div>
                            
                        </div>
                        <div class="chart-container">
                            <div class="charts_top_labels">
                                <ul>
                                    <li>Life</li>
                                    <li>Disability Income</li>
                                    <li>Critical Illness</li>
                                </ul>
                            </div>
                            <div class="finance_chart">
                                <div class="y_lables">
                                    <div class="y_labels_wrapper">
                                        <div class="top_label label_life">
                                            <p>Life</p>
                                            <p></p>
                                        </div>
                                        <div class="top_label label_income">
                                            <p>Income Protection</p>
                                            <p></p>
                                        </div>
                                        <div class="top_label label_illness">
                                            <p>Critical Illness</p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart_bars">
                                    <div class="chart_bars_wrapper">
                                        <div class="bar_label life_label">
                                            <div class="progress"></div>
                                            <div class="progress_coverage_container">
                                                <a href="/insurance?tab=life_insurance">
                                                    <button>Coverage</button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="bar_label income_label">
                                            <div class="progress"></div>
                                            <div class="progress_coverage_container">
                                                <a href="/insurance?tab=income_protection">
                                                    <button>Coverage</button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="bar_label illness_label">
                                            <div class="progress"></div>
                                            <div class="progress_coverage_container">
                                                <a href="/insurance?tab=trauma_insurance">
                                                    <button>Coverage</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="chart_bars">
                                        <div class="bar life_bar"></div>
                                        <div class="bar income_bar"></div>
                                        <div class="bar illness_bar"></div>
                                    </div> -->
                            </div>
                        </div>
                        <div class="chart_x_lables">
                            <p>Low</p>
                            <p>Medium</p>
                            <p>High</p>
                            <!-- <p>75%</p>
                            <p>100%</p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="planner_sect">
            <h2 class="section-title">You are a <?php echo $profile['profile_name']; ?> </h2>
            <p class="section-para"><?php echo (isset($profile['description'])) ? $profile['description'] : "Description not found"; ?></p>
            <!-- <p class="section-para">You understand risks and generally loves to plan things ahead. However you are not overly cautious and still take calculated risks, and only focus your planning energy on what matters and the major events.</p> -->
            <p class="section-para">Your profile has been built based on tested behavioural indicators and the insights were developed based on a statistically significant research.</p>
            <div class="content_action">
                <a href="/tips_and_rewards">
                    <button class="button"><span class="tips_button_logo"></span> Tips Curated for You</button>
                </a>
            </div>
        </div>

    </div>

</div>




<script>
    // function updateProgress(percentage) {
    //     const circle = document.querySelector('.foreground-circle');
    //     const radius = circle.r.baseVal.value;
    //     const circumference = 2 * Math.PI * radius;
    //     const offset = circumference - (percentage / 100) * circumference;

    //     circle.style.strokeDashoffset = offset;
    //     document.getElementById('percentage').textContent = `${percentage}%`;
    // }

    function updateProgress(completedTasks, totalTasks = 50) {
        // Calculate the percentage based on completed and total tasks
        const percentage = (completedTasks / totalTasks) * 100;

        // Select the circle element
        const circle = document.querySelector('.foreground-circle');
        const radius = circle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;

        // Set the stroke-dasharray to the circumference of the circle
        circle.style.strokeDasharray = circumference;

        // Calculate the stroke-dashoffset
        const offset = circumference - (percentage / 100) * circumference;

        // Update the stroke-dashoffset property
        circle.style.strokeDashoffset = offset;

        // Update the text with the completed tasks
        document.getElementById('completed_tasks_heading_span').textContent = `${completedTasks}`;
        document.getElementById('total_task_heading_span').textContent = `/${totalTasks}`;
    }

    // Example usage
    updateProgress(37); // Update the progress to 75%
    
</script> 
<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        makeAjaxCall("/scripts/requestAPI.php", "POST", {'requestType': 'getTotalQuizAttempted'})
        .done((response) => {
            console.log(response);
            var quiz_this_month = response[1].quiz_attempted_this_month;
            var quiz_attempted = response[0].quiz_attempted;
            var total_quiz = response[2].total_quizzes;
            $(".recent-quiz-progress h2 span.primary-span").html(quiz_this_month +" Quizzes");
            updateProgress(quiz_attempted, total_quiz);
        })
        .fail((xhr,error,status) => {
            console.error(xhr.responseText);
        })

        var barChartWidths = {
            "2" : ['100%', '32%', '32%'],
            "4" : ['32%', '100%', '100%'],
            "5" : ['15%', '32%', '32%'],
            "11" : ['100%', '32%', '15%'],
            "12" : ['32%', '100%', '100%']
        }
        var barChartColors = {
            "2" : ['#FF565D', '#FF9A9E', '#FF9A9E'],
            "4" : ['#FF9A9E', '#FF565D', '#FF565D'],
            "5" : ['#FFD6D7', '#FF9A9E', '#FF9A9E'],
            "11" : ['#FF565D', '#FF9A9E', '#FFD6D7'],
            "12" : ['#FF9A9E', '#FF565D', '#FF565D']
        }
        var profile_id = $("#currentProfileId").val().trim();
        if (profile_id === "0") {
            updateRiskChart(['0%', '0%', '0%'], ['#fff', '#fff', '#fff']);
        } else {
            updateRiskChart(barChartWidths[profile_id], barChartColors[profile_id]);
        }
    })
</script>
<?php include './layouts/footerEnd.php'; ?>