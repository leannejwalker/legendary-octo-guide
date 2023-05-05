<?php

require_once "config.php";

/*$username = "brobdingnagian";
$password = "Qsvd24^54";
$database = "brobdingnagian_co_uk_";

$mysqli = new mysqli("localhost:3306", $username, $password, $database);*/

$fname = $link->real_escape_string($_POST['fname']);
$lname = $link->real_escape_string($_POST['lname']);
$username = $link->real_escape_string($_POST['username']);
$email = $link->real_escape_string($_POST['email']);
$phone = $link->real_escape_string($_POST['phone']);
$access_id = $link->real_escape_string($_POST['access_id']);

$sql = "INSERT INTO users (fname, lname, email, phone, access_id, username)
            VALUES ('$fname','$lname','$email','$phone','$access_id','$username')";

// print_r($sql)
$link->query($sql);
$link->close();
header("location: all-customers.php");
exit;
?>