<?php
 $errors = array();

 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." can't be blank.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =["", ""]){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('F j, Y, g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id($reset = false){
  static $count = 1;
  if ($reset) {
    $count = 0;
  }
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}

function generateUserId() {
  $set='123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $RandomUserID = "user_".substr(str_shuffle($set), 0, 16);
  return $RandomUserID;
}

function setUserCookie($name, $value, $days) {
  $expire = time() + ($days * 24 * 60 * 60);
  setCookie($name, $value, $expire, "/");
}

function getUserCookie($name) {
  return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function getDeviceType() {
  $userAgent = $_SERVER['HTTP_USER_AGENT'];

  $tabletKeywords = array('tablet', 'ipad', 'android 3', 'android tablet');
  $mobileKeywords = array('mobile', 'android', 'iphone', 'ipod', 'blackberry', 'opera mini', 'windows ce', 'nokia', 'symbian', 'webos');

  foreach ($tabletKeywords as $keyword) {
      if (stripos($userAgent, $keyword) !== false) {
          return 'tablet';
      }
  }

  foreach ($mobileKeywords as $keyword) {
      if (stripos($userAgent, $keyword) !== false) {
          return 'mobile';
      }
  }

  return 'desktop';
}
function preview_content($content, $word_limit = 20) {
  // Strip HTML tags from the content
  $clean_content = strip_tags($content);
  
  // Split the content into an array of words
  $words = explode(' ', $clean_content);
  
  // Limit the number of words and join them back into a string
  $limited_words = array_slice($words, 0, $word_limit);
  $preview = implode(' ', $limited_words);

  // Add an ellipsis (...) to indicate that the content is truncated
  if (count($words) > $word_limit) {
      $preview .= '...';
  }

  return $preview;
}


function calculateAge($dateOfBirth) {
  // Create a DateTime object from the date of birth
  $dob = new DateTime($dateOfBirth);
  // Create a DateTime object for the current date
  $today = new DateTime();
  // Calculate the difference between today and the date of birth
  $age = $today->diff($dob);
  
  // Return the age in years
  return $age->y;
}

?>
