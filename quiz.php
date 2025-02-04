<?php
$page_title = "Quiz";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php 

if (!$session->isUserLoggedIn()) {
    redirect("/login");
} else {
    $user = current_user();
}
?>


<div id="full-page" class="profile_page quiz_category_page">
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header_without_search.php');
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
                    <div data-id="QuizID_<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>Button" class="grid_item">
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
            <div class="back_button_strip">
                <div class="desktop-only">
                    <div class="back_button">
                        <button onclick="history.back()" style="background: none; cursor: pointer">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </div>
                </div>
                <div class="mobile-only">
                    <div class="back_button"> 
                        <a href="/bank_home" class="fs-3 text-light">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Nav tabs -->
            <ul id="quiz_category_tabs" class="nav nav-tabs">
                <?php 
                    $allQuizzes = find_all("quizzes");


                    foreach ($allQuizzes as $quiz):
                        $image = find_by_foreign_id("media", "ID", $quiz['image_id']);
                        $totalQuestions = findTotalQuestionsByQuizId($quiz['ID']);
                ?>
                <li class="nav-item">
                    <a class="nav-link" id="QuizID_<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>Button" data-bs-toggle="tab"
                        href="#QuizID_<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>"><?php echo (isset($quiz['title'])) ? $quiz['title'] : "Something"; ?></a>
                </li>
                <?php endforeach; ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="SupermarketButton" data-bs-toggle="tab" href="#SuperMarketQuiz">Menu
                        1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="LotteryButton" data-bs-toggle="tab" href="#LotteryQuiz">Menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="love_storyButton" data-bs-toggle="tab" href="#LoveQuiz">Menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="DateButton" data-bs-toggle="tab" href="#DateQuiz">Menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Fun_ParkButton" data-bs-toggle="tab" href="#FunParkQuiz">Menu 2</a>
                </li>  -->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <?php 
                    $allQuizzes = find_all("quizzes");
                    $quizImagesToDisplay = [
                        "12" => "/assets/Icons/Road Trip Colored.svg",
                        "13" => "/assets/Icons/Supermarket Colored.svg",
                        "15" => "/assets/Icons/Lottery Colored.svg",
                        "16" => "/assets/images/unexpected_call.png",
                        "17" => "/assets/Icons/The Date Colored.svg",
                        "18" => "/assets/Icons/Fun Park Colored.svg",
                    ];


                    foreach ($allQuizzes as $quiz):
                        $image = find_by_foreign_id("media", "ID", $quiz['image_id']);
                        $totalQuestions = findTotalQuestionsByQuizId($quiz['ID']);
                        try {
                            //code...
                            $allQuestion = findQuestionsByQuizId($quiz['ID']);
                            $total_points = [];
                            
                            foreach ($allQuestion as $key => $questionValue) {
                                $thisQuestionPoints = findTotalPointsByQuestionId($questionValue['ID']);
                                $total_points[$key] = $thisQuestionPoints[0]['total_points'];
                            }
                            $averagePoints = array_filter($total_points);
                            // $average = array_sum($averagePoints)/count($averagePoints);
                            // $average = intval(ceil($average));
                            // $average = findMaximumPoints($questionValue['quiz_id']);;
                        } catch (\Throwable $th) {
                            echo $th;
                        }
                        try {
                            $category_name = "";
                            $sql = "SELECT q.ID, q.category_id, c.ID AS category_ID, c.category_name FROM quizzes q RIGHT JOIN quiz_categories c ON q.category_id = c.ID  WHERE q.ID = '{$db->escape($quiz['ID'])}' ";
                            $result = $db->query($sql);
                            if ($db->num_rows($result) > 0) {

                                $category_name = $db->fetch_assoc($result);
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                            echo $th;
                        }
                ?>
                <div class="tab-pane container fade" id="QuizID_<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="<?php echo $quizImagesToDisplay[$quiz['ID']]; ?>">
                            <!-- <img src="/assets/Icons/Road Trip Colored.svg"> -->
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <!-- <p class="category"><?php echo ($category_name != "") ? $category_name['category_name'] : "No Category Found"; ?></p> -->
                                    <h2 class="heading"><?php echo (isset($quiz['title'])) ? $quiz['title'] : "Not Found" ?></h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions justify-content-center">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count">
                                        <?php echo ($totalQuestions > 0) ? "<span class='Qcount'>". $totalQuestions . " </span> Questions" : "<span class='Qcount'>0</span> Questions" ?>
                                            <!-- <span class="Qcount">10</span> questions -->
                                        </p>
                                    </div>
                                    <div class="total_points d-none">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count">
                                            <?php echo (!empty($average)) ? "<span class='Pcount'>".$average."</span> Points" : "<span class='Pcount'>0</span> Points" ?>
                                            <!-- <span class="Pcount">+100</span> points -->
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description"><?php echo (isset($quiz['description'])) ? $quiz['description'] : "No Description Found" ?></p>
                                    </div>
                                    <div class="action_button">
                                        <form action="" class='quizPlayForm'>
                                            <input type="hidden" class="userID" name="userID" value="<?php echo (isset($user['ID'])) ? $user['ID'] : "0" ?>" >
                                            <input type="hidden" class="quizID" name="quizID" value="<?php echo (isset($quiz['ID'])) ? $quiz['ID'] : "0" ?>" >
                                            <input type="hidden" class="totalQuestions" name="totalQuestions" value="<?php echo ($totalQuestions > 0) ? $totalQuestions : 0 ?>">
                                            <?php if (isset($_SESSION['QuizInProgress']) && $_SESSION['QuizIDInProgress'] == $quiz['ID']): ?>
                                            <button type="button" class="primary-button quiz_play_button">Resume</button>
                                            <?php else: ?>
                                            <button type="button" class="primary-button quiz_play_button">Play</button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
                <!-- <div class="tab-pane container fade" id="SuperMarketQuiz">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="/assets/Icons/Supermarket Colored.svg">
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">Sports</p>
                                    <h2 class="heading">Supermarket</h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count"><span class="Qcount">10</span> questions</p>
                                    </div>
                                    <div class="total_points">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count"><span class="Pcount">+100</span> points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description">You are about to leave your home for a driving road trip, what do you bring?</p>
                                    </div>
                                    <div class="action_button">
                                        <button class="primary-button quiz_play_button">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container fade" id="LotteryQuiz">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="/assets/Icons/Lottery Colored.svg">
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">Sports</p>
                                    <h2 class="heading">Lottery</h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count"><span class="Qcount">10</span> questions</p>
                                    </div>
                                    <div class="total_points">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count"><span class="Pcount">+100</span> points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description">You are about to leave your home for a driving road trip, what do you bring?</p>
                                    </div>
                                    <div class="action_button">
                                        <button class="primary-button quiz_play_button">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container fade" id="LoveQuiz">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="/assets/Icons/Love Story Colored.svg">
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">Sports</p>
                                    <h2 class="heading">Love Story</h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count"><span class="Qcount">10</span> questions</p>
                                    </div>
                                    <div class="total_points">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count"><span class="Pcount">+100</span> points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description">You are about to leave your home for a driving road trip, what do you bring?</p>
                                    </div>
                                    <div class="action_button">
                                        <button class="primary-button quiz_play_button">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container fade" id="DateQuiz">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="/assets/Icons/The Date Colored.svg">
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">Sports</p>
                                    <h2 class="heading">The Date</h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count"><span class="Qcount">10</span> questions</p>
                                    </div>
                                    <div class="total_points">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count"><span class="Pcount">+100</span> points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description">You are about to leave your home for a driving road trip, what do you bring?</p>
                                    </div>
                                    <div class="action_button">
                                        <button class="primary-button quiz_play_button">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane container fade" id="FunParkQuiz">
                    <div class="quiz_selected_image">
                        <div class="quiz_image">
                            <img src="/assets/Icons/Fun Park Colored.svg">
                        </div>
                    </div>
                    <div class="profile_page_wrapper">
                        <div class="quiz_tab_wrapper">
                            <div class="tab_heading_container">
                                <div class="tab_heading_wrapper">
                                    <p class="category">Sports</p>
                                    <h2 class="heading">Fun Park</h2>
                                </div>
                                <div class="tab_points_wrapper">
                                    <div class="total_questions">
                                        <div class="questions_icon">
                                            <i class="fa-solid fa-question"></i>
                                        </div>
                                        <p class="questions_count"><span class="Qcount">10</span> questions</p>
                                    </div>
                                    <div class="total_points">
                                        <div class="points_icon">
                                            <i class="material-icons">
                                                extension
                                            </i>
                                        </div>
                                        <p class="points_count"><span class="Pcount">+100</span> points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_body_container">
                                <div class="tab_body_contents">
                                    <div class="tab_body_heading_wrapper">
                                        <p class="body_title">Description</p>
                                        <p class="description">You are about to leave your home for a driving road trip, what do you bring?</p>
                                    </div>
                                    <div class="action_button">
                                        <button class="primary-button quiz_play_button">Play</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="bottom-navigation desktop-only d-none"><?php include_once("./layouts/bottom_navigation.php") ?></div>
</div>




<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>

<script>
    $(document).ready(() => {

        $(document).on("click", ".quiz_play_button", (e) => {
            e.preventDefault();
            var $form = $(e.currentTarget).closest('form');
            var formValues = $form.serialize();
            console.log(formValues);
            var FormData = {
                "requestType": "beginQuiz",
                "formData": formValues
            }
            makeAjaxCall("../scripts/requestAPI.php", "POST", FormData) 
            .done((response) => {
                sessionStorage.setItem("inProgressQuizID", response.ID);
                window.location.assign("/new_quiz?play_quiz_id=" + response.ID);
            }) .fail ((xhr, error, status) => {
                console.error(xhr.responseText);
            })
        }) 



        $(".quiz_page_container .grid_item").on("click", (e) => {
            $(".quiz_page_container .grid_item").removeClass("active");
            $(e.currentTarget).addClass("active");
            var buttonPressed = $(e.currentTarget).data("id");
            $("#" + buttonPressed).tab("show");
        });



        var selected_quiz = sessionStorage.getItem("selected quiz");
        
        $("#" + selected_quiz).tab("show");
        $(".quiz_page_container .grid_item").removeClass("active");
        $(".quiz_page_container .grid_item[data-id="+ selected_quiz +"]").addClass("active");
    });
</script>
<?php include './layouts/footerEnd.php'; ?>