<?php 
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    require_once($_SERVER['DOCUMENT_ROOT']."/includes/load.php");

    
    $loginPhone = $db->escape($_POST['loginPhone']);
    $loginPassword = $db->escape($_POST['loginPassword']);

    $loginUser = authenticate_user($loginPhone, $loginPassword);

    if ($loginUser) {

        $session->login_user($loginUser); 
        http_response_code(200);
        $message = [
            "message" => "login successful",
        ];
    } else { 
        http_response_code(400);
        $message = [
            "message" => "Email Or Password Wrong"
        ];
    }
} else {

    http_response_code(400);
    $message = [
        "message" => "The form was not submitted using the button"
    ];
}

header("Contect-Type: Application/Json");
echo json_encode($message);

?>