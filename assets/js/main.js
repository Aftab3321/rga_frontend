function saveProfileTitle(existingPermutation) {
    let formData = {
        "requestType": "getProfileTitle",
        "permutation": existingPermutation
    }

    $.ajax({
        url: "/scripts/requestAPI.php",
        type: "post",
        data: formData,
        dataType: "json",
        success: (response) => {
            sessionStorage.setItem("profileIDEn", response.en.profile_idEn)
            sessionStorage.setItem("profileIDZhh", response.zhh.profile_idZhh)
            sessionStorage.setItem("profileTitleEn", response.en.title)
            sessionStorage.setItem("profileDescriptionEn", response.en.description)
            sessionStorage.setItem("profileImageEn", response.en.image)
            sessionStorage.setItem("profileTitleZhh", response.zhh.title)
            sessionStorage.setItem("profileDescriptionZhh", response.zhh.description)
            sessionStorage.setItem("profileImageZhh", response.zhh.image)
            setProfile()
        },
        error: (xhr, status, error) => {
            console.log(xhr.responseText);
        }
    })
    return true;
}
function setProfile() {
    var userTitleEn = sessionStorage.getItem("profileTitleEn")
    var userDescriptionEn = sessionStorage.getItem("profileDescriptionEn");
    var userImageEn = sessionStorage.getItem("profileImageEn");

    var userTitleZhh = sessionStorage.getItem("profileTitleZhh");
    var userDescriptionZhh = sessionStorage.getItem("profileDescriptionZhh");
    var userImageZhh = sessionStorage.getItem("profileImageZhh");

    let language = $("#language").val();
    sessionStorage.setItem("language", language);

    if (language == "en") {

        $("span.profile-title").text(userTitleEn);
        let imagePath = userImageEn.toLowerCase();
        $(".profile-image img").attr('src', imagePath);
        $(".profile-description").text(userDescriptionEn);
        sessionStorage.setItem("profileStatus", "set");


        let vowels = ["a", "e", "i", "o", "u"]
        if ($.inArray(userTitleEn[0], vowels) == 1) {
            $(".profile-title-article").text("An");
        } else {
            $(".profile-title-article").text("A");
        }

        showPurchasingTab();
        currentTab += 1;
        return true;
            
    } else if (language == "zhh") { 

        $("span.profile-title").text(userTitleZhh);
        let imagePath = userImageZhh.toLowerCase();
        $(".profile-image img").attr('src', imagePath);
        $(".profile-description").text(userDescriptionZhh);
        sessionStorage.setItem("profileStatus", "set");
        showPurchasingTab();
        currentTab += 1;
        return true;

    }
    return false
}



let mobileNumber = $("#phone-field-updated");
var mobileNumberIsValid = false;
mobileNumber.on("input", () => {
    $(".tooltip-text").text("");
    $(".tooltip-text").removeClass("active");
    let inputValue = mobileNumber.val();
    if (!inputValue) {
        inputValue = '';
    }

    // Check conditions
    if (!/^[569]/.test(inputValue)) {
        inputValue = inputValue.substring(1);
        $(".tooltip-text").text("The Mobile Number can only start with 5,6,9");
        $(".tooltip-text").addClass("active");
    } 
    
    if (inputValue.length > 8) {
        // Truncate the input to 8 characters
        inputValue = inputValue.substring(0, 8);
        $(".tooltip-text").text("The Mobile Number can only contain 8 digits");
        $(".tooltip-text").addClass("active");

    }

    setTimeout(() => {
        $(".tooltip-text").text("");
        $(".tooltip-text").removeClass("active");
    }, 2000);

    mobileNumber.val(inputValue)
})

$(document).ready(() => {
    $("#email-field").focusin(function() {
        $(this).keydown(function() {
            if ($(this).val().trim() != "") {
                $(".form-submit .primary-button").removeClass("disabled");
            } else {
                $(".form-submit .primary-button").addClass("disabled");
            }
        })
    })

    $("#email-field").focusout(function() {
        if ($(this).val().trim() == "") {
            $(".form-submit .primary-button").addClass("disabled");
        } else {
            $(".form-submit .primary-button").removeClass("disabled");
        }
    })


    $(".lang-btn").on("click", (e) => {
        e.preventDefault();
        var langSelected = e.target.dataset.content;
        // Get the current URL
        var currentUrl = window.location.href;

        // Check if the URL already has a lang parameter
        var langIndex = currentUrl.indexOf('lang=');

        if (langIndex !== -1) {
            // If lang parameter exists, replace its value with 'something'
            var newUrl = currentUrl.substring(0, langIndex) + 'lang=' + langSelected;

            // Navigate to the new URL
            window.location.href = newUrl;
        } else {
            // If lang parameter doesn't exist, add it to the URL
            var separator = currentUrl.includes('?') ? '&' : '?';
            var newUrl = currentUrl + separator + 'lang=' + langSelected;

            // Navigate to the new URL
            window.location.href = newUrl;
        }
    })


    $("#find-out-form").on("submit", (e) => {
        e.preventDefault();

        window.location.assign("/quiz");

        // var email = $("#email-field").val().trim();

        // $.ajax({
        //     url: "/scripts/requestAPI.php",
        //     type: "post",
        //     data: {
        //       requestType: "submitEmail",
        //       email: email
        //     },
        //     dataType: "json",
        //     success: (response) => {
              
        //       if (response.message.includes("Signup successful")) {
        //         window.location.assign("/quiz")
        //       }
        //       if (response.message.includes("go to profile")) {
        //         window.location.assign("/profile")
        //       }
        //     },
        //     error: (xhr,status,error) => {
        //         if (xhr.responseText.includes("Already Exists but quiz not taken")) {
        //             window.location.assign("/quiz")
        //         }
        //     },
        //   })
    })
    
    
    

    // profile tab from quiz submit button to redirect user to thankyou page
    $("#quiz-submit").on("click", () => {
        // window.location.assign("/thankyou");
        var phone = $("#phone-field-updated").val().trim();
        var phone_validation = /^[0-9]+$/;

        let language = sessionStorage.getItem("language");

        if (phone == "") {
            if (language == "en") {
                $("#errorMessagePrompt").text("Please enter you phone number to continue");
            } else {
                $("#errorMessagePrompt").text("請留低你嘅電話號碼。");
            }
            $("#errorMessage").modal("show");
        } else if (!phone_validation.test(phone)) {
            $("#errorMessagePrompt").text("please enter a valid phone number");
            $("#errorMessage").modal("show");
        } else {
            let name = "Not Set";
            let language = sessionStorage.getItem("language");
            let profile_id = (language == "en") ? sessionStorage.getItem("profileIDEn"):sessionStorage.getItem("profileIDZhh");
            let uniqueLink = sessionStorage.getItem("uniqueLink");
            let formData = {
                "requestType": "registerInvetee",
                "phone": phone,
                "profile_id": profile_id,
                "language": language,
                "name": name,
                "uniqueLink": uniqueLink
            }
            $.ajax({
                url: "./scripts/requestAPI.php",
                type: "post",
                data: formData,
                dataType: "json",
                success: (response) => {
                    window.location.assign("/submit-rating");
                },
                error: (xhr, error, status) => {
                    console.log(xhr.responseText);
                }
            })
        }
    })



    // submit rating button on thankyou page to redirect user to submit-rating.php
    $(".submit-review").on("click", () => {
        window.location.assign("/submit-rating");
    })

    
    


});
