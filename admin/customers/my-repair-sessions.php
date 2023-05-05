<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$userid=$_SESSION['id'];
$sql = ("SELECT * FROM users LEFT JOIN repairs ON users.id=repairs.userid WHERE users.id =".$userid."");
$result = mysqli_query($link, $sql);
$singleRow = mysqli_fetch_assoc($result);
// print_r($singleRow);
// print_r($result);
// print_r($userid);

?>
<!DOCTYPE html>
<html lang="en">
<script language="JavaScript" type="text/javascript" src="/js/jquery-3.6.0.js"></script>
<head>
  <meta charset="UTF-8">
  <title>My Repair Sessions - Share and Repair</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  body {
    background-image: url('img/background.jpg');
  }
  .main{
      border: 0.1em solid #ffffff;
      margin: 5em;
      padding-bottom: 3em;
      padding-left: 5em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.7);
    }
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    margin-left: -4.5em;
    }

    th, td {
      text-align: left;
      padding: 16px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
</style>
<body>
    <?php include "./customer/assets/header.php"?>
    <div class="main">
      <table>
        <tr>
          <th>Item Name</th>
          <th>Age</th>
          <th>Details of Fault</th>
          <th>Status</th>
        </tr>
        <?php
          foreach($result as $report) {
        ?>
        <tr>
          <td><?php echo $report['itemname']; ?></td>
          <td><?php echo $report['age']; ?></td>
          <td><?php echo $report['dof']; ?></td>
          <td><?//php echo $singleRow['status']; ?></td>
        </tr>
        <?php
          }
        ?>
      </table>
    </div>
</body>
</html>