<?php

function createUniqueLink()
{
  $set = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  return substr(str_shuffle($set), 0, 16);
}

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table)
{
  global $db;
  if (tableExists($table)) {
    return find_by_sql("SELECT * FROM " . $db->escape($table));
  }
}
/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function EmailExist($email)
{
  global $db;
  $email = $db->escape($email);
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $db->query($sql);
  return ($db->num_rows($result) == 1) ? true : false;
}
/*--------------------------------------------------------------*/
/* Function for adding new user
/*--------------------------------------------------------------*/
function SignupUser($email)
{
  global $db;
  $uniqueLink = createUniqueLink();

  $name = "Not Set";
  $email = $db->escape($email);
  $password = password_hash('Default@1234', PASSWORD_DEFAULT);
  $role = 4;

  $sql = "INSERT INTO users(`Name`,`Email`,`Password`,`UniqueLink`,`Role`) VALUES('$name','$email','$password','$uniqueLink','$role')";
  $result = $db->query($sql);
  return ($db->affected_rows($result) > 0) ? true : false;
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table, $id)
{
  global $db;
  $id = (int)$id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE ID ='{$db->escape($id)}' LIMIT 1");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_foreign_id($table, $column_name, $id)
{
  global $db;
  $id = (int)$id;
  if (tableExists($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($column_name)} ='{$db->escape($id)}'");
    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table, $id)
{
  global $db;
  if (tableExists($table)) {
    $sql = "DELETE FROM " . $db->escape($table);
    $sql .= " WHERE id=" . $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table)
{
  global $db;
  if (tableExists($table)) {
    $sql    = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
function authenticate_user($phone = '', $password = '')
{
  global $db;
  $phone = $db->escape($phone);
  $password = $db->escape($password);
  $sql  = "SELECT * FROM users WHERE phone_number ='{$phone}' LIMIT 1";
  $result = $db->query($sql);
  if ($db->num_rows($result) > 0) {
    $user = $db->fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
      return $user['ID'];
    } 
  } 
  return null;
}
/*--------------------------------------------------------------*/
/* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
function authenticate_admin($email = '', $password = '')
{
  global $db;
  $email = $db->escape($email);
  $password = $db->escape($password);
  $sql  = "SELECT * FROM admins WHERE Email ='{$email}' LIMIT 1";
  $result = $db->query($sql);
  if ($db->num_rows($result) > 0) {
    $user = $db->fetch_assoc($result);
    if (password_verify($password, $user['Password'])) {
      return $user['ID'];
    } 
  } 
  return false;
}


/*--------------------------------------------------------------*/
/* Find current log in user by session id
  /*--------------------------------------------------------------*/
function current_user()
{
  static $current_user;
  global $db;
  global $session;
  if (!$current_user) {
    if ($session->isUserLoggedIn()) :
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id('users', $user_id);
    endif;
  }
  return $current_user;
}
/*--------------------------------------------------------------*/
/* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
function find_all_user()
{
  global $db;
  $results = array();
  $sql = "SELECT * FROM users WHERE id > 2";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* Find all Group name
  /*--------------------------------------------------------------*/
function find_by_groupName($val)
{
  global $db;
  $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Find group level
  /*--------------------------------------------------------------*/
function find_by_groupLevel($level)
{
  global $db;
  $sql = "SELECT Role FROM roles WHERE ID = '{$db->escape($level)}' LIMIT 1 ";
  $result = $db->query($sql);
  return ($db->num_rows($result) === 0 ? true : false);
}
/*--------------------------------------------------------------*/
/* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
function page_require_level($require_level)
{
  global $session;
  $current_user = current_user();
  $login_level = find_by_groupLevel($current_user['Role']);
  //if user not login
  if (!$session->isUserLoggedIn(true)) {
    $session->msg('d', 'Please login...');
    redirect('index.php', false);}
  //cheackin log in User level and Require level is Less than or equal to
  elseif ($current_user['Role'] <= (int)$require_level) {
    return true;
  }
  else {
    $session->msg("d", "Sorry! you dont have permission to view the page.");
    redirect('/admin/dashboard', false);
  }
}





// fwd insurance functions
/*--------------------------------------------------------------*/
/* Function for getting the language from the database
  /*--------------------------------------------------------------*/
  function getLanguage() {
    global $db;
    $lang = $db->escape($_SESSION['lang']);
    $langArray = [];
    $sql = "SELECT lang_key, lang_val FROM languages WHERE lang = '$lang'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      while ($row = $db->fetch_assoc($result)) {
        $langArray[$row['lang_key']] = $row['lang_val'];
      }
      return $langArray;
    } else {
      return false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for getting the profile information from the database
  /*--------------------------------------------------------------*/
  function getProfileInfo($permutation) {
    global $db;
    $permutation = $db->escape($permutation);
    $profile_info = [
      "en" => [],
      "zhh" => []
    ];
    $sql = "SELECT * FROM profiles WHERE existing_permutation = '$permutation'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      while ($row = $db->fetch_assoc($result)) {
        if ($row['profile_language'] == "en") {
          $profile_info["en"]["profile_idEn"] = $row["ID"];
          $profile_info["en"]["title"] = $row["profile_title"];
          $profile_info["en"]["description"] = $row["profile_final"];
          $profile_info["en"]["image"] = $row["profile_image"];
        } elseif ($row['profile_language'] == "zhh") {
          $profile_info["zhh"]["profile_idZhh"] = $row["ID"];
          $profile_info["zhh"]["title"] = $row["profile_title"];
          $profile_info["zhh"]["description"] = $row["profile_final"];
          $profile_info["zhh"]["image"] = $row["profile_image"];
        }
      }
      return $profile_info;
    } 
    return false;
  }
/*--------------------------------------------------------------*/
/* Function for submitting Ratings in the database
  /*--------------------------------------------------------------*/
  function submitRatings($data) {
    global $db;
    $stars = $data['stars'];
    $feedback  = $data['feedback'];
    $UserID = $data['UserID'];

    if (isset($_SESSION['userID']) AND $_SESSION['userID'] == $UserID) {
      $sql = "INSERT INTO ratings(stars,feedback,User_ID)";
      $sql .= " VALUES('{$db->escape($stars)}','{$db->escape($feedback)}','{$db->escape($UserID)}')";
      $db->query($sql);
      return ($db->affected_rows() > 0) ? true : false;
    } else {
      return false;
    }

  }
/*--------------------------------------------------------------*/
/* Function for geting Invitee information from the database
  /*--------------------------------------------------------------*/
  function getAllInvitees() {
    global $db;
    $sql = "SELECT invitee.*, profiles.* FROM invitee LEFT JOIN profiles ON invitee.profile_id = profiles.ID";
    $result = find_by_sql($sql);
    return $result; 
  }
/*--------------------------------------------------------------*/
/* Function for geting front end from the database
  /*--------------------------------------------------------------*/
  function getFrontEnd() {
    global $db;
    $user = current_user();
    if ($user['Role'] == 1) {
      $sql = "SELECT * FROM languages WHERE lang_key = 'homePara'";
      $result = find_by_sql($sql);
      return $result; 
    } else {
      return false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for updating front end on the database
  /*--------------------------------------------------------------*/
  function updateHomeParagraph($data) {
    global $db;
    $user = current_user();
    if ($user['Role'] == 1) {
      $fieldID = $db->escape($data['fieldID']);
      $lang = $db->escape($data['lang']);
      $value = $db->escape($data['value']);
      $sql = "UPDATE languages SET lang_val = '$value' WHERE id = '$fieldID' AND lang = '$lang'";
      $db->query($sql);
      return ($db->affected_rows() > 0) ? true : false; 
    } else {
      return false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for get Admins information from the database
  /*--------------------------------------------------------------*/
  function getAllAdmins() {
    global $db;
    $sql = "SELECT admins.*, roles.Role AS 'RoleName' FROM admins RIGHT JOIN roles ON admins.Role = roles.ID WHERE admins.Role > 1";
    $result = find_by_sql($sql);
    return $result;
  }
/*--------------------------------------------------------------*/
/* Function for submitting Invitee information in the database
  /*--------------------------------------------------------------*/
  function submitInviteeInfo($data) {
    global $db;

    $uniqueLink = $data['uniqueLink'];
    $name = $data['name'];
    $language = $data['language'];
    $profile_id = $data['profile_id'];
    $phone = $data['phone'];

    if (!str_starts_with($phone, "5") || !str_starts_with($phone, "6") || !str_starts_with($phone, "9") && strlen($phone) !== 8) {
      return false;
    }
    else {
      $sql = "SELECT * FROM invitee WHERE unique_link = '{$db->escape($uniqueLink)}' LIMIT 1";
      $result = $db->query($sql);

      if ($db->num_rows($result) > 0) {
          $row = $db->fetch_assoc($result);
          $sql = "UPDATE invitee SET profile_id = '{$db->escape($profile_id)}', language_preference = '{$db->escape($language)}', ";
          $sql .= "mobile_number = '{$db->escape($phone)}' WHERE id = {$row['id']}";
          $_SESSION['userID'] = $row['id'];
      } else {
          $uniqueLink = createUniqueLink();
          $sql = "INSERT INTO invitee(name, profile_id, language_preference, mobile_number, unique_link) ";
          $sql .= "VALUES('{$db->escape($name)}','{$db->escape($profile_id)}','{$db->escape($language)}','{$db->escape($phone)}','{$db->escape($uniqueLink)}')";
      }

      $db->query($sql);

      if (!isset($_SESSION['userID'])) {
          $_SESSION['userID'] = $db->insert_id();
      }

      return ($db->affected_rows() > 0) ? true : false;
    }
}

/*--------------------------------------------------------------*/
/* Function for getting Invitee information in the database
  /*--------------------------------------------------------------*/
  function getInviteeByID($data) {
    global $db;
    $inviteeID = $data['inviteeID'];
    $myID  = $data['myID'];


    $result = find_by_id("admins", $myID);
    if ($result != null AND $result['ID'] <= 2) {
      $Invitee = find_by_id("invitee", $inviteeID);
      return ($Invitee != null) ? $Invitee : false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for getting Invitee information in the database
  /*--------------------------------------------------------------*/
  function getAdminByID($data) {
    global $db;
    $adminID = $data['adminID'];
    $user = current_user();
    $userRole = $user['Role'];

    if ($userRole <= 2) {
      $Admin = find_by_id("admins", $adminID);
      return ($Admin != null) ? $Admin : false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for updating Invitee information in the database
  /*--------------------------------------------------------------*/
  function updateInviteeInfo($data) {
    global $db;
    $lang = $data['lang'];
    $name  = $data['name'];
    $userID  = $data['userID'];
    $uniqueLink  = $data['uniqueLink'];

    $sql = "UPDATE invitee SET name = '{$db->escape($name)}', language_preference = '{$db->escape($lang)}', unique_link = '{$db->escape($uniqueLink)}' WHERE id = '{$db->escape($userID)}'";
    $db->query($sql);

    return ($db->affected_rows() > 0) ? true : false;
  }
/*--------------------------------------------------------------*/
/* Function for updating Admin information in the database
  /*--------------------------------------------------------------*/
  function updateAdminInfo($data) {
    global $db;
    $user = current_user();
    if ($user['Role'] == 1) {
      $role = $data['role'];
      $name  = $data['name'];
      $userID  = $data['userID'];
      $email  = $data['email'];
  
      $sql = "UPDATE admins SET Name = '{$db->escape($name)}', Email = '{$db->escape($email)}', Role = '{$db->escape($role)}' WHERE id = '{$db->escape($userID)}'";
      $db->query($sql);
  
      return ($db->affected_rows() > 0) ? true : false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for invitee information from the database on Unique Link
  /*--------------------------------------------------------------*/
  function getInviteeByUL($data) {
    global $db;
    $uniqueLink = $data;

    $sql = "SELECT * FROM invitee WHERE unique_link = '{$db->escape($uniqueLink)}'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      $user = $db->fetch_assoc($result);
      return $user;  
    } else {
      return false;
    } 
  }
/*--------------------------------------------------------------*/
/* Function for inserting invitee from csv file
  /*--------------------------------------------------------------*/
  function submitInviteeFromCSV($data) {
    global $db;
    $user = current_user();
    $userRole = $user['Role'];
    $userID = $user['ID'];
    $errors = false;
    if ($userRole <= 2 && $userRole > 0) {
      foreach($data as $value) {
        if ($value['UniqueLink'] == "") {
          $uniqueLink = createUniqueLink();
          $sql = "INSERT INTO invitee(name, mobile_number, unique_link, invited_by)";
          $sql .= " VALUES('{$db->escape($value['Name'])}','{$db->escape($value['Mobile Number'])}','{$db->escape($uniqueLink)}','{$db->escape($userID)}')";
        } else {
          $sql = "INSERT INTO invitee(name, mobile_number, unique_link, invited_by)";
          $sql .= " VALUES('{$db->escape($value['Name'])}','{$db->escape($value['Mobile Number'])}','{$db->escape($value['uniqueLink'])}','{$db->escape($userID)}')";
        }
        $db->query($sql);
        $errors = ($db->affected_rows() > 0) ? false : true;
      }
    }

    return ($errors == false) ? true : false;
  }
/*--------------------------------------------------------------*/
/* Function for inserting invitee from csv file
  /*--------------------------------------------------------------*/
  function addNewAdmin($data) {
    global $db;
    $user = current_user();
    $userRole = $user['Role'];
    if ($userRole == 1) {
      $adminName = $_POST['adminName'];
      $adminRole = $_POST['adminRole'];
      $adminEmail = $_POST['adminEmail'];
      $adminPassword = $_POST['adminPassword'];
      $password = password_hash($adminPassword, PASSWORD_DEFAULT);
      $sql = "INSERT INTO admins(Name,Email,Password,Role)";
      $sql .= " VALUES('{$db->escape($adminName)}','{$db->escape($adminEmail)}','{$db->escape($password)}','{$db->escape($adminRole)}')";
      $db->query($sql);
      return ($db->affected_rows() > 0) ? true : false;
    } else {
      return false;
    }
 
  }
/*--------------------------------------------------------------*/
/* Function for updating admin user password by super admin
  /*--------------------------------------------------------------*/
  function changeAdminPass($data) {
    global $db;
    $user = current_user();
    $userRole = $user['Role'];
    $strongPasswordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if ($userRole == 1) {
      $adminPassword = $_POST['password'];
      $adminID = $_POST['adminID'];

      if (!preg_match($strongPasswordRegex, $adminPassword)) {
        return false;
      } else {
        $enc_pass = password_hash($adminPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE admins SET Password = '{$db->escape($enc_pass)}' WHERE ID = '{$db->escape($adminID)}'";
        $db->query($sql);
        return ($db->affected_rows() > 0) ? true : false;
      } 
  }
}
/*--------------------------------------------------------------*/
/* Function for updating admin user password by super admin
  /*--------------------------------------------------------------*/
  function changePassword($data) {
    global $db;
    $user = current_user();
    $userID = $user['ID'];
    $strongPasswordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    $result = find_by_id("admins", $userID);
    $currentPassword = $result['Password'];

    $oldPassword = $_POST['oldPass'];
    $newPassword = $_POST['newPass'];

    if (password_verify($oldPassword, $currentPassword)) {
      if (!preg_match($strongPasswordRegex, $newPassword)) {
        return false;
      } else {
        $enc_pass = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE admins SET Password = '{$db->escape($enc_pass)}' WHERE ID = '{$db->escape($userID)}'";
        $db->query($sql);
        return ($db->affected_rows() > 0) ? true : false;
      }
    }
}

/*--------------------------------------------------------------*/
/* Function for inserting analytics data related to user interactions;
  /*--------------------------------------------------------------*/
  function recordActivity($page, $device, $user) {
    global $db;
    $dateNow = date("Y-m-d H:i:s");
    $sql = "INSERT INTO user_activity(user_id, activity_date, device_type, pages_visited, pages)";
    $sql .= " VALUES('{$db->escape($user)}','$dateNow','{$db->escape($device)}','{$db->escape(1)}','{$db->escape($page)}')";
    $result = $db->query($sql);
    $activity_id = $db->insert_id($result);
    $_SESSION['activity_id'] = $activity_id;
    setUserCookie("activity_id", $activity_id, 1);
    return ($db->affected_rows() > 0) ? true : false;
  }
/*--------------------------------------------------------------*/
/* Function for inserting analytics data related to user interactions;
  /*--------------------------------------------------------------*/
  function recordExtActivity($page, $device, $user) {
    global $db;
    $dateNow = date("Y-m-d H:i:s");
    $sql = "INSERT INTO user_activity(user_id, activity_date, device_type, pages_visited, pages, user_type)";
    $sql .= " VALUES('{$db->escape($user)}','$dateNow','{$db->escape($device)}','{$db->escape(1)}','{$db->escape($page)}', '2')";
    $result = $db->query($sql);
    $_SESSION['activity_id'] = $db->insert_id($result);
    return ($db->affected_rows() > 0) ? true : false;
  }
/*--------------------------------------------------------------*/
/* Function for inserting analytics data related to user interactions;
  /*--------------------------------------------------------------*/
  function updateUserActivity($page, $user) {
    global $db;

    $activity_id = $_SESSION['activity_id'];
    $sql = "SELECT * FROM user_activity WHERE user_id = '{$db->escape($user)}' AND id = '{$db->escape($activity_id)}'";
    $result = $db->query($sql);
    $activity = $db->fetch_assoc($result);
    $db_pages = $activity['pages'];
    if (strpos($db_pages, ",")) {
      $pages = explode(",", $db_pages);
    } else {
      $pages = [$db_pages];
    }
    if (!in_array($page, $pages)) {
      $updated_pages = $db_pages . ",{$db->escape($page)}";
      $sql = "UPDATE user_activity SET pages = '{$db->escape($updated_pages)}', pages_visited = pages_visited + 1";
      $sql .= " WHERE id = '{$db->escape($activity_id)}'";
      $db->query($sql);
      return ($db->affected_rows() > 0) ? true : false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for inserting analytics data related to user interactions;
  /*--------------------------------------------------------------*/
  function recordScreenTime($time) {
    global $db;
    if (isset($_SESSION['activitySession'])) {
      $activity_id = $db->escape($_SESSION['activity_id']);
      $screentime = $db->escape($time['screenTime']);
      $sql = "UPDATE user_activity SET screen_time = screen_time + '$screentime' WHERE id = '$activity_id'";
      $db->query($sql);
      return ($db->affected_rows() > 0) ? true : false;
    }

  }
/*--------------------------------------------------------------*/
/* Function for inserting screen time for each screen;
  /*--------------------------------------------------------------*/
  function recordIndividualScreenTime($data) {
    global $db;
    $activity_id = $db->escape($_SESSION['activity_id']);
    $screentime = $db->escape($data['screenTime']);
    $page = $db->escape($data['pageUrl']);
    $sql = "SELECT * FROM screen_activity WHERE user_id = '$activity_id'";
    $result = $db->query($sql);
    $isEntryAvailable = false;
    if ($db->num_rows($result) > 0) {
      $rows = $db->while_loop($result);
      foreach ($rows as $value) {
        if ($value['page_url'] == $page) {
          $isEntryAvailable = true;
        }
      }

      if ($isEntryAvailable != false) {
        $sql = "UPDATE screen_activity SET screentime = screentime + '$screentime' WHERE user_id = '$activity_id' AND page_url = '$page'";
      } else {
        $sql = "INSERT INTO screen_activity(user_id, screentime, page_url) VALUES('$activity_id', '$screentime', '$page')";
      }

    } else {
      $sql = "INSERT INTO screen_activity(user_id, screentime, page_url, dropped_off) VALUES('$activity_id', '$screentime', '$page', '1')";
    }

    $db->query($sql);
    return ($db->affected_rows() > 0) ? true : false;

  }

  /*--------------------------------------------------------------*/
/* Functions for analytical data
  /*--------------------------------------------------------------*/
  function totalSessionsToday() {
    global $db;
    $sql = "SELECT COUNT(DISTINCT user_id) AS total_sessions_today FROM user_activity WHERE DATE(activity_date) = CURDATE();";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      return $db->fetch_array($result);
    } else {
      return 0;
    }
  }
  function totalNewUsersToday() {
    global $db;
    $sql = "SELECT COUNT(DISTINCT user_id) AS total_new_users_today
    FROM user_activity
    WHERE DATE(activity_date) = CURDATE() AND user_type = 1;";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      return $db->fetch_array($result);
    } else {
      return 0;
    }
  }
  function totalScreenTimeToday() {
    global $db;
    $user = current_user();
    if ($user['ID']) {
      $sql = "SELECT AVG(screen_time / 60000) AS average_screentime_today
      FROM user_activity
      WHERE DATE(activity_date) = CURDATE();";
      $result = $db->query($sql);
      if ($db->num_rows($result) > 0) {
        return $db->fetch_array($result);
      } else {
        return 0;
      }
    }
  }
  function totalUsers() {
    global $db;
    $user = current_user();
    if ($user['ID']) {
      $sql = "SELECT COUNT(id) AS total_users
      FROM invitee";
      $result = $db->query($sql);
      if ($db->num_rows($result) > 0) {
        return $db->fetch_array($result);
      } else {
        return 0;
      }
    }
  }
  function findAnalyticsUsingDates($data) {
    global $db;
    $startDateTimestamp = $db->escape($data['startDate']);
    $endDateTimestamp = $db->escape($data['endDate']);
    $analytics = [];
    $user = current_user();
    if ($user['ID']) {
      {
        if ($startDateTimestamp == "begining") {
          $sql = "SELECT COUNT(id) as totalInvitee, created_on as registration_date FROM invitee GROUP BY MONTH(`created_on`)";
        } else {
          $sql = "SELECT COUNT(id) as totalInvitee, created_on as registration_date FROM invitee WHERE created_on BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' GROUP BY `created_on`";
        }
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['invitee'][] = $row;
          }
        }
      } 
      {
        if ($startDateTimestamp == "beginning") {
          $sql = "SELECT COUNT(i.profile_id) as Invitee, p.profile_title, DATE(i.created_on) as registration_date 
                  FROM invitee i 
                  INNER JOIN profiles p ON i.profile_id = p.ID 
                  WHERE i.profile_id IS NOT NULL 
                  GROUP BY p.profile_title";
      } else {
          $sql = "SELECT COUNT(i.profile_id) as Invitee, p.profile_title, DATE(i.created_on) as registration_date 
                  FROM invitee i 
                  INNER JOIN profiles p ON i.profile_id = p.ID 
                  WHERE i.created_on BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' AND i.profile_id IS NOT NULL 
                  GROUP BY p.profile_title";
      }
      
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['profiles'][] = $row;
          }
        }
      } 
      {
        if ($startDateTimestamp == "begining") {
          $sql = "SELECT device_type, COUNT(*) AS device_count FROM user_activity GROUP BY `device_type`";
        } else {
          $sql = "SELECT device_type, COUNT(*) AS device_count FROM user_activity WHERE activity_date BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' GROUP BY `device_type`";
        }
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['devices'][] = $row;
          }
        }
      }
      {
        if ($startDateTimestamp == "begining") {
          $sql = "SELECT activity_date, AVG(screen_time / 60000) AS total_screentime FROM user_activity GROUP BY `user_id`";
        } else {
          $sql = "SELECT activity_date, AVG(screen_time / 60000) AS total_screentime FROM user_activity WHERE activity_date BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' GROUP BY `user_id`";
        }
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['screentime'][] = $row;
          }
        }
      }
      {
        if ($startDateTimestamp == "begining") {
          $sql = "SELECT activity_date, AVG(screentime / 60000) AS avg_screentime, page_url FROM screen_activity GROUP BY `page_url`";
        } else {
          $sql = "SELECT activity_date, AVG(screentime / 60000) AS avg_screentime, page_url FROM screen_activity WHERE activity_date BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' GROUP BY `page_url`";
        }
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['pageScreentime'][] = $row;
          }
        }
      }
      {
        if ($startDateTimestamp == "begining") {
          $sql = "SELECT activity_date, COUNT(DISTINCT(user_id)) as totalUsers, page_url FROM screen_activity WHERE dropped_off = '1' GROUP BY `user_id`";
        } else {
          $sql = "SELECT activity_date, COUNT(DISTINCT(user_id)) as totalUsers, page_url FROM screen_activity WHERE dropped_off = '1' AND activity_date BETWEEN '$startDateTimestamp' AND '$endDateTimestamp' GROUP BY `user_id`";
        }
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['userDroppedOff'][] = $row;
          }
        }
      }


    }
    return $analytics;
  }
  function findTodaysAnalytics() {
    global $db;
    $analytics = [];
    $dateToday = date("Y-m-d");
    $user = current_user();
    if ($user['ID']) {
      {
        // $sql = "SELECT COUNT(user_id) as totalUsers, activity_date FROM user_activity WHERE user_type = 1 GROUP BY `user_id`";
        $sql = "SELECT
          CASE
            WHEN HOUR(activity_date) BETWEEN 0 AND 3 THEN '12 AM - 3 AM'
            WHEN HOUR(activity_date) BETWEEN 4 AND 7 THEN '4 AM - 7 AM'
            WHEN HOUR(activity_date) BETWEEN 8 AND 11 THEN '8 AM - 11 AM'
            WHEN HOUR(activity_date) BETWEEN 12 AND 15 THEN '12 PM - 3 PM'
            WHEN HOUR(activity_date) BETWEEN 16 AND 19 THEN '4 PM - 7 PM'
            WHEN HOUR(activity_date) BETWEEN 20 AND 23 THEN '8 PM - 11 PM'
          END AS time_slot,
          COUNT(*) AS user_activity
          FROM user_activity
          WHERE user_type = 1 AND DATE(activity_date) = '$dateToday'
          GROUP BY time_slot
        ";
        $result = $db->query($sql);
        if ($db->num_rows($result) > 0) {
          while ($row = $db->fetch_assoc($result)) {
            $analytics['newUsers'][] = $row;
          }
        }
      } 
    }
    return $analytics;
  }






////////////////////////////////////////////// new functions //////////////////////////////////
function usersProfileExist() {
  global $db;
  $user = current_user();
  $userid = $user['ID'];
  $sql = $db->query("SELECT * FROM users_profiles WHERE user_id = '{$db->escape($userid)}'");
  return ($db->num_rows($sql) > 0) ? true : false;
}
function bankLoginSubmit($data) {
  global $db;
  $username = $db->escape($data['username']);
  $email = $db->escape($data['email']);
  $uniqueLink = createUniqueLink();


  
  if (empty($username) || empty($email)) {
    return false;
  } else {
    if (EmailExist($email)) {
      $sql = "SELECT * FROM users WHERE email = '{$db->escape($email)}'";
      $result = $db->query($sql);
      if ($db->num_rows($result) > 0) {
        $user = $db->fetch_assoc($result);
        $user_id = $user['ID'];
        $_SESSION['currentUniqueLink'] = $uniqueLink;
        return $user_id;
      } else {
        return false;
      }
    } else {
      $sql = "INSERT INTO users(username, email, unique_link)
      VALUES('$username','$email', '{$db->escape($uniqueLink)}');
      ";
      $db->query($sql);
      if ($db->affected_rows() > 0) {
        $user_id = $db->insert_id();
        $sql = "INSERT INTO users_profiles(user_id, profile_id) VALUES('$user_id','12');";
        // $db->query($sql);
        $_SESSION['currentUniqueLink'] = $uniqueLink;
        return $user_id;
      } else {
        return false;

      }
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for get Questions by quiz from the database
  /*--------------------------------------------------------------*/
  // function findTotalQuestionsByQuizId($quiz_id = '')
  // {
  //   global $db;
  //   $quiz_id = $db->escape($quiz_id);
  //   $sql = "SELECT ID, COUNT(ID) AS total_question_count FROM questions WHERE quiz_id = '$quiz_id'";
  //   $result = find_by_sql($sql);
  
  //   return $result;
  // }
  /*--------------------------------------------------------------*/
  /* Function for get Questions by quiz from the database
    /*--------------------------------------------------------------*/
  function findQuestionsByQuizId($quiz_id = '')
  {
    global $db;
    $quiz_id = $db->escape($quiz_id);
    $sql = "SELECT * FROM questions WHERE quiz_id = '$quiz_id'";
    $result = find_by_sql($sql);
  
    return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function for get Total Points by quiz from the database
    /*--------------------------------------------------------------*/
  function findTotalPointsByQuestionId($question_id = '')
  {
    global $db;
    $question_id = $db->escape($question_id);
    $sql = "SELECT ID, SUM(points) AS total_points FROM answers WHERE question_id = '$question_id'";
    $result = find_by_sql($sql);
  
    return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function for begining the quiz
    /*--------------------------------------------------------------*/
  function beginQuizProgress($data)
  {
    global $db;
    parse_str($data, $formData);
    $quiz_id = $db->escape($formData['quizID']);
    $user_id = $db->escape($formData['userID']);
    $totalQuestions = $db->escape($formData['totalQuestions']);
    $sql = "SELECT * FROM user_quiz_progress WHERE quiz_id = '$quiz_id' AND user_id = '$user_id'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      $progress_Quiz_info = $db->fetch_assoc($result);
    } else {
      $sql = "INSERT INTO user_quiz_progress(user_id, quiz_id, total_questions) VALUES('$user_id','$quiz_id','$totalQuestions')";
      $result = $db->query($sql);
      $progress_id = $db->insert_id($result);
    }
    $_SESSION['QuizInProgress'] = (isset($progress_id)) ? $progress_id : $progress_Quiz_info['ID'];
    $_SESSION['QuizIDInProgress'] = $quiz_id;
    return (isset($progress_id)) ? ["ID" => $progress_id] : $progress_Quiz_info;
  }

  /*--------------------------------------------------------------*/
  /* Function for updating the quiz answers
    /*--------------------------------------------------------------*/
  function insertUserAnswer($data) {
    global $db;
    parse_str($data, $formData);
    $quizID = $db->escape($formData['quizID']);
    $userID = $db->escape($formData['userID']);
    $questionID = $db->escape($formData['questionID']);
    $option = $db->escape($formData['option']);
    $pointsEarned = $db->escape($formData['pointsEarned']);

    $sql = "SELECT * FROM user_quiz_answers WHERE user_id = '$userID' AND quiz_id = '$quizID' AND question_id = '$questionID' AND selected_answer_id = '$option'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      $sql = "UPDATE user_quiz_answers SET selected_answer_id = '$option' WHERE user_id = '$userID' AND quiz_id = '$quizID' AND question_id = '$questionID'";
    } else {
      $sql = "INSERT INTO user_quiz_answers(user_id, quiz_id, question_id, selected_answer_id, points_earned) "; 
      $sql .= " VALUES('$userID','$quizID','$questionID','$option','$pointsEarned')";
    }

    $db->query($sql);
    if ($db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
  /*--------------------------------------------------------------*/
  /* Function for updating the quiz
    /*--------------------------------------------------------------*/
  function updateQuizProgress($data, $next_question)
  {
    global $db;
    insertUserAnswer($data);
    
    parse_str($data, $formData);
    $quizID = $db->escape($formData['quizID']); 
    $userID = $db->escape($formData['userID']);
    $quizInProgressID = $db->escape($formData['quizInProgressID']);
    $next_question = $db->escape($next_question);
    $pointsEarned = $db->escape($formData['pointsEarned']);

    $db->query("UPDATE user_quiz_progress SET current_question = '$next_question', current_question_count = `current_question_count` + 1, answered_questions = `answered_questions` + 1, points_earned = points_earned + '{$db->escape($pointsEarned)}' WHERE ID = '$quizInProgressID' AND user_id = '$userID' AND quiz_id = '$quizID'");
    $NQ = $db->query("SELECT * FROM questions WHERE quiz_id = '$quizID' AND branch_key = '$next_question' LIMIT 1");
    if ($db->num_rows($NQ) > 0) {
      $q = $db->fetch_assoc($NQ);
      $q_id = $q['ID'];
      $res = $db->query("SELECT * FROM answers WHERE question_id = '{$db->escape($q_id)}'");
      if ($db->num_rows($res) > 0) {
        $answ = [];
        while ($rows = $db->fetch_assoc($res)) {
          array_push($answ, $rows);
        } 
        $answers = $answ;
        $result = ["question" => $q,
                   "answers" => $answers,
                  "selected next question" => $next_question];
        return $result;
      }
    } else {
      return false;
    }
  }


    /*--------------------------------------------------------------*/
  /* Function for getting the appropirate profile ID
    /*--------------------------------------------------------------*/
  function getProfileByPoints($averagePoints) {
    global $db;
    
    // Fetch all profiles from the database
    $query = "SELECT * FROM profiles";
    $result = $db->query($query);

    while ($profile = $db->fetch_assoc($result)) {
        $pointsRange = $profile['points'];

        // Handle various range types
        if (strpos($pointsRange, '+') !== false) {
            // Case for "31+" (greater than or equal to 31)
            $minValue = (int) filter_var($pointsRange, FILTER_SANITIZE_NUMBER_INT);
            if ($averagePoints >= $minValue) {
                return $profile; // Return profile for 31+
            }
        } elseif (strpos($pointsRange, 'less than') !== false || strpos($pointsRange, '<') !== false) {
            // Case for "less than 0" or "< 0" (less than 0)
            if ($averagePoints < 0) {
                return $profile; // Return profile for less than 0
            }
        } elseif (strpos($pointsRange, '-') !== false) {
            // Case for range "21-30" or "13-20"
            list($minValue, $maxValue) = explode('-', $pointsRange);
            $minValue = (int) $minValue;
            $maxValue = (int) $maxValue;
            
            if ($averagePoints >= $minValue && $averagePoints <= $maxValue) {
                return $profile; // Return profile for ranges like "21-30"
            }
        }
    }

    // Default return if no profile matches (optional)
    return null;
}

  /*--------------------------------------------------------------*/
  /* Function for completing the quiz
    /*--------------------------------------------------------------*/
  function completeQuiz($data, $next_question)
  {
    global $db;
    $user = current_user();
    updateQuizProgress($data, $next_question);
    
    parse_str($data, $formData);
    $quizID = $db->escape($formData['quizID']);
    $userID = $db->escape($formData['userID']);
    $quizInProgressID = $db->escape($formData['quizInProgressID']);

    $sql = "SELECT SUM(points_earned) AS total_points FROM user_quiz_answers WHERE user_id = '$userID' AND quiz_id = '$quizID'";
    $result = $db->query($sql);
    if ($db->num_rows($result) > 0) {
      $points = $db->fetch_assoc($result)['total_points'];
      $sql = $db->query("SELECT * FROM user_quizzes WHERE quiz_id = '$quizID' AND user_id = '$userID'");
      $quiz_exist = ($db->num_rows($sql) > 0) ? true : false;
      if ($quiz_exist) {
        $sql = "UPDATE user_quizzes SET total_score = '$points' WHERE quiz_id = '$quizID' AND user_id = '$userID'";
      } else {
        $sql = "INSERT INTO user_quizzes(user_id, quiz_id, total_score) VALUES('$userID','$quizID','$points')";

      }
      $db->query($sql);
      $pointsQuetySql = $db->query("SELECT SUM(total_score) AS total_points_earned FROM user_quizzes WHERE user_id = '$userID'");
      $points_query = ($db->num_rows($pointsQuetySql) > 0) ? $db->fetch_assoc($pointsQuetySql) : false;
      $totalPointsEarned = ($points_query != false) ? $points_query['total_points_earned'] : 0;
      $profile = getProfileByPoints($points);
      $profile_id = $profile['ID'];
      $sql = $db->query("SELECT * FROM users_profiles WHERE user_id = '$userID'");
      $user_profile = ($db->num_rows($sql) > 0) ? true : false;
      if ($user_profile) {
        $sql = "UPDATE users_profiles SET profile_id = '{$db->escape($profile_id)}' WHERE user_id = '{$db->escape($user['ID'])}'";
      } else {
        $sql = "INSERT INTO users_profiles(user_id, profile_id) VALUES('{$db->escape($user['ID'])}','{$db->escape($profile_id)}')";
      }
      $db->query($sql);
      $sql = "DELETE FROM user_quiz_progress WHERE user_id = '$userID' AND quiz_id = '$quizID' AND ID = '$quizInProgressID'";
      $db->query($sql);
      unset($_SESSION['QuizInProgress']);
      unset($_SESSION['QuizIDInProgress']);
      $return_array = ["points" => $points, "profile" => $profile];
      return ($db->affected_rows() > 0) ? $return_array : false;
    }
  }
/*--------------------------------------------------------------*/
/* Function for get Total Points by quiz from the database
  /*--------------------------------------------------------------*/
  function findMaximumPoints($quizID) {
    global $db; // Assuming $db is your database connection object
    
    $result = $db->query("SELECT ID FROM questions WHERE quiz_id = '{$db->escape($quizID)}' AND branch_key = '1'");
    if ($db->num_rows($result) < 1) {
      return;
    }
    $firstQuestion = $db->fetch_assoc($result);
    $questionId = $firstQuestion["ID"];
    $sql = "SELECT MAX(points) AS points, next_question FROM answers WHERE question_id = '{$db->escape($questionId)}' LIMIT 1";
    $result = $db->query($sql);
    $answer = $db->fetch_assoc($result);
    $totalPoints = $answer['points'];
    $next_question = $answer['next_question'];

    while (true) {
        // Fetch the answer with the maximum points for the given question ID
        $result = $db->query("SELECT * FROM questions WHERE branch_key = '{$db->escape($next_question)}' LIMIT 1");
        $questions = $db->fetch_assoc($result);
        $question = $db->escape($questions['ID']);

        $sql = "SELECT MAX(points) AS points, next_question FROM answers WHERE question_id = '$question' LIMIT 1";
        $result = $db->query($sql);
        $answer = $db->fetch_assoc($result);


        if (!$question) {
            // If no answer is found, break out of the loop
            break;
        }

        // Add the points of the selected answer to the total score
        $totalPoints += $answer['points'];

        // Move to the next question
        if ($answer['next_question'] != "") {
          # code...
          $next_question = $answer['next_question'];
        } else {
          break;
        }
    }

    return $totalPoints;
}
/*--------------------------------------------------------------*/
/* Function for get Questions by quiz from the database
  /*--------------------------------------------------------------*/
  function findTotalQuestionsByQuizId($quiz_id = '')
{
    global $db;
    $totalQuestions = 0;
    $quiz_id = $db->escape($quiz_id);
    $branch_key = '1'; // Start with the initial branch key

    while (true) {
        // Query to find the current question based on quiz_id and branch_key
        $sql = $db->query("SELECT * FROM questions WHERE quiz_id = '$quiz_id' AND branch_key = '{$db->escape($branch_key)}'");
        
        // Check if the question was found; if not, terminate the loop
        if ($db->num_rows($sql) === 0) {
            break;
        }

        $totalQuestions += 1;
        $result = $db->fetch_assoc($sql);

        // Get the question ID to find the next answer
        $question_id = $result['ID'];

        // Query to get the answer's next question
        $answer_sql = $db->query("SELECT * FROM answers WHERE question_id = '{$db->escape($question_id)}' LIMIT 1");
        $answer_result = ($db->num_rows($answer_sql) > 0) ? $db->fetch_assoc($answer_sql) : false;

        if ($answer_result && !empty($answer_result['next_question'])) {
            // Update branch_key with the next question’s branch_key
            $branch_key = $answer_result['next_question'];
        } else {
            // No further question or next_question is empty; exit loop
            break;
        }
    }

    return $totalQuestions;
}


/*--------------------------------------------------------------*/
/* Function for getting attempted quizzes from the database
  /*--------------------------------------------------------------*/
  function getAttemptedQuiz()
  {
    global $db;
    $result = [];
    $this_month = date('m');
    $user  = current_user();
    $user_id = $db->escape($user['ID']);
    $sql = $db->query("SELECT COUNT(ID) AS quiz_attempted FROM user_quizzes WHERE user_id = '$user_id'");
    $result1 = $db->fetch_assoc($sql);
    $sql = $db->query("SELECT COUNT(ID) AS quiz_attempted_this_month FROM user_quizzes WHERE user_id = '$user_id' AND MONTH(`completed_at`) = '{$db->escape($this_month)}'");
    $result2 = $db->fetch_assoc($sql);
    $sql = $db->query("SELECT COUNT(ID) AS total_quizzes FROM quizzes");
    $result3 = $db->fetch_assoc($sql);
    array_push($result, $result1);
    array_push($result, $result2);
    array_push($result, $result3);

  
    return $result;
  }