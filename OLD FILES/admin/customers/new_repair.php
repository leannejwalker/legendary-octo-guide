<?php

require_once "config.php";

/*$username = "brobdingnagian";
$password = "Qsvd24^54";
$database = "brobdingnagian_co_uk_";

$mysqli = new mysqli("localhost:3306", $username, $password, $database);*/

$category = $link->real_escape_string($_POST['category']);
$itemname = $link->real_escape_string($_POST['itemname']);
$make = $link->real_escape_string($_POST['make']);
$model = $link->real_escape_string($_POST['model']);
$age = $link->real_escape_string($_POST['age']);
$cost = $link->real_escape_string($_POST['cost']);
$dof = $link->real_escape_string($_POST['dof']);
$oow = $link->real_escape_string($_POST['oow']);
$prevrepair = $link->real_escape_string($_POST['prevrepair']);
$userid = $link->real_escape_string($_POST['userid']);

$sql = "INSERT INTO repairs (category, itemname, make, model, age, cost, dof, oow, prevrepair, userid)
            VALUES ('$category','$itemname','$make','$model','$age','$cost','$dof','$oow','$prevrepair','$userid')";

// print_r($sql)
$link->query($sql);
$link->close();
header("location: my-repair-sessions.php");
exit;
?>