<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
$quiz_in_progress_id = $_GET['play_quiz_id'];


if (!isset($_SESSION['QuizInProgress']) || !isset($quiz_in_progress_id)) {
    redirect("/bank_home?error=select_quiz_first", false);
}
$quiz_id = $_SESSION['QuizIDInProgress'];
$quizById = find_by_id("user_quiz_progress", $quiz_in_progress_id);

$Thequiz = find_by_id("quizzes", $quiz_id);
$category = find_by_id('quiz_categories', $Thequiz['category_id']);
$user = current_user();
$page_title = "Quiz - " . $Thequiz['title'];
$hide_notifications = true;

?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<!-- Modal -->
<div class="modal fade" id="congratsModal" tabindex="-1" aria-labelledby="congratsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="congrats-page-wrapper">
                    <div class="page_heading">
                        <h2>Good Job!</h2>
                        <button class="close_btn mobile-only" type="button" data-bs-dismiss="modal" aria-label="close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="congrats_container">
                        <div class="trophy">
                            <div class="thophy_icon">
                                <img src="/assets/Icons/Congrats Cup.svg" alt="Congratulations">
                            </div>
                            <p class="score_obtained">Well done! Read your updated profile!</p>
                            <a href="/bank_home">
                                <button class="see_profile">Back to Main</button>
                            </a>
                        </div>
                    </div>
                    <div class="congrats_charts">
                        <div class="risk_tolerance_chart_container">
                            <p class="dark_spaced_heading d-none">How Your Risk Score Has Changed (Illustrative Only):</p>
                            <!-- <p class="dark_spaced_heading">Risk Tolerance</p> -->
                            <div class="line_chart chart-container d-none" style="position: relative; height:130px; width:100%">
                                <canvas id="Risk_line_chart"></canvas>
                            </div>
                            <div class="risk_chart_info">
                                <!-- <p>If a road trip requires planning, then your life most certainly requires some careful considerations.  Did you know that if you have a major illness or accident, you may be out of pocket if you have exhausted all your medical leave.</p> -->
                                <p>Your day-to-day planning and how you react to certain situations reveal a lot about your financial habits and preferences. Understanding these behaviours can help you make smarter financial decisions. Explore our tailored tips to see how they can guide you towards shaping a stronger financial future. </p>
                                <a href="/tips_and_rewards">
                                    <button class="button primary-button">Tips Curated for You</button>
                                </a>
                            </div>
                        </div>
                        <div class="finance_chart_container">
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
                                            <li>Income Protection</li>
                                            <li>Critical Illness</li>
                                        </ul>
                                    </div>
                                    <div class="finance_chart">
                                        <div class="y_lables">
                                            <div class="y_labels_wrapper">
                                                <div class="top_label label_life">
                                                    <p>Life</p>
                                                    <!-- <p>$20/ week</p> -->
                                                </div>
                                                <div class="top_label label_income">
                                                    <p>Income Protection</p>
                                                    <!-- <p>$10/ week</p> -->
                                                </div>
                                                <div class="top_label label_illness">
                                                    <p>Critical Illness</p>
                                                    <!-- <p>$5/ week</p> -->
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
            </div>
        </div>
    </div>
</div>

