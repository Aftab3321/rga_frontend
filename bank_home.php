<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php
$page_title = "Home";
$time = date("H");
if (!$session->isUserLoggedIn()) {
    redirect("/login");
} 
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php
    $user = current_user();

    $current_quiz = find_by_sql("SELECT uq.*, q.* FROM user_quiz_progress uq RIGHT JOIN quizzes q ON uq.quiz_id = q.ID WHERE uq.user_id = '{$db->escape($user['ID'])}' ORDER BY uq.ID DESC");
    if (!empty($current_quiz)) {
        $percentage = floor((floatval($current_quiz[0]['current_question']) / floatval($current_quiz[0]['total_questions']) ) * 100);
    } else {
        $lastQuiz = find_by_sql("SELECT uq.*, q.* FROM user_quizzes uq RIGHT JOIN quizzes q ON uq.quiz_id = q.ID WHERE uq.user_id = '{$db->escape($user['ID'])}' ORDER BY `uq`.`completed_at` DESC LIMIT 1");
        if (!empty($lastQuiz)) {
            $percentage = 100;
        } else {
            $lastQuiz[0]['title'] = "No Quiz Taken Yet";
            $percentage = 0;
        }
    }

?>








<div id="root2" class="home_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header_without_search.php');
    ?>

    <header class="mobile-header home_header">
        <div class='container'>
            <div class='header-wrapper d-flex align-items-center justify-content-between'>
                <div class="greetings-wrapper">
                    <div class="greetings">
                        <div class="greeting-message">
                            <!-- good morning icon -->
                            <i class="material-icons">light_mode</i>
                            <p>
                                <?php
                                // if ($time < "12") {
                                //     echo "Good Morning";
                                // } elseif ($time < "18") {
                                //     echo "Good Afternoon";
                                // } else {
                                //     echo "Good Evening";
                                // }
                                ?>
                                Hello
                                <!-- Good Morning -->
                            </p>
                        </div>
                        <div class="greet_user">
                            <h2><?php echo (isset($user)) ? $user['username'] : "Madelyn Dias"; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="profile-image-wrapper">
                    <a href="/profile">
                        <div class="profile-image">
                            <img src="/assets/images/profile.png" alt="Profile Image">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="home_page_wrapper">

        <div class="hero_section">
            <div class="container">
                <div class="hero-section-wrapper">
                    <div class="recent-quiz">
                        <div class="heading">
                            <p><?php echo (!empty($current_quiz)) ? "Last Unfinished" : "Last Completed"; ?></p>
                            <div class="quiz">
                                <i class="fa-solid fa-headphones"></i>
                                <span class="quiz-title"><?php echo (!empty($current_quiz)) ? $current_quiz[0]['title'] : $lastQuiz[0]['title']; ?></span>
                            </div>
                        </div>
                        <div class="progress-container">
                            <input type="hidden" id="recentQuizProgressPercentage" value="<?php echo (isset($percentage)) ? $percentage : 0; ?>">
                            <div class="progress-circle" style="--progress: ;">
                                <span id="percentage"></span>
                            </div>
                        </div>
                    </div>
                    <div class="did-you-know d-flex">
                        <img src="/assets/images/1.png" alt="" class="did_you_know_images image-1">
                        <img src="/assets/images/2 (1).png" alt="" class="did_you_know_images image-2">
                        <div class="section-contents">
                            <div class="heading">
                                <p class="text-center">Did you know</p>
                            </div>
                            <div class="contents-body">
                                <p class="text-center">
                                    Just like you plan ahead for vacations and special occasions, preparing for unexpected life events can safeguard your financial security.
                                </p>
                            </div>
                            <div class="content_action">
                                <a href="/tips_and_rewards">
                                    <button class="button"><span class="tips_button_logo"></span> Tips & Rewards</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="choose-quiz-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quiz-section inner-section">
                            <div class="section-title desktop-only">
                                <h2>Choose Quiz</h2>
                            </div>
                            <div class="section-title mobile-only">
                                <h2>Live Quizzes</h2>
                                <a href="#">See all</a>
                            </div>
                            <div class="grid_container">
                                <div class="grid_items_wrapper">
                                    <form action="#" id="choose_quiz_form">
                                        <div class="quiz-section inner-section">
                                            <div class="grid_container">
                                                <div class="grid_items_wrapper">
                                                    <?php 
                                                        $allQuizzes = find_all("quizzes");

                                                        foreach ($allQuizzes as $quiz):
                                                            $image = find_by_foreign_id("media", "ID", $quiz['image_id']);
                                                            $totalQuestions = findTotalQuestionsByQuizId($quiz['ID']);
                                                    ?>
                                                    <div class="grid_item">
                                                        <input type="radio" class="d-none" name="choose_quiz" id="QuizID<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>" value="<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "Not Found"; ?>">
                                                        <label for="QuizID<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>">
                                                            <div class="grid_icon">
                                                                <div class="overlay_image">
                                                                    <img src="<?php echo QUIZ_IMAGE_PATH . $image['file_path'] . $image['file_name']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="grid_title">
                                                                <h2><?php echo (isset($quiz['title'])) ? $quiz['title'] : "Title Not Found"; ?></h2>
                                                                <p><?php //echo ($totalQuestions[0]['total_question_count']) ? $totalQuestions[0]['total_question_count'] . " Questions" : "0 Questions" ?></p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="grid-action-button mt-5">
                                                    <button type="submit" class="button primary-button">Next</button>
                                                </div>
                                            </div>
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
    <div class="bottom-navigation"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>




<script>
    function updateProgress(percentage) {
        const progressCircle = document.querySelector('.progress-circle');
        const percentageText = document.getElementById('percentage');
        progressCircle.style.setProperty('--progress', percentage);
        percentageText.textContent = `${percentage}%`;
    }
    

    // Example usage
    updateProgress(65); // Update the progress to 75%
</script>
<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        $("#choose_quiz_form button.primary-button").addClass("disabled");
        $("#choose_quiz_form input[type='radio']").change(() => {
            $("#choose_quiz_form button.primary-button").removeClass("disabled");
        });

        var progressOfTheQuiz = $("#recentQuizProgressPercentage").val();
        updateProgress(progressOfTheQuiz);

        $("#choose_quiz_form input[type='radio']").on("change", () => {
            $("html, body").animate({ scrollTop: $(document).height() }, 500);
        })


        $("#choose_quiz_form ").on("submit", (e) => {
            e.preventDefault();
            let selected_input = $("#choose_quiz_form input[type='radio']:checked").val();
            let selected_quiz_id = "QuizID_"+selected_input;
            sessionStorage.setItem("selected quiz", selected_quiz_id + "Button");
            window.location.assign("/quiz");
        })

    })
</script>
<?php include './layouts/footerEnd.php'; ?>