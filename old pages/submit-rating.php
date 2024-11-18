<?php include './layouts/header.php'; ?>
<!-- Modal -->
<div class="modal fade" id="thankyouModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thank You</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body py-5">
        <h2 id="thankyouMessage" class="text-center my-5"></h2>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>



<div id="root">
    <div class="container">
        <div class="page-wrapper">
            <div class="only-mobile progress-bar-wrapper">
                <div class="progress-bar-with-button q-pro-bar">
                    <button class="progress-back-btn" id="rating-back"><i class="bi bi-arrow-left"></i></button>
                    <div class="question-heading only-mobile">
                        <h2 class="large heading rating-heading"><?php echo $langArray['ratingHeading']; ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="call-center-image star-rating-image">
                        <img src="./assets/images/CALL CENTER-NEW.gif" alt="Call Center Anime Image">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <div class="question-container star-rating-container">
                        <div class="question-heading">
                            <h2 class="rating-heading large heading only-desktop"><?php echo $langArray['ratingHeading']; ?></h2>
                            <p class="rating-para"><?php echo $langArray['ratingPara']; ?></p>
                        </div>
                        <div class="rating-wrapper">
                            <div class="rating-stars">
                                <form id="ratings-form" class="rating-form">
                                    <input type="hidden" id="userID" value="<?php echo (isset($_SESSION['userID'])) ? $_SESSION['userID']: "0"; ?>">
                                    <div class="rating-stars-wrapper">
                                        <label class="star-label"><?php echo $langArray['ratingLabel']; ?></label>
                                        <div class="rate">
                                            <input type="radio" value="5" name="rate" id="rate-5">
                                            <label for="rate-5"><i class='bi bi-star'></i></label>
                                            <input type="radio" value="4" name="rate" id="rate-4">
                                            <label for="rate-4"><i class='bi bi-star'></i></label>
                                            <input type="radio" value="3" name="rate" id="rate-3">
                                            <label for="rate-3"><i class='bi bi-star'></i></label>
                                            <input type="radio" value="2" name="rate" id="rate-2">
                                            <label for="rate-2"><i class='bi bi-star'></i></label>
                                            <input type="radio" value="1" name="rate" id="rate-1">
                                            <label for="rate-1"><i class='bi bi-star'></i></label>
                                        </div>
                                    </div>
                                    <div class="rating-feedback">
                                        <label for="feedback" class="feedback-label"><?php echo $langArray['feedbackLabel']; ?></label>
                                        <div class="feedback-wrapper">
                                            <input type="text" class="feedback input-field form-control" name="feedback" id="feedback" placeholder="<?php echo $langArray['feedbackPlaceholder']; ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="question-action rating-action flex-column align-items-center">
                            <button type="submit" class="button primary-button disabled" id="rating-submit"><?php echo $langArray['submitRatingButton']; ?></button>
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
        $("#ratings-form").on("change", () => {
            let rating = $(".rate input:checked").val();
            if (rating > 0) {
                $("#rating-submit").removeClass("disabled");
            } else {
                $("#rating-submit").addClass("disabled");
            }
        })
        $("#rating-back").on("click", () => {
            window.location.assign("/quiz");
        })
        $("#rating-submit").on("click", (e) => {
            e.preventDefault();
            // window.location.assign("/profile");
            let userID = $("#userID").val();
            let stars = $(".rate input:checked").val();
            let feedback = $("#feedback").val();
            if (userID != 0) {
                let formData = {
                    "requestType": "submitRatings",
                    "stars": stars,
                    "feedback": feedback,
                    "UserID": userID
                }
                $.ajax({
                    url: "./scripts/requestAPI.php",
                    type: "post",
                    data: formData,
                    dataTyep: "json",
                    success: (response) => {
                        if (response.message.includes("submitted successfully")) {
                            // window.location.assign("/thankyou");
                            if (sessionStorage.getItem("language") == "en") {
                                $("#thankyouMessage").text("Thank you!");
                                $("#thankyouModal").modal("show");
                            } else if (sessionStorage.getItem("language") == "zhh") {
                                $("#thankyouMessage").text("多謝你!");
                                $("#thankyouModal").modal("show");
                            }
                        } else {
                            console.log(response);
                        }
                    },
                    error: (xhr, error, status) => {
                        console.log(xhr.responseText);
                    }
                })
            } else {
                if (confirm("you have not taken the quiz click OK to be redirected to the quiz!")) {
                    window.location.assign("/quiz");
                } else {
                    console.log("you cannot submit the ratings unless you take a quiz");
                }
            }
        })
    })
</script>
<?php include './layouts/footerEnd.php'; ?>