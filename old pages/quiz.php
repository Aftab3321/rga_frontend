<?php include './layouts/header.php'; ?>


<!-- Modal -->
<div class="modal fade" id="errorMessage" tabindex="-1" aria-labelledby="errorMessageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p id="errorMessagePrompt" class="mb-0 py-3"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="root">
    <div class="only-desktop desktop-progress-wrapper">
        <div class="progress-bar-with-button">
            <div class="progress-bar initial-progress"></div>
            <button class="progress-back-btn--desktop initial-back" id="desktop-back-button"><i class="bi bi-arrow-left"></i></button>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="page-wrapper">
                    <ul class="nav nav-pills mb-3 d-none" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-title-tab" data-bs-toggle="pill" data-bs-target="#pills-title" type="button" role="tab" aria-controls="pills-title" aria-selected="false">Title</button>
                        </li>
                    </ul>
                    <input type="hidden" id="language" value="<?php echo $_SESSION['lang']; ?>">
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="only-mobile progress-bar-wrapper">
                                <div class="progress-bar-with-button q1-bar">
                                    <button class="progress-back-btn" id="q1-back"><i class="bi bi-arrow-left"></i></button>
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-image">
                                        <img src="/assets/images/SERVICING-<?php echo $_SESSION['lang']; ?>.gif" alt="Loyalty Program Image 1">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-container">
                                        <div class="question-heading">
                                            <h2><?php echo $langArray['q1Heading']; ?></h2>
                                        </div>
                                        <div class="question-options-wrapper">
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q1o1">
                                                        <!-- <h2 class="question-heading"><?php //echo $langArray['q1o1Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q1o1Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-one" value="No nonsense" id="q1o1" class="option question_one d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q1o2">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q1o2Heading']; ?></h2> -->
                                                        <p class="question-paragraph">
                                                            <?php echo $langArray['q1o2Para']; ?>
                                                        </p>
                                                    </label>
                                                    <input type="radio" name="question-one" value="Anniversary" id="q1o2" class="option question_one d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q1o3">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q1o3Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q1o3Para']; ?> </p>
                                                    </label>
                                                    <input type="radio" name="question-one" value="FOMO" id="q1o3" class="option question_one d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q1o4">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q1o4Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q1o4Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-one" value="VIP" id="q1o4" class="option question_one d-none">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="question-action">
                                            <button class="button primary-button" id="next-one"><?php echo $langArray['next']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="only-mobile progress-bar-wrapper">
                                <div class="progress-bar-with-button q2-bar">
                                    <button class="progress-back-btn" id="q2-back"><i class="bi bi-arrow-left"></i></button>
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-image">
                                        <img src="/assets/images/PURCHASING-<?php echo $_SESSION['lang']; ?>.gif" alt="Loyalty Program image 2">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-container">
                                        <div class="question-heading">
                                            <h2><?php echo $langArray['q2Heading']; ?></h2>
                                        </div>

                                        <div class="question-options-wrapper">
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q2o1">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q2o1Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q2o1Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-two" value="Foraging" id="q2o1" class="option question_two d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q2o2">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q2o2Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q2o2Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-two" value="Achieving" id="q2o2" class="option question_two d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q2o3">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q2o3Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q2o3Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-two" value="Learning" id="q2o3" class="option question_two d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q2o4">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q2o4Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q2o4Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-two" value="Delegating" id="q2o4" class="option question_two d-none">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="question-action">
                                            <button class="back-button only-desktop" id="back-two"><i class='bx bx-arrow-back'></i></button>
                                            <button class="button primary-button" id="next-two"><?php echo $langArray['next']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="only-mobile progress-bar-wrapper">
                                <div class="progress-bar-with-button q3-bar">
                                    <button class="progress-back-btn" id="q3-back"><i class="bi bi-arrow-left"></i></button>
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-image">
                                        <img src="/assets/images/PRODUCT-<?php echo $_SESSION['lang']; ?>.gif" alt="Loyalty Program Image 3">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="question-container">
                                        <div class="question-heading">
                                            <h2><?php echo $langArray['q3Heading']; ?></h2>
                                        </div>
                                        <div class="question-options-wrapper">
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q3o1">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q3o1Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q3o1Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-three" value="Sheltering" id="q3o1" class="option question_three d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q3o2">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q3o2Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q3o2Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-three" value="Experiencing" id="q3o2" class="option question_three d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q3o3">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q3o3Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q3o3Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-three" value="Securing" id="q3o3" class="option question_three d-none">
                                                </div>
                                            </div>
                                            <div class="question-option-wrapper">
                                                <div class="question-option">
                                                    <label for="q3o4">
                                                        <!-- <h2 class="question-heading"><?php echo $langArray['q3o4Heading']; ?></h2> -->
                                                        <p class="question-paragraph"><?php echo $langArray['q3o4Para']; ?></p>
                                                    </label>
                                                    <input type="radio" name="question-three" value="Envisioning" id="q3o4" class="option question_three d-none">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="question-action">
                                            <button class="back-button only-desktop" id="back-three"><i class='bx bx-arrow-back'></i></button>
                                            <button class="button primary-button" id="next-three"><?php echo $langArray['next']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-title" role="tabpanel" aria-labelledby="pills-title-tab">
                            <div class="only-mobile progress-bar-wrapper">
                                <div class="progress-bar-with-button q-pro-bar">
                                    <button class="progress-back-btn" id="q-pro-back"><i class="bi bi-arrow-left"></i></button>
                                    <div class="question-heading only-mobile">
                                        <h2 class="large heading">
                                            <?php
                                            if ($_SESSION['lang'] == "en") :
                                            ?>
                                                You are
                                                <span class="profile-title-article"></span>
                                                <span class="primary-span profile-title"></span>!
                                            <?php
                                            elseif ($_SESSION['lang'] == "zhh") :
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
                                        <img src="" alt="Profile">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="profile-container">
                                        <div class="question-heading only-desktop">
                                            <h2 class="large heading">
                                                <?php
                                                if ($_SESSION['lang'] == "en") :
                                                ?>
                                                    You are
                                                    <span class="profile-title-article"></span>
                                                    <span class="primary-span profile-title"></span>!
                                                <?php
                                                elseif ($_SESSION['lang'] == "zhh") :
                                                ?>
                                                    你係一個
                                                    <span class="primary-span profile-title zhh-title"></span>!
                                                <?php endif; ?>
                                            </h2>
                                        </div>
                                        <div class="question-options-wrapper">
                                            <p class="profile-paragraph profile-description">
                                                <?php echo $langArray['profileMessage']; ?>
                                            </p>
                                            <p class="profile-paragraph">
                                                <?php echo $langArray['mobileNumberPara']; ?>
                                            </p>
                                        </div>
                                        <div class="question-action align-items-center">
                                            <span id="area-code">+852</span>
                                            <div class="mobile-number-wrapper w-100 tooltip-container">
                                                <input type="text" autocomplete="phone" class="form-control mobile-field" id="phone-field-updated" name="phone-field" placeholder="Mobile Number">
                                                <div class="tooltip-text">This is a tooltip</div>
                                            </div>
                                            <button class="arrow-button primary-button w-25" id="quiz-submit"><i class='bx bx-right-arrow-alt'></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    var currentTab = 0;
    var selectedValueOne = "";
    var selectedValueTwo = "";
    var selectedValueThree = "";
    var combination = "";
    var title = "";
    function showServicingTab() {
        $("#pills-profile-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").addClass("q2-progress")
        $(".desktop-progress-wrapper .progress-bar").removeClass("initial-progress")
        $(".progress-back-btn--desktop").removeClass("initial-back");
        $(".progress-back-btn--desktop").addClass("new-q2-back");
        $(window).scrollTop(0);
    }

    function showProductTab() {
        $("#pills-contact-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").addClass("q3-progress")
        $(".desktop-progress-wrapper .progress-bar").removeClass("q2-progress")
        $(".progress-back-btn--desktop").removeClass("new-q2-back");
        $(".progress-back-btn--desktop").addClass("new-q3-back");
        $(window).scrollTop(0);
    }

    function showPurchasingTab() {
        $("#pills-title-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").addClass("d-none")
        $(".desktop-progress-wrapper .progress-bar").removeClass("q3-progress")
        $(".progress-back-btn--desktop").removeClass("new-q3-back");
        $(".progress-back-btn--desktop").addClass("new-pro-back");
        $(window).scrollTop(0);
    }

    function backToPurchasing() {
        $("#pills-contact-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").removeClass("d-none")
        $(".desktop-progress-wrapper .progress-bar").addClass("q3-progress")
        $(".progress-back-btn--desktop").addClass("new-q3-back");
        $(".progress-back-btn--desktop").removeClass("new-pro-back");
        $(window).scrollTop(0);
    }

    function backToProduct() {
        $("#pills-profile-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").removeClass("q3-progress")
        $(".desktop-progress-wrapper .progress-bar").addClass("q2-progress")
        $(".progress-back-btn--desktop").addClass("new-q2-back");
        $(".progress-back-btn--desktop").removeClass("new-q3-back");
        $(window).scrollTop(0);
    }

    function backToServicing() {
        $("#pills-home-tab").tab('show');
        $(".desktop-progress-wrapper .progress-bar").removeClass("q2-progress")
        $(".desktop-progress-wrapper .progress-bar").addClass("initial-progress")
        $(".progress-back-btn--desktop").addClass("initial-back");
        $(".progress-back-btn--desktop").removeClass("new-q2-back");
        $(window).scrollTop(0);
    }
    $(document).ready(() => {

        var profileStatus = sessionStorage.getItem("profileStatus");

        if (profileStatus == "set") {
            setProfile()
            showPurchasingTab();
            currentTab = 3;
        }

        $("#next-one").on("click", () => {
            selectedValueOne = $(".question_one:checked").val();
            if (selectedValueOne == undefined) {
                alert("Please select any option");
            } else {
                showServicingTab();
                currentTab += 1;
            }
        })
        $("#next-two").on("click", () => {
            selectedValueTwo = $(".question_two:checked").val();
            if (selectedValueTwo == undefined) {
                alert("Please select any option");
            } else {
                showProductTab();
                currentTab += 1;
            }
        })
        $("#next-three").on("click", () => {
            selectedValueThree = $(".question_three:checked").val();
            if (selectedValueThree == undefined) {
                alert("Please select any value");
            } else {
                var searchTerm = selectedValueThree.toLowerCase() + ", " + selectedValueTwo.toLowerCase() + ", " + selectedValueOne.toLowerCase();
                $("#next-three").addClass("loading");
                if (saveProfileTitle(searchTerm) == true) {
                    $("#next-three").removeClass("loading");
                } else {
                    alert("There is something wrong getting the title");
                }
            }
        })
        $("#back-four").on("click", () => {
            backToPurchasing();
            $(".profile-image img").removeAttr("src"); 
            currentTab -= 1;
        })
        $("#back-three").on("click", () => {
            backToProduct()
            currentTab -= 1;
        })
        $("#back-two").on("click", () => {
            backToServicing()
            currentTab -= 1;
        })
        $("#q-pro-back").on("click", () => {
            backToPurchasing();
            $(".profile-image img").removeAttr("src");
        })
        $("#q3-back").on("click", () => {
            backToProduct();
        })
        $("#q2-back").on("click", () => {
            backToServicing();
        })
        $("#q1-back").on("click", () => {
            window.location.assign("/");
        })

        $("#desktop-back-button").on("click", () => {
            let currTab = currentTab
            if (profileStatus == "set") {
                backToPurchasing();
                backToProduct();
                backToServicing();
                currentTab = 0;
            } else {
                if (currTab == 0) {
                    $("#q1-back").click()
                } else if (currTab === 1) {
                    $("#q2-back").click()
                } else if (currTab === 2) {
                    $("#q3-back").click()
                } else if (currTab === 3) {
                    $("#q-pro-back").click();
                }
                currentTab -= 1;
            }
            $(".profile-image img").removeAttr("src");
        })


        // let mobileNumber = $("#phone-field-updated");
        // mobileNumber.on("input", () => {
        //     $(".tooltip-text").text("");
        //     $(".tooltip-text").removeClass("active");
        //     let inputValue = mobileNumber.val();

        //     if (!inputValue) {
        //         inputValue = '';
        //     }

        //     // Check conditions
        //     if (!/^[569]/.test(inputValue)) {
        //         inputValue = inputValue.substring(1);
        //         $(".tooltip-text").text("The Mobile Number can only start with 5,6,9");
        //         $(".tooltip-text").addClass("active");
        //     } 
            
        //     if (inputValue.length > 8) {
        //         // Truncate the input to 8 characters
        //         inputValue = inputValue.substring(0, 8);
        //         $(".tooltip-text").text("The Mobile Number can only contain 8 digits");
        //         $(".tooltip-text").addClass("active");
        //     }

        //     setTimeout(() => {
        //         $(".tooltip-text").text("");
        //         $(".tooltip-text").removeClass("active");
        //     }, 2000);

        //     mobileNumber.val(inputValue)
        // })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>