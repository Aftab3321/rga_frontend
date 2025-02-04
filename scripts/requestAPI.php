<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/load.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $loggedinUser = current_user();
    $requestType = $db->escape($_POST['requestType']);

    if ($requestType == "submitEmail") {
        $email = $db->escape($_POST['email']);

        if (EmailExist($email) == false) {
            http_response_code(200);
            $response_message = [
                "message" => "Email Not Found",
            ];
        } else {
            http_response_code(400);
            $response_message = [
                "message" => "Email Found"
            ];

        }
    } elseif ($requestType == "getProfileTitle") {
        $permutation = $_POST['permutation'];
        $result = getProfileInfo($permutation);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "registerInvetee") {
        $result = submitInviteeInfo($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "submitted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot set results in database"];
        }
    } elseif ($requestType == "submitRatings") {
        $result = submitRatings($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "submitted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot set results in database"];
        }
    } elseif ($requestType == "getInviteeByID") {
        $result = getInviteeByID($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "getAdminByID") {
        $result = getAdminByID($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "updateInviteeInfo") {
        $result = updateInviteeInfo($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "submitted Successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "updateadminInfo") {
        $result = updateAdminInfo($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "submitted Successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "addInviteeFromCSV") {
        $jsonFile = $_POST['csvData'];  
        $result = submitInviteeFromCSV($jsonFile);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "Inserted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } elseif ($requestType == "deleteInvitee") {
        $userID = $_POST['inviteeId'];  
        $result = delete_by_id("invitee", $userID);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "deleted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "no user found"];
        }
    } elseif ($requestType == "deleteAdmin") {
        $userID = $_POST['adminID'];  
        $result = delete_by_id("admins", $userID);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "deleted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "no user found"];
        }
    } 
    elseif ($requestType == "addNewAdmin") {
        $adminData = $_POST; 
        $result = addNewAdmin($adminData);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "Inserted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot get results from database"];
        }
    } 
    elseif ($requestType == "changeAdminPass") {
        $result = changeAdminPass($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "Password Changed Successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot Change Password"];
        }
    } 
    elseif ($requestType == "changePassword") {
        $result = changePassword($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "Password Changed Successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "Cannot Change Password"];
        }
    } 
    elseif ($requestType == "recordScreentime") {
        if (recordScreenTime($_POST)) {
            http_response_code(200);
            $response_message = ["error" => false];
        }

    }
    elseif ($requestType == "recordPageScreentime") {
        $result = recordIndividualScreenTime($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "successful"];
        } else {
            http_response_code(400);
            $response_message = ["message" => $result];
        }
    }
    elseif ($requestType == "changeAnalyticsData") {
        $result = findAnalyticsUsingDates($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(200);
            $response_message = ["message" => "No Data Found"];
        }

    }
    elseif ($requestType == "getTodaysAnalytics") {
        $result = findTodaysAnalytics();
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(200);
            $response_message = ["message" => "No Today's Data Found"];
        }

    }
    elseif ($requestType == "getProfileById") {
        $profile_id = $_POST['profile_id'];
        $result = find_by_id("profiles", $profile_id);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(200);
            $response_message = ["message" => "No Today's Data Found"];
        }
    }
    elseif ($requestType == "getHomePara") {
        $result = find_by_id("languages",$_POST['fieldID']);
        if ($result) {
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(200);
            $response_message = ["message" => "No Data Found"];
        }
    }
    elseif ($requestType == "updateHomePara") {
        $result = updateHomeParagraph($_POST);
        if ($result) {
            http_response_code(200);
            $response_message = ["message" => "field updated successfully"];
        } else {
            http_response_code(200);
            $response_message = ["message" => "No Data Found"];
        }
    }
    elseif ($requestType == "uploadProfileImage") {
        $user = current_user();
        if ($user['ID'] == 1 || $user['ID'] == 2) {
            # code...
            $profileID = $_POST['profileID'];
            $filetoUpload = $_FILES['image'];
    
    
            $target_dir = "../uploads/";
            $target_file = $target_dir . uniqid() . "-" . basename($_FILES['image']["name"]);
    
            if (move_uploaded_file($filetoUpload["tmp_name"], $target_file)) {
                $sql = "UPDATE profiles SET profile_image = '{$db->escape($target_file)}' WHERE ID = '{$db->escape($profileID)}'";
                $db->query($sql);
                if ($db->affected_rows() > 0) {
                    http_response_code(200);
                    $response_message = ["message" => "Image Link Updated Successfully"];
                } else {
                    http_response_code(400);
                    $response_message = ["message" => "Image Link cannot be Updated"];
                }
            }
        }
    }
    elseif ($requestType == "bank_login_submit") {
        $submitLogin = bankLoginSubmit($_POST);
        if ($submitLogin > 0) {
            $session->login_user($submitLogin); 
            http_response_code(200);
            $response_message = ["message" => "submission was successful"];
        } else {
            http_response_code(400);
            $response_message = $submitLogin;

        }
    }
    elseif ($requestType == "beginQuiz") {
        $submitQuizInfo = beginQuizProgress($_POST['formData']); 
        if ($submitQuizInfo > 0 || !empty($submitQuizInfo)) {
            http_response_code(200);
            $response_message = $submitQuizInfo;
        } else {
            http_response_code(400);
            $response_message = $submitLogin;

        }
    }
    elseif ($requestType == "updateProgress") {
        if ($_POST['completeQuiz'] === 'true') {
            $submitQuizInfo = completeQuiz($_POST['formData'], $_POST['selectedAnswer'], $_POST['pointsEarned'], $_POST['selectedNextQuestion']);
            if ($submitQuizInfo) {
                http_response_code(200);
                $response_message = ["message" => "completed Successfully", "info" => $submitQuizInfo];
            } else {
                http_response_code(400);
                $response_message = ['Message' => "there was an error Completing the quiz => ". $submitQuizInfo];
            }
        } else {
            $submitQuizInfo = updateQuizProgress($_POST['formData'], $_POST['selectedAnswer'], $_POST['pointsEarned'], $_POST['selectedNextQuestion']);
            if ($submitQuizInfo) {
                http_response_code(200);
                $response_message = ["message" => "updated successfully", "info" => $submitQuizInfo];
            } else {
                http_response_code(400);
                $response_message = ['Message' => "there was an error updating the quiz ", "info" => $submitQuizInfo];
            }
        }


    }
    elseif ($requestType == "getCurrentUserInformation") {
        http_response_code(200);
        $response_message = current_user();
    }
    elseif ($requestType == "addUserGender") {
        parse_str($_POST['formData'], $formData); 
        $userid = $loggedinUser['ID'];
        $dob = $db->escape($formData['dob']);
        $age = calculateAge($dob);
        $gender = $db->escape($formData['gender']);
        $sql = "UPDATE users SET gender = '$gender', date_of_birth = '$dob', age = '{$db->escape($age)}' WHERE ID = '$userid' LIMIT 1";
        if ($db->query($sql) === true) {
            http_response_code(200);
            $response_message = ["message" => "inserted successfully"];
        } else {
            http_response_code(400);
            $response_message = ["message" => "There was an error updating the row"];
        }
    }
    elseif ($requestType == "getTotalQuizAttempted") {
        $result = getAttemptedQuiz();
        if ($result) { 
            http_response_code(200);
            $response_message = $result;
        } else {
            http_response_code(400);
            $response_message = ["message" => "There was an error getting the quiz info"];
        }
    }



} else {
    http_response_code(400);
    $response_message = [
        "message" => "Failed to submit the data"
    ];
}


header("Content-Type: Application/json");
echo json_encode($response_message);

?>