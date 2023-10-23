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
      <title>Book a Repair - Share and Repair</title>
      <link rel="icon" type="image/x-icon" href="img/favicon.ico">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    body {
      background-color: #0197c7;
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
    <form action="new_repair.php" method="post">
    <a style="color:red;">*</a>Item Category: <select id="category" name="category" required>
        <option>===SELECT AN OPTION===</option>
        <option value="Art, Antiques and Collectables">Art, Antiques and Collectables</option>
        <option value="Fashion and Accessories">Fashion and Accessories</option>
        <option value="Electronics">Electronics</option>
        <option value="Home Appliances">Home Appliances</option>
        <option value="Toys and Games">Toys and Games</option>
        <option value="Outdoor and Garden">Outdoor and Garden</option>
        <option value="Other">Other</option>
      </select><br/>
      <a style="color:red;">*</a>Item Name: <input type="text" name = "itemname" required/><br/>
      <a style="color:red;">*</a>Make: <input type="text" name = "make" required/><br/>
      <a style="color:red;">*</a>Model: <input type="text" name = "model" required/><br/>
      <a style="color:red;">*</a>Age: <select id="age" name="age" required>
        <option>===SELECT AN OPTION===</option>
        <option value="Under 1 year">Under 1 year</option>
        <option value="Between 1-2 years">Between 1-2 years</option>
        <option value="Between 3-5 years">Between 3-5 years</option>
        <option value="Between 6-10 years">Between 6-10 years</option>
        <option value="Between 11-20 years">Between 11-20 years</option>
        <option value="Over 21 years">Over 21 years</option>
        <option value="I'd rather not say">I'd rather not say</option>
      </select><br/>
      <a style="color:red;">*</a>Cost of Item: <select id="cost" name="cost" required>
        <option>===SELECT AN OPTION===</option>
        <option value="Under £5">Under £5</option>
        <option value="Between £5-£10">Between £5-£10</option>
        <option value="Between £10-£50">Between £10-£50</option>
        <option value="Between £50-£100">Between £50-£100</option>
        <option value="Over £100">Over £100</option>
        <option value="I'd rather not say">I'd rather not say</option>
      </select><br/>
      <a style="color:red;">*</a>Details of fault: <input type="text" name = "dof" required/><br/>
      <a style="color:red;">*</a>Is the item out of warranty?: <select id="oow" name="oow" required>
        <option>===SELECT AN OPTION===</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select><br/>
      <a style="color:red;">*</a>Has the item been repaired before?: <select id="prevrepair" name="prevrepair" required>
        <option>===SELECT AN OPTION===</option>
        <option value="Yes, with Share and Repair">Yes, with Share and Repair</option>
        <option value="Yes, elsewhere">Yes, elsewhere</option>
        <option value="No">No</option>
      </select><br/>
      <input style="display: none;" type="text" name="userid" hidden readonly value=<?php echo $_SESSION['id'] ?>>
      <input type="submit" />
    </form>
  </div>
    <script>
    </script>
  </body>
</html>