<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Initialize the session
session_start();
require_once "scripts/config.php";

// Login Page
ob_start();
include "scripts/css.php";
include "scripts/js.php";
include "src/misc/simple-header.php";
include "src/auth/login.php";
$loginpage = ob_get_contents(); ob_end_clean();

//Logged In
ob_start();
include "src/misc/header.php";
include "src/misc/account.php";
include "src/misc/footer.php";
$loggedin = ob_get_contents(); ob_end_clean();

// Check if the user is logged in
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){

     // If loggined in, redirect to summary/account page
     if(isset($loggedin)){
         echo $loggedin;
//     };

// };
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    
//     if(isset($loginpage)){
//         echo $loginpage;
//     };

// };
?>