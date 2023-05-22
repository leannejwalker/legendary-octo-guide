<<<<<<< HEAD
<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Initialize the session
session_start();
require_once "scripts/config.php";

// Login Page
ob_start();
include "validation/login.php";
$loginpage = ob_get_contents(); ob_end_clean();

//Logged In
ob_start();
include "account.php";
$loggedin = ob_get_contents(); ob_end_clean();
=======
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/059448ac20.js" crossorigin="anonymous"></script>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  -ms-overflow-style: none;
  scrollbar-width: none;
background-image: url('/src/img/background.jpg');

}
*, ::after, ::before{
  box-sizing: inherit;
}

body::-webkit-scrollbar {
  display: none;
}
>>>>>>> parent of 25d2de6 (Reorder files, making customer page priority)

img{
  float: left;
  position: relative;
  block-size: 3em;
  margin-left: 18px;
  margin-right:24px;
}

.navbar {
  overflow: hidden;
  background-color: rgb(0, 0, 0);
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

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column{
  float: left;
  width: 48%;
  padding: 10px;
  height: 300px;
}
#purple{
    border: 0.5em solid #3A3684;
    margin: 1em;
    padding: 1em;
    border-radius: 1em;
    background: rgba(255, 255, 255, 0.9);
    text-align: center;
    height: 100%;
}
#nolink{
  color: black;
  text-decoration: none;
}
#nolink:hover{
  color: #F36F21;
  text-decoration: none;
}


</style>
</head>
<body>
<div class="navbar">
		<img href="https://octopus.jadith.co.uk/" src="/src/img/sar.png" alt="Octopus - The new project">
</div>

<div>
    <div class="row">
        <div class="column">
            <div id="purple">
                <h1>Octo 1</h1>
                <br />
                <p>test</p>
                <br />
                <h2><a id="nolink" href="./customer/validation/login.php"> Go to our Customer Portal <i class="fa-solid fa-circle-arrow-right" ></i></a></h2>
              </div>
        </div>
        <div class="column">
            <div id="purple">
                <h1>Octo 2</h1>
                <br />
                <p>Test</p>
                <br />
                <h2 ><a id="nolink" href="./customer/validation/login.php"> Enter the Volunteer Network <i class="fa-solid fa-circle-arrow-right" ></i></a></h2>
              </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>