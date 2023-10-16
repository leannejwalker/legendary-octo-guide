<?php

require_once "config.php";

/*$username = "brobdingnagian";
$password = "Qsvd24^54";
$database = "brobdingnagian_co_uk_";

$mysqli = new mysqli("localhost:3306", $username, $password, $database);*/

$item_picture = $link->real_escape_string($_POST['item_picture']);
$item_name = $link->real_escape_string($_POST['item_name']);
$fee = $link->real_escape_string($_POST['fee']);
$item_condition = $link->real_escape_string($_POST['item_condition']);
$category = $link->real_escape_string($_POST['category']);
$sub_category = $link->real_escape_string($_POST['sub_category']);
$item_code = $link->real_escape_string($_POST['item_code']);
$serial_number = $link->real_escape_string($_POST['serial_number']);
$item_notes = $link->real_escape_string($_POST['item_notes']);
$consumables = $link->real_escape_string($_POST['consumables']);
$item_location = $link->real_escape_string($_POST['item_location']);


$sql = "INSERT INTO lot (item_picture, item_name, fee, item_condition, category, sub_category, item_code, serial_number, item_notes, consumables, item_location)
            VALUES ('$item_picture','$item_name','$fee','$item_condition','$category','$sub_category','$item_code','$serial_number','$item_notes','$consumables','$item_location')";

// print_r($sql)
$link->query($sql);
$link->close();
header("location: library-of-things.php");
exit;
?>