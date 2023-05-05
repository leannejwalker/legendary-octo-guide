<?php
session_start();
require_once "/scripts/config.php";

$id=$_SESSION['id'];
$fname = $link->real_escape_string($_POST['fname']);
$lname = $link->real_escape_string($_POST['lname']);
$email = $link->real_escape_string($_POST['email']);
$phone = $link->real_escape_string($_POST['phone']);

$sql = "UPDATE users SET fname = $fname, lname = $lname, email = $email, phone = $phone WHERE id='$id'";

// print_r($sql)
$link->query($sql);
$link->close();
header("location: /src/misc/account.php");
exit;
?>

