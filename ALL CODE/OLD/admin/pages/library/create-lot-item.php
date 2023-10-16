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
<script language="JavaScript" type="text/javascript" src="/resources/js/jquery-3.6.0.js"></script>
  <head>
      <meta charset="UTF-8">
      <title>Create a Library of Things item - Share and Repair</title>
      <link rel="icon" type="image/x-icon" href="img/favicon.ico">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    body {
      background-image: url('/src/resources/img/background.jpg');
    }
    .main{
      border: 0.1em solid #ffffff;
      margin: 5em;
      padding-bottom: 3em;
      padding-left: 5em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
    }
    input[type=text], select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }
  </style>
  <body>
  <?php include "./customer//src/header.php"?>
  <div class="main">
    <form action="new_item.php" method="post">
    <!--upload photo-->
    <a style="color:red;">*</a>Item Name: <input type="text" name = "item_name" required/><br/>

    <a style="color:red;">*</a>Fee (per 7 days): <input type="text" name = "fee" required/><br/>


    <a style="color:red;">*</a>Item Condition: <select id="condition" name="item_condition" required>
      <option value="">===SELECT AN OPTION===</option>
      <option value="a">A - Excellent</option>
      <option value="b">B - Fair</option>
      <option value="c">C - Poor</option>
    </select><br/>

    <a style="color:red;">*</a>Item Category: <select id="category" name="category" required>
      <option>===SELECT AN OPTION===</option>
      <option value="HOM">Home</option>
      <option value="GAR">Garden and Outdoors</option>
    </select><br/>

    <a style="color:red;">*</a>Item Sub-Category: <select id="subcategory_gar" name="sub_category">
      <option value="" selected>No Sub-Category</option>
      <option value="CAM">Camping</option>
      <option value="DIY">Garden and Outdoors</option>
    </select><br/>

    <a style="color:red;">*</a>Item Sub-Category: <select id="subcategory_hom" name="sub_category">
      <option value="" selected>No Sub-Category</option>
      <option value="PAR">Parties & Events </option>
      <option value="DIY">DIY</option>
    </select><br/>

    <a style="color:red;">*</a>Item Code: <input type="text" name = "item_code" required/><br/>

    <a style="color:red;">*</a>Serial Number: <input type="text" name = "serial_number"/><br/>

    <a style="color:red;">*</a>Item Notes: <input type="text" name = "item_notes"/><br/>

    <a style="color:red;">*</a>Does this item require consumable items? <select id="consumables" name="consumables" required>
      <option>===SELECT AN OPTION===</option>
      <option value="no" selected>No</option>
      <option value="yes">Yes</option>
    </select><br/>

    <a style="color:red;">*</a>Item Location: <select id="item_location" name="item_location" required>
      <option value="shop">Shop Floor</option>
      <option value="basement" selected>Basement</option>
      <option value="upstairs">Upstairs</option>
      <option value="on_hold_a">On Hold - Being Checked</option>
      <option value="on_hold_r">On Hold - Being Repaired</option>
    </select><br/>
      <input type="submit" />
    </form>
  </div>
    <script>
    </script>
  </body>
</html>