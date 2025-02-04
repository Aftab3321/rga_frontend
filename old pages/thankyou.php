<?php include './layouts/header.php'; ?>
<div id="root">
    <div class="container">
        <div class="page-wrapper">
            <!-- <div class="only-mobile progress-bar-wrapper">
                <div class="progress-bar-with-button q-pro-bar">
                    <button class="progress-back-btn" id="ty-back"><i class="bi bi-arrow-left"></i></button>
                    <div class="question-heading only-mobile">
                        <h2 class="large heading"><?php echo $langArray['thankyouMessage']; ?></h2>
                    </div>
                </div>
            </div> -->
            <div class="row align-items-end">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="call-center-image">
                        <img src="./assets/images/CALL CENTER-NEW.gif" alt="Call Center Anime Image">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="thankyou-container">
                        <div class="question-heading thank-you-heading only-desktop">
                            <h2 class="large heading"><?php echo $langArray['thankyouMessage']; ?></h2>
                        </div>
                        <div class="question-options-wrapper">
                            <p class="profile-paragraph">
                            <?php echo $langArray['thankyouPara']; ?>
                            </p>

                        </div>
                        <div class="question-action flex-column align-items-center">
                            <button class="button primary-button" id="quiz-submit"><?php echo $langArray['thankyouButton']; ?></button>
                            <!-- <a href="/submit-rating" class="link submit-review"><?php echo $langArray['submitReviewLink']; ?></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include './layouts/footer.php'; ?>
<?php include './layouts/footerScript.php'; ?>
<?php include './layouts/footerEnd.php'; ?>