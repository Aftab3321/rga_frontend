<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php 
    if ($session->isUserLoggedIn()) {
        redirect("/");
    }
    $page_title = "Sign In";
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php

$hide_notifications = true;
$hide_back_button = true;


?>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/layouts/desktop_user_mobile.php');
?>
<div id="root">
    <div class="container">
        <div class="page-wrapper">
            <div class="login-form">
                <div class="login-form--wrapper">
                    <form action="" method="POST" id="login-form">
                        <div class="form-logo">
                            <div class="logo">
                                <img src="./assets/images/site_logo.svg" alt="RGA">
                            </div>
                        </div>
                        <div class="heading">
                            <h2>Let's Sign in</h2>
                            <p>Welcome back, you've been missed!</p>
                        </div>
                        <p class="text-danger mb-0 text-center login_error_message"></p>
                        <div class="form-fields">
                            <div class="phone-number input-field">
                                <i class="material-icons">phone_in_talk</i>
                                <input type="text" name="" id="login_number" placeholder="Phone Number">
                            </div>
                            <div class="password input-field">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="" id="login_password" placeholder="***************************">
                            </div>
                            <div class="form-actions">
                                <div class="remember-me">
                                    <input type="checkbox" name="" id="remember-me">
                                    <label for="remember-me">Remember me</label>
                                </div>
                                <div class="forgot-pass">
                                    <a href="#">Forget password ?</a>
                                </div>
                            </div>
                            <div class="form-submit">
                                <button type="submit" class="button primary-button">Log in</button>
                            </div>
                            <div class="signup-section">
                                <p>Don't have an account?</p>
                                <a href="#">Sign up !</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
    $(document).ready(() => {
        $("#login-form").on("submit", (e) => {
            e.preventDefault();
            var login_phone = $("#login_number").val();
            var login_password = $("#login_password").val();

            let formData = {
                "loginPhone": login_phone,
                "loginPassword": login_password,
            }


            makeAjaxCall("/scripts/login.inc.php", "POST", formData)
                .done((response) => {
                    if (response.message.includes("login successful")) {
                        window.location.assign("/");
                    }
                })
                .fail((xhr, status, error) => {
                    console.error("Error: ", xhr.responseText);
                })
                .always(() => {
                    console.log("Ajax Call Complete");
                })


            // alert(formData);
            // $.ajax({
            //     url: "/scripts/login.inc.php",
            //     type: "post",
            //     data: formData,
            //     dataType: "json",
            //     success: (responseData) => {
            //         if (responseData.include("login successful")) {
            //             window.location.assign("/");
            //         }
            //     },
            //     error: (xhr,status,error) => {
            //         alert(xhr);
            //     }
            // })
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>