<div id="full-page" class="profile_page quiz_category_page quiz-play-page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    ?>
    <div class="quiz_page_container">
        <div class="quiz_sidebar desktop-only">
            <div class="grid_container">
                <div class="grid_items_wrapper">
                    <?php
                    $allQuizzes = find_all("quizzes");


                    foreach ($allQuizzes as $quiz):
                        $image = find_by_foreign_id("media", "ID", $quiz['image_id']);
                        $totalQuestions = findTotalQuestionsByQuizId($quiz['ID']);

                    ?>
                        <div data-id="QuizID_<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>Button" class="grid_item <?php echo ($quiz['ID'] === $quizById['quiz_id']) ? "active" : ""; ?>">
                            <div class="grid_icon">
                                <div class="overlay_image">
                                    <img src="<?php echo QUIZ_IMAGE_PATH . $image['file_path'] . $image['file_name']; ?>">
                                </div>
                            </div>
                            <div class="grid_title">
                                <h2><?php echo (isset($quiz['title'])) ? $quiz['title'] : "Not Found" ?></h2>
                                <p><?php echo ($totalQuestions > 0) ? $totalQuestions . " Questions" : "0 Questions" ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
        <div class="quiz_main_wrapper">
            <?php
            try {
                //code...
                $allQuestion = findQuestionsByQuizId($quiz_id);
                $totalQuestionsCount = findTotalQuestionsByQuizId($quiz_id);
                $quizInformation = find_by_id("user_quiz_progress", $quiz_in_progress_id);
                //$total_points = findMaximumPoints($quizInformation['quiz_id']);
            } catch (\Throwable $th) {
                echo "<h2 class='heading'>" . $th . "</h2>";
            }
            ?>
            <div class="back_button_strip desktop-only">
                <div class="backButtons">
                    <div class="back_button">
                        <button onclick="history.back()" style="background: none; cursor: pointer">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="tab_heading_wrapper">
                        <p class="category"><?php //echo (isset($category['category_name'])) ? $category['category_name'] : "No Category Found"; ?></p>
                        <h2 class="heading"><?php echo (isset($Thequiz['title'])) ? $Thequiz['title'] : "Title Not Found"; ?></h2>
                    </div>
                    <div class="tab_points_wrapper d-none">
                        <div class="total_questions">
                            <div class="questions_icon">
                                <i class="fa-solid fa-question"></i>
                            </div>
                            <p class="questions_count"><span class="Qcount"><?php echo ($totalQuestionsCount > 0) ? ($totalQuestionsCount) : 0; ?></span> questions</p>
                        </div>
                        <div class="total_points">
                            <div class="points_icon">
                                <i class="material-icons">
                                    extension
                                </i>
                            </div>
                            <p class="points_count"><span class="Pcount">+<?php echo ($total_points > 0) ? $total_points : 0; ?></span> points</p>
                        </div>
                    </div>
                </div>
                <div class="quiz_progress_bar d-none">
                    <div class="quiz_person"><i class="fa-regular fa-user"></i> <span>1</span> </div>
                    <div class="quiz_bar">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="points_quiz">
                        <i class="material-icons">
                            extension
                        </i>
                        <span><?php echo ($total_points > 0) ? $total_points : 0; ?></span>
                    </div>
                </div>
            </div>

            <div class="profile_page_wrapper">
                <div class="tab-content mt-0">
                    <?php
                    $currentQuiz = find_by_id("user_quiz_progress", $quiz_in_progress_id);
                    $currentQuestion = $currentQuiz['current_question'];
                    $currentQuestionCount = $currentQuiz['current_question_count'];
                    $sql = $db->query("SELECT * FROM questions WHERE quiz_id = '{$db->escape($quizInformation['quiz_id'])}' AND branch_key = '{$db->escape($currentQuestion)}' ");
                    $question = $db->fetch_assoc($sql);

                    ?>
                    <div class="tab-pane container active">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">question <span id="currentQuestionCount"><?php echo $currentQuestionCount ?></span> of <?php echo ($totalQuestionsCount > 0) ? $totalQuestionsCount : 0 ?></p>
                                    <h2 class="heading question_container"><?php echo (isset($question['question_text'])) ? $question['question_text'] : "No Question Found"; ?></h2>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-circle" style="--progress: <?php echo floor((floatval($currentQuestionCount) / floatval($totalQuestionsCount)) * 100); ?>;">
                                        <span id="percentage"><?php echo $currentQuestionCount ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <!-- Tab panes -->
                                <div class="tab_body_contents">
                                    <form action="" method="" id="questions_form">
                                        <?php
                                        $answers = find_by_sql("SELECT * FROM answers WHERE question_id = '{$question['ID']}'");
                                        // print_r($answers);
                                        ?>
                                        <input type="hidden" name="questionID" id="currentQuestionID" value="<?php echo $question['ID']; ?>">
                                        <input type="hidden" name="userID" value="<?php echo $user['ID']; ?>">
                                        <input type="hidden" name="quizID" value="<?php echo $Thequiz['ID']; ?>">
                                        <input type="hidden" name="quizInProgressID" value="<?php echo $quiz_in_progress_id; ?>">
                                        <div class="options-grid">

                                            <?php foreach ($answers as $answer) : ?>
                                                <?php $cleanedText = preg_replace('/^\S+\)/', '', $answer['answer_text']); ?>
                                                <div class="quiz-option">
                                                    <label for="Answer<?php echo (isset($answer['ID'])) ? $answer['ID'] : 0; ?>"><?php echo (isset($answer['answer_text'])) ? $cleanedText : "No Answer Found"; ?></label>
                                                    <input type="radio" name="option" id="Answer<?php echo (isset($answer['ID'])) ? $answer['ID'] : 0; ?>" value="<?php echo (isset($answer['ID'])) ? $answer['ID'] : 0; ?>">
                                                    <input type="hidden" name="pointsEarned" value="<?php echo (isset($answer['points'])) ? $answer['points'] : 0; ?>">
                                                    <input type="hidden" class="next_question" name="nextQuestion" value="<?php echo $answer['next_question']; ?>">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="quiz-action">
                                            <button type="submit" class="primary-button">Next</button>
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
    <div class="bottom-navigation desktop-only d-none"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    // Create the line chart
    var ctx = $('#Risk_line_chart')[0].getContext('2d');

    // Set the canvas dimensions explicitly
    $('#Risk_line_chart').attr('width', '100%');
    $('#Risk_line_chart').attr('height', '200px');

    // Create a linear gradient
    var gradient = ctx.createLinearGradient(0, 0, 0, 100); // Parameters: x0, y0, x1, y1
    gradient.addColorStop(0.3, 'rgba(208, 33, 40, 0.2)'); // 100% opacity
    gradient.addColorStop(0.7, 'rgba(208, 33, 40, 0)'); // 0% opacity


    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], // X-axis labels
            datasets: [{
                label: 'Data', // This label will be hidden, but you can keep it for reference
                data: [50, 50, 10, 100, 100, 50, 50, 100, 50, 0], // Data points
                borderColor: 'rgba(255, 0, 0, 1)', // Line color
                backgroundColor: gradient, // Area under the line color
                borderWidth: 2, // Line width
                fill: true, // Fill area under the line
                tension: 0.1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false // Hide the legend
                },
                tooltip: {
                    callbacks: {
                        label: function() {
                            return ''; // Hide tooltips if needed
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true, // Start x-axis from zero
                    grid: {
                        display: true,
                        color: "#EFEEFC",
                        lineWidth: 1.5
                    },
                    ticks: {
                        color: "#0C092A",
                        font: {
                            family: "Rubik",
                            size: "20",
                            lineHeight: "140%",
                            weight: 500
                        }
                    }
                },
                y: {
                    display: false, // Hide y-axis labels
                    grid: {
                        display: false,
                    }
                }
            }
        }
    });
