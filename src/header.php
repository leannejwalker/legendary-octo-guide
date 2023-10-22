<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] ."/src/config.php";

$currentid=$_SESSION['id'];
$sql = ("SELECT * FROM users WHERE id=".trim($currentid)."");
$result1 = mysqli_query($link, $sql);
$report1 = mysqli_fetch_assoc($result1);

$currentid = $_SESSION['id'];
$sql = "SELECT access_id FROM users WHERE id = " . intval($currentid);
$result = mysqli_query($link, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $access_id = $row['access_id'];
    } else {
        $access_id = "unknown";
    }
} else {
    $access_id = "unknown";
}

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
  background-color: #0081f3;
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
  background-color: #0081f3;
  color: white;
}

.subnav:hover .subnav-content {
  display: flex;
  flex-direction: column;
}

/* New style for Administrator links
.subnav-content.admin a {
  min-width: 120px;
  text-align: left;
  float: left 15px;
  color: white;
  text-decoration: none;
  display: block;
}*/
</style>
</head>
<body>
<div class="navbar">
<img href="https://shareandrepair.org.uk" src="/resources/img/AQUAE_SULIS_DARKER_BLUE.png" alt="Aquae Sulis Web Solutions Home">
    <div class="subnav">
        <a href="/dashboard.php">Dashboard</a>
		</div>
    <?php
          // Add additional links for users with the access ID "Administrator"
          if ($access_id === "admin") {
            echo '<a href="/public/services.php">Customers</a>';
            echo '<a href="/support.php">Companies</a>';
            echo '<a href="/faq.php">Orders</a>';
            echo '<a href="/faq.php">Jobs</a>';
            // Email Marketing Subnav
            echo '<div class="subnav">';
            echo '<button class="subnavbtn"><i class="fa-solid fa-handshake"></i> Marketing <i class="fa fa-caret-down"></i></button>';
            echo '<div class="subnav-content">';
              echo '<a href="/public/admin/user-management/add-a-user.php">Email</a>';
              echo '<a href="/public/admin/user-management/all-users.php">Social Media</a>';
              echo '</div>';
            echo '</div>';
            // End of Email Marketing Subnav
            echo '<a href="/support.php">Billing</a>';
            echo '<a href="/faq.php">Alerts</a>';
            echo '<a href="/faq.php">Reports & Analytics</a>';
          }

          // Add additional links for users with the access ID "Customer"
          if ($access_id === "customer") {
          // Services Subnav
            echo '<div class="subnav">';
            echo '<button class="subnavbtn"><i class="fa-solid fa-handshake"></i> Services <i class="fa fa-caret-down"></i></button>';
            echo '<div class="subnav-content">';
              echo '<a href="/public/admin/user-management/add-a-user.php">All Services</a>';
              echo '<a href="/public/admin/user-management/all-users.php">Partner Services</a>';
              echo '</div>';
            echo '</div>';
            // End of Services Subnav
            // Billing Subnav
            echo '<div class="subnav">';
            echo '<button class="subnavbtn"><i class="fa-solid fa-handshake"></i> Billing <i class="fa fa-caret-down"></i></button>';
            echo '<div class="subnav-content">';
              echo '<a href="/public/admin/user-management/add-a-user.php">Invoices</a>';
              echo '<a href="/public/admin/user-management/all-users.php">Payment Methods</a>';
              echo '<a href="/public/admin/user-management/all-users.php">Account Balance</a>';
              echo '</div>';
            echo '</div>';
            // End of Billing Subnav
            // Email Marketing Subnav
              echo '<div class="subnav">';
              echo '<button class="subnavbtn"><i class="fa-solid fa-handshake"></i> Support <i class="fa fa-caret-down"></i></button>';
              echo '<div class="subnav-content">';
                echo '<a href="/public/admin/user-management/add-a-user.php">FAQ</a>';
                echo '<a href="/public/admin/user-management/all-users.php">Knowledge Base</a>';
                echo '<a href="/public/admin/user-management/all-users.php">Contact Support</a>';
                echo '</div>';
              echo '</div>';
            // End of Email Marketing Subnav
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
            <?php
              if ($access_id === "customer") {
                echo '<a href="/faq.php">Company Details</a>';
                echo '<a href="/faq.php">Orders</a>';
                echo '<a href="/faq.php">Approvals</a>';
              }
            ?>
            <a href="orders.php">Settings</a>
            <a href="logout.php">Log Out</a>
          </div>
        </div>
        <?php
          }
    ?>
</div>
</body>
</html>
