<?php

$page_title = "Choose Quiz";
$hide_notifications = true;
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>

<div id="root2" class="home_page choose_quiz">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php');
    ?>
    <div class="home_page_wrapper">
        <div class="choose-quiz-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#" id="choose_quiz_form">
                            <div class="quiz-section inner-section">
                                <div class="section-title desktop-only">
                                    <h2>Choose Quiz</h2>
                                </div>
                                <div class="grid_container">
                                    <div class="grid_items_wrapper">
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="RoadTripQuiz" value="Road Trip">
                                            <label for="RoadTripQuiz">
                                                <div class="grid_icon">
                                                    <img src="/assets/Icons/roadtrip red.svg">
                                                </div>
                                                <div class="grid_title">
                                                    <h2>Roadtrip</h2>
                                                    <p>21 Quizzes</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="SupermarketQuiz" value="Super Market">
                                            <label for="SupermarketQuiz">
                                                <div class="grid_icon">
                                                    <img src="/assets/Icons/22-Supermarket.svg">
                                                </div>
                                                <div class="grid_title">
                                                    <h2>Supermarket</h2>
                                                    <p>18 Quizzes</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="LotteryQuiz" value="Lottery">
                                            <label for="LotteryQuiz">
                                                <div class="grid_icon">
                                                    <img src="/assets/Icons/Lottery Ticket.svg">
                                                </div>
                                                <div class="grid_title">
                                                    <h2>Lottery</h2>
                                                    <p>12 Quizzes</p>
                                                </div>

                                            </label>
                                        </div>
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="LoveStoryQuiz" value="Love Story">
                                            <label for="LoveStoryQuiz">
                                                <div class="grid_icon">
                                                    <img src="/assets/Icons/book red.svg">
                                                </div>
                                                <div class="grid_title">
                                                    <h2>Love Story</h2>
                                                    <p>12 Quizzes</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="TheDateQuiz" value="The Date">
                                            <label for="TheDateQuiz">
                                                <div class="grid_icon">
                                                    <img src="/assets/Icons/Date Icon.svg">
                                                </div>
                                                <div class="grid_title">
                                                    <h2>The Date</h2>
                                                    <p>18 Quizzes</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid_item">
                                            <input type="radio" class="d-none" name="choose_quiz" id="FunParkQuiz" value="Fun Park">
                                            <label for="FunParkQuiz">
                                                <div class="grid_icon">
                                                    <object data="/assets/Icons/Park Icon.svg"></object>
                                                </div>
                                                <div class="grid_title">
                                                    <h2>Fun Park</h2>
                                                    <p>14 Quizzes</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid-action-button">
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










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        $("#choose_quiz_form button.primary-button").addClass("disabled");
        $("#choose_quiz_form input[type='radio']").change(() => {
            $("#choose_quiz_form button.primary-button").removeClass("disabled");
        });


        $("#choose_quiz_form ").on("submit", (e) => {
            e.preventDefault();
            let selected_input = $("#choose_quiz_form input[type='radio']:checked").val();
            sessionStorage.setItem("selected quiz", selected_input);
            window.location.assign("/quiz");
        })

    })
</script>
<?php include './layouts/footerEnd.php'; ?>