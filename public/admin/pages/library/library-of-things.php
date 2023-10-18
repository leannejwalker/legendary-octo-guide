<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: /public/validation/login.php");
    exit;
}

require_once "config.php";

$sql = ("SELECT * FROM lot");
$result = mysqli_query($link, $sql);
$singleRow = mysqli_fetch_assoc($result);
//print_r($singleRow);
//print_r($result);
//print_r($userid);

?>
<!DOCTYPE html>
<html lang="en">
<script language="JavaScript" type="text/javascript" src="/resources/js/jquery-3.6.0.js"></script>
<head>
  <meta charset="UTF-8">
  <title>All Repair Sessions - Share and Repair</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
  body {
    background-image: url('/src/resources//resources/img/background.jpg');
  }
  .main{
      border: 0.1em solid #ffffff;
      margin: 5em;
      padding-bottom: 3em;
      padding-left: 5em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
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

    #myInput {
      background-image: url('/css/searchicon.png');
      background-position: 10px 10px;
      background-repeat: no-repeat;
      width: 100%;
      font-size: 16px;
      padding: 12px 20px 12px 40px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }

</style>
<body>
    <?php include "./customer//src/header.php"?>
    <div class="main">
    <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for repairs.." title="Type in a repair">
      <table id="listrepairs">
        <tr>
          <th>Item Name</th>
          <th>Fee</th>
          <th>Item Code</th>
          <th>Item Notes</th>
          <th>Item Location</th>
        </tr>
        <?php
          foreach($result as $report) {
        ?>
        <tr>
          <td><?php echo $report['item_name']; ?></td>
          <td>£<?php echo $report['fee']; ?> per 7 days</td>
          <td><?php echo $report['category']; ?>/<?php echo $report['sub_category']; ?>/<?php echo $report['item_code
']; ?></td>
          <td><?php echo $report['item_notes']; ?></td>
          <td><?php echo $report['item_location']; ?></td>
        </tr>
        <?php
          }
        ?>
      </table>
    </div>
    <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("listrepairs");
      tr = table.getElementsByTagName("tr");
      for (i = 0, 1, 2, 3; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0, 1, 2, 3];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    </script>
</body>
</html>