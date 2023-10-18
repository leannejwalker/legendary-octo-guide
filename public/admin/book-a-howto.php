<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: /public/validation/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<script language="JavaScript" type="text/javascript" src="/resources/js/jquery-3.6.0.js"></script>
  <head>
      <meta charset="UTF-8">
      <title>Book a HowTo - Share and Repair</title>
      <link rel="icon" type="image/x-icon" href="img/favicon.ico">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    body {
    background-image: url('/resources/img/background.jpg');
  }
  </style>

  <body>
  <?php include "./customer//src/header.php"?>

    
    <script>

    </script>
  </body>
</html>