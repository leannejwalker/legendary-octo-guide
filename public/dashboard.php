<?php

ini_set('display_errors', 1);

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
}

// Include config file
require_once ($_SERVER['DOCUMENT_ROOT'] ."/src/config.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Your Account - Share and Repair</title>
      <link rel="icon" type="image/x-icon" href="/resources/img/favicon.ico">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script language="JavaScript" type="text/javascript" src="/resources/js/jquery-3.6.0.js"></script>
    </head>
  <style>
    .main#together{
      margin: 1em;
      padding: 2em;
      border-radius: 1em;
      border-radius: 1em;
    }
    .main#orange{
      border: 0.5em solid #0081f3;
      margin: 1em;
      padding-left: 1em;
      padding-bottom: 1em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
    }
    .main#purple{
      border: 0.5em solid #3A3684;
      margin: 1em;
      padding-left: 1em;
      padding-bottom: 1em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
    }
    body {
        background-color: #262626;
    }
    h1{
        text-align: left;
        text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        color: #0081f3;
    }
    label{
        font-weight: bold;

    }
  </style>
  <body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php"?>
    <div class ="main" id="together">
        <div class="main" id="purple">
            <div> 
                <h1>Your Share and Repair Account</h1>
                <p>Welcome to your Share and Repair account. If you are new, and would like a guide through the website, please click <a href="shareandrepairguide.pdf" target="_blank" rel="noopener noreferrer"><b>here</b></a></p>
            </div>
        </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/src/footer.php"?>
    <script>

    </script>
  </body>
</html>
