<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php 
    $page_title = "Sign In";
    if ($session->isUserLoggedIn()) { 
        if (isset($_SESSIOM['currentUniqueLink']) && !$_GET['unique_link']) {
            $ul = $_SESSIOM['currentUniqueLink'];
            redirect("/sign_in?unique_link=". $ul, false);
        } elseif (isset($_SESSIOM['currentUniqueLink']) && !$_GET['unique_link']) {
            $user = current_user();
            $ul = $user['unique_link'];
            $_SESSIOM['currentUniqueLink'] = $ul;
            redirect("/sign_in?unique_link=". $ul, false);
        }
    }

?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/head.php'); ?>
<?php

if (isset($_GET['unique_link'])) {
    $unique_link = $_GET['unique_link'];
    $sql = "SELECT * FROM users WHERE unique_link = '{$db->escape($unique_link)}' LIMIT 1";
    $theUser = find_by_sql($sql);
}
?>

<div id="root2" class="sign_in_page">
    <main>
        <div class="container">
            <div class="signin_wrapper">
                <div class="sign_in">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/assets/images/Group 804.png" class="d-block w-100" alt="First Slide">
                            </div>
                            <div class="carousel-item">
                                <img src="/assets/images/Illustration_2.png" class="d-block w-100" alt="Second Slide">
                            </div>
                            <div class="carousel-item">
                                <img src="/assets/images/Illustration.png" class="d-block w-100" alt="Third Slide">
                            </div>
                        </div>

                    </div>
                    <div class="sign_in_form">
                        <div class="signin_form_wrapper">
                            <form action="" method="POST" id="login-form">
                                <div class="heading">
                                    <input type="hidden" value="<?php echo (isset($theUser['ID'])) ? $theUser['ID'] : 0; ?>" id="loggedIn">
                                    <?php if (isset($theUser)): ?>
                                        <h2 class="mb-3">Hi <?php echo $theUser[0]['username']; ?>!</h2>
                                    <?php endif; ?>
                                    <h2>Wondering if you're a cautious planner or a bold risk-taker?</h2>
                                    <p>See how you handle money and risk in just a few clicks!</p>
                                    <!-- <h2>Do you want to know your risk appetite?</h2>
                                    <p>Everyone has different financial preferences, know what is yours!</p> -->
                                </div>
                                <div class="form-fields">
                                    <?php if (!isset($theUser)): ?>
                                        <div class="password input-field">
                                            <i class="fa-solid fa-user"></i>
                                            <input type="text" name="" id="sign_in_name" placeholder="Enter Your Name">
                                        </div>
                                        <span class="text-danger error_name"></span>
                                        <div class="phone-number input-field">
                                            <i class="material-icons">mail</i>
                                            <input type="text" name="" id="sign_in_email" placeholder="Enter Email address">
                                        </div>
                                        <span class="text-danger error_email"></span>
                                    <?php endif; ?>
                                    <div class="form-submit">
                                        <a href="/bank_home">
                                            <button class="button primary-button">Let's Go!</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>










<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<script>
        $(document).ready(function() {
            $('#sign_in_carousel').carousel({
                interval: 3000, // Change image every 3 seconds
                pause: 'hover' // Pause on hover
            });
    
            // Optional: Manually control carousel with radio buttons
            $('.carousel-indicators button').on('click', function() {
                var slideTo = $(this).data('bs-slide-to');
                $('#sign_in_carousel').carousel(slideTo);
            });


            $("#login-form").on("submit", (e) => {
                e.preventDefault();

                var loginStatus = $("#loggedIn").val();
                if (loginStatus < 1) {
                    var valid_email = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                    var error_message_name = $(".error_name");
                    var error_message_email = $(".error_email");

                    error_message_email.text("");
                    error_message_name.text("");
                    var username = $("#sign_in_name").val().trim();
                    var email = $("#sign_in_email").val().trim();
                    if (username == "") {
                        error_message_name.text("Please enter your name");
                    } else if (email == "") {
                        error_message_email.text("Please enter your email");
                    } else if (!valid_email.test(email)) {
                        error_message_email.text("Please enter a valid email address");
                    } else {
                        var formData = {
                            "requestType": "bank_login_submit",
                            "username": username,
                            "email": email
                        }
                        makeAjaxCall("../scripts/requestAPI.php", "POST", formData)
                            .done((response) => {
                                if (response.message.includes("successful")) {
                                    console.log(response);
                                    window.location.assign("/bank_home");
                                }
                            })
                            .fail((xhr, error, status) => {
                                console.error(xhr.responseText);
                            })
                        }
                        
                } else {
                    window.location.assign("/bank_home");
                }
            })
        });
    </script>
<?php include './layouts/footerEnd.php'; ?>