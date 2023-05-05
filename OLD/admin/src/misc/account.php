<?php
$currentid=$_SESSION['id'];
$sql1 = ("SELECT * FROM users WHERE id=".$currentid."");
$result = mysqli_query($link, $sql1);
$singleRow = mysqli_fetch_assoc($result);
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("Refresh:0");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Your Account - Share and Repair</title>
      <?php include "./scripts/js.php"?>
    </head>
    <style>
    .main#together{
      margin: 1em;
      padding: 2em;
      border-radius: 1em;
      border-radius: 1em;
    }
    .main#orange{
      border: 0.5em solid #F36F21;
      margin: 1em;
      padding-left: 1em;
      padding-bottom: 1em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
    }
    .main#purple{
      border: 0.5em solid #3A3684;
      margin: 1em;
      padding-left: 1em;
      padding-bottom: 1em;
      border-radius: 1em;
      background: rgba(255, 255, 255, 0.9);
    }
    body {
        background-image: url('/src/img/background.jpg');
    }
    h1{
        text-align: left;
        text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        color: #F36F21;
    }
    label{
        font-weight: bold;

    }
  </style>
  <body>
    <div class ="main" id="together">
        <div class="main" id="purple">
            <div> 
                <h1>Your Share and Repair Account</h1>
                <p>Welcome to your Share and Repair account. If you are new, and would like a guide through the website, please click <a href="shareandrepairguide.pdf" target="_blank" rel="noopener noreferrer"><b>here</b></a></p>
            </div>
        </div>
        <div class="main" id="orange">
            <div> 
                <h3>Account Overview</h3>

                <?php
                    foreach($result as $report) {
                ?>
                <div class="form-group">
                    <br><label>First Name</label><br>
                    <input type="text" name="fname" class="form-control" value="<?php echo $report['fname']; ?>">
                </div>
                <div class="form-group">
                    <br><label>Last Name</label><br>
                    <input type="text" name="lname" class="form-control" value="<?php echo $report['lname']; ?>">
                </div>
                <div class="form-group">
                    <br><label>Username</label><br>
                    <input type="text" name="username" class="form-control" value="<?php echo $report['username']; ?>" style="background-color: grey; opacity: 0.4;" readonly>
                </div>
                <div class="form-group">
                    <br><label>Email</label><br>
                    <input type="text" name="email" class="form-control" value="<?php echo $report['email']; ?>">
                </div>
                <div class="form-group">
                    <br><label>Telephone or Mobile number</label><br>
                    <input type="text" name="phone" class="form-control" value="<?php echo $report['phone']; ?>">
                </div>
                <?php
                    }
                ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <br><label>New Password</label><br>
                        <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <br><label>Confirm Password</label><br>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span><br>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a class="btn btn-link ml-2" href="account.php">Cancel</a>
                    </div>
                </form>


            </div>
        </div>
        <div class="main" id="purple">
            <div> 
                <h3>Membership</h3>
            </div>
        </div>
        <div class="main" id="orange">
        <div> 
            <h3>Privacy and Security</h3>
        </div>
    </div>
    <script>

    </script>
  </body>
</html>