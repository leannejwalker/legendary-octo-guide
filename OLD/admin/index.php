<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

// Initialize the session
session_start();

require_once "./scripts/config.php";
require_once "./scripts/echo.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

    echo $loginpage;
    // header("location: /src/auth/login.php");
}


// Check if the user is logged in
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){

    echo $loggedin;

}
?>