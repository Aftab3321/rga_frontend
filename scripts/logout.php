<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/load.php");

session_start();
session_unset();
session_destroy();
$session->logout();


if (isset($_GET['bank_signin'])) {
    # code...
    redirect("/sign_in");
} else {
    redirect("/sign_in");
}

?>