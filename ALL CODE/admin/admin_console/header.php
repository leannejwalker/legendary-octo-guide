<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Initialize the session
session_start();
require_once "../config.php";
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
    exit;
}
$currentid=$_SESSION['id'];
$sql1 = ("SELECT fname, lname FROM users WHERE id=".trim($currentid)."");
$result1 = mysqli_query($link, $sql1);
$report1 = mysqli_fetch_assoc($result1);

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/059448ac20.js" crossorigin="anonymous"></script>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  -ms-overflow-style: none;
  scrollbar-width: none; 

}

body::-webkit-scrollbar {
  display: none;
}

img{
  float: left;
  position: relative;
  block-size: 3em;
  padding: 8px;
  margin-left: 18px;
  margin-right:24px;
}

.navbar {
  overflow: hidden;
  background-color: rgb(0, 0, 0);
  text-align: left;
}

.subnav#userpanel {
  float: right;
  text-align: left;
  display: block;
}
.subnav-content#userpanel{
  right:0em;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 24px 24px;
  text-decoration: none;
}

.subnav {
  float: left;
  overflow: hidden;
  display: block;
}

.subnav .subnavbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 24px 24px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .subnav:hover .subnavbtn {
  background-color: #F36F21;
}

.subnav-content {
  min-width: 120px;
  display: none;
  position: absolute;
  left: 1;
  background-color: rgb(65, 65, 65);
  z-index: 1;
}

.subnav-content a {
  min-width: 120px;
  text-align: left;
  float: left 15px;
  color: white;
  text-decoration: none;
  display: block;
}

.subnav-content a:hover {
  background-color: #F36F21;
  color: white;
}

.subnav:hover .subnav-content {
  display: flex;
  flex-direction: column;
}
h1{
  text-align: left;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
  color: #F36F21;
}
</style>
</head>
<body>
<div class="navbar">
		<img href="https://shareandrepair.org.uk" src="/img/sar.png" alt="Share and Repair">
    <h1>Volunteer Network</h1>
		<!--<a href="account.php">Account Details</a>-->
		<a href="summary.php"><i class="fa-solid fa-house"></i> Summary </a>

    <div class="subnav">
		  <button class="subnavbtn"><i class="fa-solid fa-circle-user"></i> Users <i class="fa fa-caret-down"></i></button>
			<div class="subnav-content">
        <a href="all-users.php">All Users</a>
				<a href="add-a-user.php">Add Users</a>
			</div>
		</div>

    <div class="subnav">
		  <button class="subnavbtn"><i class="fa-solid fa-handshake"></i> Borrow <i class="fa fa-caret-down"></i></button>
			<div class="subnav-content">
        <a href="/underconstruction/index.html">All Borrowed Items</a>
				<a href="/underconstruction/index.html">Currently Borrowed Items</a>
				<a href="/underconstruction/index.html">Create a Borrow</a>
			</div>
		</div>

    <div class="subnav">
		  <button class="subnavbtn"><i class="fa-solid fa-books"></i> Library of Things <i class="fa fa-caret-down"></i></button>
			<div class="subnav-content">
        <a href="library-of-things.php">All Library of Things Items</a>
				<a href="/underconstruction/index.html">Manage Library of Things Items</a>
				<a href="create-lot-item.php">Create Library of Things Item</a>
			</div>
		</div>
    
    <div class="subnav">
		  <button class="subnavbtn"><i class="fa-solid fa-wrench"></i> Repair <i class="fa fa-caret-down"></i></button>
			<div class="subnav-content">
        <a href="/underconstruction/index.html">Today's Repair Sessions</a>
			  <a href="all-repair-sessions.php">All Repair Sessions</a>
        <a href="/underconstruction/index.html">Create a Repair Session</a>
		  </div>
		</div>
    
    <div class="subnav">
		  <button class="subnavbtn"><i class="fa-solid fa-chalkboard-user"></i> How To <i class="fa fa-caret-down"></i></button>
			<div class="subnav-content">
				<a href="/underconstruction/index.html">All How To Sessions</a>
        <a href="/underconstruction/index.html">Reserve a How To Session</a>
				<a href="/underconstruction/index.html">Create a How To Session</a>

			</div>
		</div>
    <?php
      if(!empty($result1)) {
    ?>
    <div class="subnav" id="userpanel">
      <button class="subnavbtn"><?php echo $report1['fname']; ?> <?php echo $report1['lname']; ?> <i class="fa-solid fa-circle-user"></i></button>
			<div class="subnav-content" id="userpanel">
        <a href="account.php">Account Details</a>
				<a href="logout.php">Log Out</a>
			</div>
    </div>
    <?php
      }
    ?>
</div>
</body>
</html>
