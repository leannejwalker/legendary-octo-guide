<?php

// Login Page
ob_start();
include "./scripts/css.php";
include "./scripts/js.php";
include "./src/misc/simple-header.php";
include "./src/auth/login.php";
$loginpage = ob_get_contents(); ob_end_clean();

//Logged In
ob_start();
include "./scripts/css.php";
include "./scripts/js.php";
include "./src/misc/header.php";
include "./pages/customers/cust-account.php";
include "./src/misc/footer.php";
$loggedin = ob_get_contents(); ob_end_clean();

?>
 