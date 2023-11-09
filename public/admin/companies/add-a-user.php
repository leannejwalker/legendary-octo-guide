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
      <title>Add a User - Share and Repair</title>
      <link rel="icon" type="image/x-icon" href="img/favicon.ico">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script language="JavaScript" type="text/javascript" src="/resources/js/jquery-3.6.0.js"></script>
    </head>
  <style>
    body {
      background-color: #262626;
    }
    .main{
      border: 0.1em solid #ffffff;
      margin: 5em;
      padding-bottom: 3em;
      padding-left: 5em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.7);
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
    <form action="new_user.php" method="post" id="adduser">
      <a style="color:red;">*</a>First Name:<input type="text" name = "fname" class='fname' id='fname' required/><br/>
      <a style="color:red;">*</a>Last Name: <input type="text" name = "lname" required/><br/>
      <a style="color:red;">*</a>Username: <input type="text" name="username" required><br/>
      <a style="color:red;">*</a>Email Address: <input type="text" name = "email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/><br/>
      <a style="color:red;">*</a>Telephone or Mobile number: <input type="text" name="tel" pattern="[+ 0-9]{11}" required><br/>
    
      <br/>
      <a style="color:red;">*</a>Required Access Type: <select id="access_id" name="access" onchange="yesnoCheck(this)" required>
        <option value="" selected="true" disabled>===SELECT AN OPTION===</option>
        <option id="user" value="Customer">User</option>
        <option id="repairer" value="Volunteer">Volunteer</option>
        <option id="admin" value="Administrator">Administrator</option>
      </select><br/>
      
        <div id="ifUser" style="display: none;">
            <a style="color:red;">*</a><label for="member"> Are they a Member? </label><select id="member" name="member" onchange="yesnoCheck(this)" required>
                <option value="" selected="true" disabled>===SELECT AN OPTION===</option>
                <option value="No">No Membership</option>
                <option value="Regular">Bath Library of Things Regular Gift Membership</option>
                <option value="Super">Bath Library of Things Super Gift Membership</option>
            </select><br/>
        </div>
        <!-- <input type="checkbox" id="welcome" name="welcome" value="yes">
        <label for="welcome"> Do you want to send<div class='printfname' id='printfname'></div>a welcome email?</label><br> -->
        <input type="submit" />
    </form>
  </div>
    <script>
    function yesnoCheck(that) {
        if (that.value == 'Customer') {
            document.getElementById("ifUser").style.display = "block";
        } else {
            document.getElementById("ifUser").style.display = "none";
        }
    }

    $("#adduser").submit(function(event){
        // var valDDL = $(this).val();  
        //event.preventDefault();
         var valDDL = $("#access_id").val();
         if(valDDL=="")
         {
            event.preventDefault();
         } 
    });

    $("#adduser").submit(function(event){
        // var valDDL = $(this).val();  
        //event.preventDefault();
         var valDDL = $("#ifUser").val();
         if(valDDL=="")
         {
            event.preventDefault();
         } 
    });

    var inputBox = document.getElementById('fname');

    inputBox.onkeyup = function(){
        document.getElementById('printfname').innerHTML = inputBox.value;
    }
    </script>
  </body>
</html>