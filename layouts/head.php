<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/load.php'); ?>
<?php 
  $time = date("s");


  date_default_timezone_set('UTC');
  if (getUserCookie("user_id") == null) { 
    $user = current_user();
    $userID = ($session->isUserLoggedIn() === true) ? $user['ID'] : generateUserId();
    setUserCookie("user_id", $userID, 365);
    $pageVisited = $_SERVER['REQUEST_URI'];
    $deviceUsed = getDeviceType();
    if (recordActivity($pageVisited, $deviceUsed, $userID)) { 
        $_SESSION['recordScreenTime'] = date('H:i:s');
        $_SESSION['activitySession'] = 1;
    }

} elseif (isset($_SESSION['activitySession'])) {
    $pageVisited = $_SERVER['REQUEST_URI'];
    $userID = getUserCookie("user_id");
    // echo $userID;
    updateUserActivity($pageVisited, $userID);
} elseif (!isset(($_SESSION['activitySession'])) || getUserCookie("activity_id") == null) {
  # code...
  $pageVisited = $_SERVER['REQUEST_URI'];
  $deviceUsed = getDeviceType();
  $userID = getUserCookie("user_id");
  if (recordActivity($pageVisited, $deviceUsed, $userID)) {
      $_SESSION['recordScreenTime'] = date('H:i:s');
      $_SESSION['activitySession'] = 1;
  }
} 
else {
    $pageVisited = $_SERVER['REQUEST_URI'];
    $deviceUsed = getDeviceType();
    $userID = getUserCookie("user_id");
    if (recordExtActivity($pageVisited, $deviceUsed, $userID)) {
        $_SESSION['recordScreenTime'] = date('H:i:s');
        $_SESSION['activitySession'] = 1;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo (isset($page_title)) ? ($page_title) : "Page Title Not Set"; ?></title>

  <!-- Bootstrap CDN Links -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" />

  <!-- icons cdn -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="/assets/css/critical.css" rel="stylesheet" />
  <link href="/assets/css/styles.css" rel="stylesheet" />
  <link href="/assets/css/header.css" rel="stylesheet" />
  <link href="/assets/css/style.css" rel="stylesheet" />
  <link href="/assets/css/loginpage.css" rel="stylesheet" />
</head>

<body>
  <div id="loading_screen">
    <div class="form-logo">
      <div class="logo">
        <img src="./assets/images/site_logo.svg" alt="RGA">
      </div>
    </div>
  </div>
 
  <!-- Modal -->
<div class="modal fade" id="plusButtonModal" tabindex="-1" aria-labelledby="plusButtonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-body-wrapper">
                    <ul>
                        <li <?php echo (usersProfileExist() === true) ? "" : "class='list-group-item disabled' aria-disabled='true'"; ?>><a href="/profile" <?php echo (usersProfileExist() === true) ? "" : "style='background-color: #FCEEEE;'"; ?>>
                                <div class="icon">
                                    <object data="/assets/Icons/profile.svg"></object>
                                </div>
                                <p>Profile</p>
                            </a></li>
                        <li><a href="/tips_and_rewards">
                                <object data="/assets/Icons/tips and rewards.svg"></object>
                                <p>Tips & Rewards</p>
                            </a></li>
                        <li><a href="/bank_home">
                                <object data="/assets/Icons/quiz icon.svg"></object>
                                <p>Quizzes</p>
                            </a></li>
                        <li><a href="/insurance">
                                <object data="/assets/Icons/insurance.svg"></object>
                                <p>Insurance</p>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>