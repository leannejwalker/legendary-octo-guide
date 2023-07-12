<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "/scripts/config.php";

$currentid=$_SESSION['id'];
$sql = ("SELECT * FROM users WHERE id=".trim($currentid)."");
$result1 = mysqli_query($link, $sql);
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

/* New style for Administrator links */
.subnav-content.admin a {
  min-width: 120px;
  text-align: left;
  float: left 15px;
  color: white;
  text-decoration: none;
  display: block;
}
</style>
</head>
<body>
<div class="navbar">
		<img href="https://shareandrepair.org.uk" src="img/sar.png" alt="Icon">
		<!--<a href="account.php">Account Details</a>-->
		
    <div class="subnav">
        <a href="/dashboard.php">Dashboard</a>
		</div>

    <?php
          // Add additional links for users with the access ID "Administrator"
          if ($_SESSION["access_id"] === "Administrator") {
              echo '<div class="subnav-content admin">';
                echo '<a href="admin/add-a-user.php">Add a User</a>';
                echo '<a href="admin_console/users.php">Manage Users</a>';
              echo '</div>';
          }
        ?>

    <?php
      if(!empty($result1)) {
        print_r($currentid);
        ?>
        <div class="subnav" id="userpanel">
          <button class="subnavbtn"><?php echo $report1['fname']; ?> <?php echo $report1['lname']; ?> <i class="fa-solid fa-circle-user"></i></button>
          <div class="subnav-content" id="userpanel">
            <a href="account.php">Account Details</a>
            <a href="/logout.php">Log Out</a>
          </div>
        </div>
        <?php
          }
    ?>
</div>
</body>
</html>
