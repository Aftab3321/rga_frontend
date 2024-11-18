<?php
 session_start();

class Session {

 public $msg;
 private $user_is_logged_in = false;
 private $admin_is_logged_in = false;

 function __construct(){
   $this->flash_msg();
   $this->userLoginSetup();
 }
 
  public function isUserLoggedIn(){
    return $this->user_is_logged_in;
  }
  public function isAdminLoggedIn(){
    return $this->admin_is_logged_in;
  }


  public function login_user($user_id){
    $_SESSION['user_id'] = $user_id;
  }


  public function admin_login($user_id){
    $_SESSION['ID'] = $user_id;
  }


  private function userLoginSetup()
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_is_logged_in = true;
    } 
    elseif(isset($_SESSION['ID']))
    {
      $this->admin_is_logged_in = true;
    } else {
      $this->user_is_logged_in = false;
      $this->admin_is_logged_in = false;
    }

  }


  public function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['ID']);
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}

$session = new Session();
$msg = $session->msg();

?>
