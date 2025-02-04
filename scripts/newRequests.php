<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/load.php");


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    $loggedinUser = current_user();
    $requestType = $db->escape($_POST['requestType']);

    if ($requestType == "getCurrentQuizInfo") {
        $progressID = $db->escape($_POST['progressID']);
        $progressInfo = $db->query("SELECT * FROM user_quiz_progress WHERE ID = '$progressID'");
        if ($db->num_rows($progressInfo) > 0) {
            $progressData = $db->fetch_assoc($progressInfo);
            http_response_code(200);
            $response_message = $progressData;
        } else {
            http_response_code(400);
            $response_message = ["message" => "There was something wrong with the request"];

        }

    } elseif ($requestType == "getQuizInfo") {
        $quizID = $db->escape($_POST['quizID']);
        $data = [];

        $sql = "SELECT 
                    quizzes.ID as quizID,
                    quizzes.title as quizTitle,
                    questions.ID as questionID,
                    questions.question_text as questionText,
                    questions.branch_key as branchKey,
                    answers.ID as answerID,
                    answers.answer_text as answerText,
                    answers.points as answerPoints,
                    answers.next_question as nextQuestion
                FROM 
                    quizzes
                JOIN 
                    questions ON quizzes.ID = questions.quiz_id
                JOIN 
                    answers ON questions.ID = answers.question_id
                WHERE 
                    quizzes.ID = '{$db->escape($quizID)}'";

        $quizInfo = $db->query($sql);

        if ($db->num_rows($quizInfo) > 0) {
            $data = [
                "quizID" => null,
                "quizTitle" => null,
                "questions" => []
            ];

            while ($row = $db->fetch_assoc($quizInfo)) {
                // Set quiz-level information (only once)
                if (!$data["quizID"]) {
                    $data["quizID"] = $row["quizID"];
                    $data["quizTitle"] = $row["quizTitle"];
                }

                $questionID = $row["questionID"];

                // Add question and answer information
                if (!isset($data["questions"][$questionID])) {
                    $data["questions"][$questionID] = [
                        "questionID" => $questionID,
                        "questionText" => $row["questionText"],
                        "questionBranchKey" => $row["branchKey"],
                        "answers" => []
                    ];
                }

                // Add answers to the respective question
                $data["questions"][$questionID]["answers"][] = [
                    "answerID" => $row["answerID"],
                    "answerText" => $row["answerText"],
                    "answerPoints" => $row["answerPoints"],
                    "nextQuestion" => $row["nextQuestion"]
                ];
            }

            // Convert questions array to indexed format
            $data["questions"] = array_values($data["questions"]);

            http_response_code(200);
            $response_message = $data;
        } else {
            http_response_code(400);
            $response_message = ["message" => "There was something wrong with the request"];
        }


    } 
    elseif ($requestType == "completeQuiz") {
            $submitQuizInfo = completeQuiz();
            if ($submitQuizInfo) {
                http_response_code(200);
                $response_message = ["message" => "completed Successfully", "info" => $submitQuizInfo];
            } else {
                http_response_code(400);
                $response_message = ['Message' => "there was an error Completing the quiz => ". $submitQuizInfo];
            }

    } 
    elseif ($requestType == "updateProgress") {
        // if ($_POST['completeQuiz'] === 'true') {
        //     $submitQuizInfo = completeQuiz($_POST['formData'], $_POST['selectedAnswer'], $_POST['pointsEarned'], $_POST['selectedNextQuestion']);
        //     if ($submitQuizInfo) {
        //         http_response_code(200);
        //         $response_message = ["message" => "completed Successfully", "info" => $submitQuizInfo];
        //     } else {
        //         http_response_code(400);
        //         $response_message = ['Message' => "there was an error Completing the quiz => ". $submitQuizInfo];
        //     }
        // } else {
            $submitQuizInfo = updateQuizProgress($_POST['formData'], $_POST['selectedAnswer']);
            if ($submitQuizInfo) {
                http_response_code(200);
                $response_message = ["message" => "updated successfully", "info" => $submitQuizInfo];
            } else {
                http_response_code(400);
                $response_message = ['Message' => "there was an error updating the quiz ", "info" => $submitQuizInfo];
            }
        // }

    } 
    elseif ($requestType == "checkQuestionExist") {

        $quizID = $db->escape($_SESSION['QuizInProgressQuizID']);
        $branchKey = $db->escape($_POST['branchKey']);

        $result = $db->query("SELECT * FROM questions WHERE quiz_id = '$quizID' AND branch_key = '$branchKey'");
        if ($db->num_rows($result) > 0) {
            http_response_code(200);
            $response_message = true;
        } else {
            http_response_code(400);
            $response_message = false;
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