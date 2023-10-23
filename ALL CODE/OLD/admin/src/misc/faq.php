<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
      <meta charset="UTF-8">
      <title>FAQs - Share and Repair</title>
  </head>
  <style>
    body {
    background-color: #0197c7;
  }
  </style>

  <body>
  <?php include "./customer//src/header.php"?>

    
    <script>

    </script>
  </body>
</html>