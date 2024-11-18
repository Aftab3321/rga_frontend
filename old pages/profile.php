<?php include './layouts/header.php'; ?>
<div id="root">
    <div class="container">
        <div class="page-wrapper py-4 profile-page-wrapper">
            <div class="only-mobile progress-bar-wrapper">
                <div class="progress-bar-with-button q-pro-bar">
                    <button class="progress-back-btn" id="pro-page-back"><i class="bi bi-arrow-left"></i></button>
                    <div class="question-heading only-mobile">
                        <h2 class="large heading">
                            <?php 
                                if ($_SESSION['lang'] == "en"): 
                            ?>
                            You are 
                            <span class="profile-title-article"></span> 
                            <span class="primary-span profile-title"></span>!
                            <?php 
                                elseif ($_SESSION['lang'] == "zhh"):
                            ?>
                            你係一個
                            <span class="primary-span profile-title zhh-title"></span>!
                            <?php endif; ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="profile-image">
                        <img src="./assets/images/profile.png" alt="Profile">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="profile-container">
                        <div class="question-heading only-desktop">
                            <h2 class="large heading">
                                <?php 
                                    if ($_SESSION['lang'] == "en"): 
                                ?>
                                You are 
                                <span class="profile-title-article"></span> 
                                <span class="primary-span profile-title"></span>!
                                <?php 
                                    elseif ($_SESSION['lang'] == "zhh"):
                                ?>
                                你係一個
                                <span class="primary-span profile-title zhh-title"></span>!
                                <?php endif; ?>
                            </h2>
                        </div>
                        <div class="question-options-wrapper">
                            <p class="profile-paragraph">
                                <?php echo $langArray['profileMessage']; ?>
                            </p>
                            <p class="profile-paragraph">
                                <?php echo $langArray['mobileNumberPara']; ?>
                            </p>
                        </div>
                        <div class="question-action align-items-center">
                            <div class="email-wrapper w-100">
                                <input type="text" autocomplete="phone" class="form-control email-field" id="phone-field" name="phone-field" placeholder="Mobile Number">
                            </div>
                            <button class="arrow-button primary-button w-25" id="quiz-submit"><i class='bx bx-right-arrow-alt'></i></button>
                        </div>
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
        $("#pro-page-back").on("click", () => {
            window.location.assign("/quiz");
        })


        var userTitleEn = sessionStorage.getItem("userTitleEn");
    var userTitleZhh = sessionStorage.getItem("userTitleZhh");
    let language = sessionStorage.getItem("language");

    if (language == "en") {

        $("span.profile-title").text(userTitleEn);
        let imagePath = "./assets/profile-images/"+userTitleEn.toLocaleLowerCase()+".png";
        $(".profile-image img").attr('src', imagePath);


        let vowels = ["a", "e", "i", "o", "u"]
        if ($.inArray(userTitleEn[0], vowels) == 1) {
            $(".profile-title-article").text("An");
            showPurchasingTab();
            currentTab += 1;
        } else {
            $(".profile-title-article").text("A");
            showPurchasingTab();
            currentTab += 1;
        }
            
    } else if (language == "zhh") { 

        $("span.zhh-title").text(userTitleZhh);
        let imagePath = "./assets/profile-images/"+userTitleEn.toLocaleLowerCase()+".png";
        $(".profile-image img").attr('src', imagePath);
        showPurchasingTab();
        currentTab += 1;

    }
    })
</script>
<?php include './layouts/footerEnd.php'; ?>