</script>
<script>
    function updateProgress(percentage) {
        const $progressCircle = $('.progress-circle');
        const $percentageText = $('#percentage');
        $progressCircle.css('--progress', percentage);
    }

 
    $(document).ready(() => {
        var currentQuestionCount = parseInt($("#currentQuestionCount").text());
        if (currentQuestionCount == "" || currentQuestionCount < 1) {
            window.location.assign("/bank_home");
        }
        // $("#congratsModal").modal("show");
        var percentage = ((1 / $(".questions_count span.Qcount").text()) * 100);
        updateProgress(percentage)
        var inProgressQuizId = sessionStorage.getItem("inProgressQuizID");
        var selected_quiz = sessionStorage.getItem("selected quiz");
        $(".quiz_page_container .grid_item[data-id=" + selected_quiz + "Button" + "]").addClass("active");
        $(".quiz_page_container .grid_item").on("click", (e) => {
            e.preventDefault();
            if (confirm("The quiz is in progress do you want to leave this page? ")) {
                var newSelectedQuiz = $(e.currentTarget).data("id");
                sessionStorage.setItem("selected quiz", newSelectedQuiz);
                window.location.assign("/quiz");
            }
        });
        if (inProgressQuizId === null || selected_quiz === null) {
            window.location.assign("/bank_home");
        }
        $("#congratsModal").on("hidden.bs.modal", () => {
            window.location.assign("/bank_home");
        })


        $("#questions_form").on("submit", (e) => {
            e.preventDefault();
            var next_question = $(e.currentTarget).find("input:checked").siblings(".next_question").val();
            var total_questions = parseInt($(".questions_count span.Qcount").text());
            var currentQuestionCount = parseInt($("#currentQuestionCount").text());
            var $form = $(e.currentTarget);
            var formValues = $form.serialize();


            var selected_answer = $(".quiz-option").find("input[type='radio']:checked");
            var pointsEarned = selected_answer.closest(".quiz-option").find("input[name='pointsEarned']").val();
            console.log(selected_answer.val() + " => " + pointsEarned);
            
            if (currentQuestionCount < total_questions && next_question !== "") {
                var FormData = {
                    "requestType": "updateProgress",
                    "formData": formValues,
                    "selectedAnswer": selected_answer.val(),
                    "pointsEarned": pointsEarned,
                    "selectedNextQuestion": next_question,
                    "completeQuiz": false
                }
            } else if (currentQuestionCount == total_questions) {
                var FormData = {
                    "requestType": "updateProgress",
                    "formData": formValues,
                    "selectedAnswer": selected_answer.val(),
                    "pointsEarned": pointsEarned,
                    "selectedNextQuestion": next_question,
                    "completeQuiz": true
                }

            }

            makeAjaxCall("../scripts/requestAPI.php", "POST", FormData)
                .done((response) => {
                    console.log(response);
                    $(e.currentTarget).find(".options-grid").html("");
                    if (response.message.includes("completed Successfully")) {
                        // $(".modal .score_obtained").html("You scored "+ response.info.points +" and Unlocked a New Reward")
                        // $(".modal .dark_spaced_heading").html(response.info.profile.profile_name);
                        var modal_message = {
                            "2": '<p class="fs-5">Your careful, security-focused mindset means your profile aligns with that of a <span class="fw-bolder">Risk Avoider</span>, always looking to safeguard your future.</p> <p>You’re someone who values safety and security above all else. Risks are something you tend to avoid, and you take comfort in having a solid plan that guarantees stability. Whether it\’s your finances, career, or personal life, you always think ahead to ensure that everything stays on track. Your focus is on long-term protection and peace of mind, which is why you\’re naturally drawn to products that provide financial security, such as life insurance or critical illness cover. You know that by taking care of the details today, you\’re securing a worry-free future for tomorrow Ready to strengthen your sense of security even further? Click through to explore tailored tips and advice that will help you make the most of your financial planning while staying true to your risk-averse nature</p>',

                            "4": '<p class="fs-5">With your organised and detail-oriented approach to managing finances, you fit perfectly into the <span class="fw-bolder"> Prudent Planner </span> profile, ensuring everything is in order.</p> <p>You thrive on organisation and planning, carefully managing your finances and ensuring everything is in its right place. You believe that staying in control is the key to long-term success, and you take the time to regularly review your budget and financial plans. The details matter to you, and you appreciate solutions that align with your methodical approach. Insurance products like life and critical illness cover resonate with you because they offer the structure and protection you seek. Your disciplined nature ensures that you always plan for the future, knowing that being prepared today secures tomorrow’s peace of mind \n Want to take your planning to the next level? Click here to discover curated content that provides practical tips and insights for staying on top of your finances with ease. </p>',

                            "5": '<p class="fs-5">Confident and independent in your financial decisions, your profile is <span class="fw-bolder"> Self-Managed, </span> taking control of your future on your own terms. </p> <p>You’re independent, and you take pride in handling your finances on your own terms. You trust yourself to make the right decisions, whether it’s through budgeting, monitoring your credit, or using apps to track your expenses. You know exactly what you need, and you’re not afraid to take control. Insurance products like disability income cover are appealing because they offer practical solutions without tying you down. Your sense of self-reliance means you’re always in the driver’s seat, making decisions that fit your lifestyle without needing constant advice or intervention. \n Are you ready to enhance your self-managed approach? Click through for personalised strategies that will help you maintain your independence while securing your financial future. </p>',

                            "11": '<p class="fs-5">Your positive outlook and forward-thinking nature make you a <span class="fw-bolder">Long-Term Optimist,</span> planning wisely while embracing the future with hope</p> <p>You’ve always had a positive outlook on life, believing that the future holds great things. You’re not one to dwell on worries, but you do understand the value of being prepared. With your eye on the long game, you’re drawn to solutions that balance protection with flexibility, like critical illness insurance. You trust that by taking simple steps now, you’ll be able to handle whatever comes your way. Your forward-thinking nature allows you to plan for the future without losing sight of the good things happening today. \n Want to continue building on your optimistic approach? Click here to explore tips and tools that will help you stay prepared, while keeping your bright outlook intact.</p>',

                            "12": '<p class="fs-5">With your relaxed, live-in-the-moment attitude, your profile is <span class="fw-bolder">Carefree,</span> valuing freedom while still staying mindfully secure.</p> <p>You’re all about living in the moment, enjoying life as it comes, and not getting bogged down by overthinking or excessive planning. You prefer simple, low-maintenance solutions that give you the freedom to focus on what really matters to you—experiences, not details. Insurance might not be something you dwell on, but products like life insurance give you the peace of mind you need without complicating your life. You want to stay protected, but in a way that fits your laid-back lifestyle and keeps things easy. \n Ready to keep your carefree lifestyle while ensuring you’re covered? Click here to explore straightforward, hassle-free tips that will let you focus on what you love, while knowing you’re financially secure.</p>'
                        };
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
                        var profile_id = response.info.profile.ID;
                        updateRiskChart(barChartWidths[profile_id], barChartColors[profile_id]);
                        $(".risk_chart_info p").html(modal_message[profile_id]);
                        $("#congratsModal").modal("show");
                        sessionStorage.removeItem("selected quiz");
                        sessionStorage.removeItem("inProgressQuizID");
                    } else {
                        $("html, body").animate({
                            scrollTop: 0
                        }, "smooth");
                        $("#currentQuestionCount").text(parseInt(currentQuestionCount) + 1);
                        $("#percentage").text(parseInt(currentQuestionCount) + 1);
                        var percentage = ((parseInt($("#currentQuestionCount").text()) / total_questions) * 100);
                        updateProgress(percentage);
                        $(e.currentTarget).closest("h2.heading").html(response.info.question.question_text);
                        $("#currentQuestionID").val(response.info.question.ID);
                        // console.log(response.info);
                        $("h2.question_container").html(response.info.question.question_text);
                        $.each(response.info.answers, (index, element) => {

                            var quiz_option = $("<div>").addClass("quiz-option");

                            const cleanedText = element.answer_text.replace(/^\S+\)/, '');

                            var label = $("<label>").attr("for", "Answer" + element.ID);
                            // label.text(element.answer_text);
                            label.text(cleanedText);

                            var input_var = $("<input>")
                                .attr("type", "radio")
                                .attr("name", "option")
                                .attr("id", "Answer" + element.ID)
                                .val(element.ID);

                            var points_earned = $("<input>")
                                .attr("type", "hidden")
                                .attr("name", "pointsEarned")
                                .val(element.points);

                            var next_question = $("<input>")
                                .attr("type", "hidden")
                                .attr("name", "nextQuestion")
                                .addClass("next_question")
                                .val(element.next_question);

                            quiz_option.append([label, input_var, points_earned, next_question]);
                            $(e.currentTarget).find(".options-grid").append(quiz_option);
                        });
                    }

                }).fail((xhr, error, status) => {
                    console.error(xhr.responseText);
                })





        });

    });
</script>
<?php include './layouts/footerEnd.php'; ?>