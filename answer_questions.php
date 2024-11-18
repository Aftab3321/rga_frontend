<?php

$page_title = "Answer Questions";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>


<div id="root2" class="insurance_page answer_question_page">
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_header.php');
    include($_SERVER['DOCUMENT_ROOT'] . '/layouts/header_with_profile.php');
    ?>
    <div class="page_wrapper">
            <div class="insurance_detail_wrapper">
                <form action="" class="insurance_form">
                    <div class="insurance_form-contents">
                        <div class="question q2">
                            <div class="question_text">
                                <p class="fs-5 fw-bold">Please answer the following questions to complete your application.</p>
                            </div>
                        </div>
                        <div class="insurance_personal_details">
                            <ol>
                                <!-- <li>
                                    <div class="question_wrapper">
                                        <div class="question q1">
                                            <div class="question_text">
                                                <p>What is your height and weight
                                                    Are you unable to work, or are you unable to complete all your regular duties and normal hours of work?</p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q1Yes">Yes</label>
                                                    <input type="radio" checked name="answer1" id="Q1Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q1No">No</label>
                                                    <input type="radio" class="no_answer" name="answer1" id="Q1No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                                <li>
                                    <div class="question_wrapper">
                                        <div class="question q2">
                                            <div class="question_text">
                                                <p>Have you ever had symptoms of, or been diagnosed with, or had treatment or medication for:
                                                    <br><br>
                                                    Cancer or tumour of any type
                                                    Hepatitis, HIV, AIDS or any AIDS or HIV related conditions
                                                    Heart complaint and/or chest pain
                                                    Neurological conditions including epilepsy, stroke, multiple sclerosis or motor neurone disease
                                                    Inflammatory bowel disorder including, ulcerative colitis, crohn’s disease, irritable bowel syndrome
                                                    Suffered from high blood pressure or high cholesterol?
                                                </p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q2Yes">Yes</label>
                                                    <input type="radio" class="yes_answer"name="answer2" id="Q2Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q2No">No</label>
                                                    <input type="radio" checked class="no_answer" name="answer2" id="Q2No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="question_wrapper">
                                        <div class="question q3">
                                            <div class="question_text">
                                                <p>In your lifetime, have you had symptoms, treatment (including surgery) of any of the following:
                                                    Any injury or complaint of the back, neck, knee or shoulder and/or any degeneration to the muscles, tendons or bones (including discs and joints)?
                                                </p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q3Yes">Yes</label>
                                                    <input type="radio" class="yes_answer"name="answer3" id="Q3Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q3No">No</label>
                                                    <input type="radio" checked class="no_answer" name="answer3" id="Q3No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="question_wrapper">
                                        <div class="question q4">
                                            <div class="question_text">
                                                <p>In your lifetime have you had any symptoms of, or being diagnosed with or had treatment for:<br>
                                                    Depression, anxiety or any mental disorder (for example, stress, panic attacks, behavioural disorder or Post Traumatic Stress Disorder)?
                                                </p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q4Yes">Yes</label>
                                                    <input type="radio" class="yes_answer"name="answer4" id="Q4Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q4No">No</label>
                                                    <input type="radio" checked class="no_answer" name="answer4" id="Q4No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="question_wrapper">
                                        <div class="question q5">
                                            <div class="question_text">
                                                <p>
                                                    Do you intend to seek any medical advice, tests or investigations, treatment or surgery?
                                                </p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q5Yes">Yes</label>
                                                    <input type="radio" class="yes_answer"name="answer5" id="Q5Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q5No">No</label>
                                                    <input type="radio" checked class="no_answer" name="answer5" id="Q5No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="question_wrapper">
                                        <div class="question q6">
                                            <div class="question_text">
                                                <p>
                                                    Have two or more of your parents or siblings suffered from any of the following, under the age of 60:<br>
                                                    Heart disease<br>
                                                    Stroke<br>
                                                    Huntington’s disease<br>
                                                    Diabetes<br>
                                                </p>

                                            </div>
                                            <div class="gender_wrapper">
                                                <div class="yes radio_button">
                                                    <label for="Q6Yes">Yes</label>
                                                    <input type="radio" class="yes_answer" name="answer6" id="Q6Yes">
                                                </div>
                                                <div class="no radio_button">
                                                    <label for="Q6No">No</label>
                                                    <input type="radio" checked class="no_answer" name="answer6" id="Q6No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="insurance_form_action">
                        <button class="button primary-button">Pay Now</button>
                    </div>
                    <div class="insurance_form_error"></div>
                </form>
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


            $(document).on("change", "input[type='radio']", (e) => {
                if($(".yes_answer").is(":checked")) {
                    $(".insurance_form_action button").addClass('disabled');
                    var error_message  = $("<p>").addClass("text-danger").text("Sorry, you cannot proceed further at this point in time. We will contact you with more information");
                    $(".insurance_form_error").html(error_message);
                    sessionStorage.setItem("yes_answer_selected", true);
                } else {
                    $(".insurance_form_action button").removeClass('disabled');
                    $(".insurance_form_error").html("");
                    sessionStorage.removeItem("yes_answer_selected");
                }
            })
            $(".insurance_form_action button").on("click", (e) => {
                e.preventDefault();
                sessionStorage.setItem("question_answers_cleared", true);
                window.location.assign("/payment_details");
            })

        })
    </script>
<?php include './layouts/footerEnd.php'; ?>