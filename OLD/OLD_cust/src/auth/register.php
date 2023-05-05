<?php

// Initialize the session
session_start();

require_once "/scripts/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $fname = $link->real_escape_string($_POST['fname']);
        $lname = $link->real_escape_string($_POST['lname']);
        $email = $link->real_escape_string($_POST['email']);
        $phone = $link->real_escape_string($_POST['phone']);
        // $line1 = $link->real_escape_string($_POST['address.line1']);
        // $line2 = $link->real_escape_string($_POST['address.line2']);
        // $city = $link->real_escape_string($_POST['address.city']);
        // $state = $link->real_escape_string($_POST['address.state']);
        // $postal_code = $link->real_escape_string($_POST['postal_code']);

        // // Prepare Stripe integration
        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51K421WCw0LHBjO9dIAJNNGNcRjffMkysypm5pGPiPivDhymhBknaiJu601mH17q3rKsNi0KH8ykR4SBYM61mp6Fu00WgblnesL'
        // );
        // // Create new customer in Stripe based on customer details
        // $stripe->customers->create([
        //     'name' => $fname . ' ' . $lname,
        //     'description' => 'Created through Share and Repair Portal (via Stripe API)',
        //     'email' => $email,
        //     'phone' => $phone,
        //     'address.line1' => $line1,
        //     'address.line2' => $line2,
        //     'address.city' => $city,
        //     'address.state' => $state,
        //     'address.postal_code' => $postal_code
        // ]);
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fname, lname, email, phone) VALUES (?, ?, '$fname','$lname','$email','$phone')";

         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                
                // Redirect to login page
                header("location: /index.php");
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
    <title>Sign Up</title>
    <?php include "./scripts/js.php"?>
    <?php include "./scripts/css.php"?>
    <style>
        body{
            font: 14px sans-serif;
            background-image: url('/src/img/background.jpg');
            /*overflow: hidden;*/
            width: 100%;
        }
        .wrapper{
            border: 0.1em solid #FFFFFF;
            margin: 3em;
            margin-bottom:4em;
            padding: 2em;
            border-radius: 1em;
            background: rgba(255, 255, 255, 0.9);
            overflow: hidden;
        }
        .btn-primary {
            color: #fff;
            background-color: #F36F21;
            border-color: #F36F21;
        }
        .btn-primary:hover{
            color: #fff;
            background-color: #3A3684;
            border-color: #3A3684;
        }
        .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #3A3684;
            border-color: #3A3684;
        }
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <a style="color:red;">*</a>First Name:<input type="text" name = "fname" class='fname' id='fname' required/><br/>
        <a style="color:red;">*</a>Last Name: <input type="text" name = "lname" required/><br/>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <a style="color:red;">*</a>Email Address: <input type="text" name = "email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/><br/>
            <a style="color:red;">*</a>Telephone or Mobile number: <input type="text" name="tel" pattern="[+ 0-9]{11}" required><br/><br/>
            <a style="color:red;">*</a>Address Line 1: <input type="text" name = "address.line1" required/><br/>
            <a style="color:red;">*</a>Address Line 2: <input type="text" name = "address.line2" required/><br/>
            <a style="color:red;">*</a>City: <input type="text" name = "address.city" required/><br/>
            <a style="color:red;">*</a>County: <input type="text" name = "address.state" required/><br/>
            <a style="color:red;">*</a>Postcode: <input type="text" name = "address.postal_code" required/><br/><br/>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="login" value="Register">
            </div>
            <p>Already have an account? <a href="/index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>