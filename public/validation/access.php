<?php
session_start(); // Start the session

// Include config file
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/config.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$email = "";
$email_err = "";
$show_password_fields = false; // Flag to determine whether to show password fields

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check if the email is entered
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
        // Check if the email exists in the database
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            // Set parameters
            $param_email = $email;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $show_password_fields = true; // User exists, show password fields
                } else {
                    $show_password_fields = false; // User doesn't exist, show registration fields
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Rest of your form processing logic for password and confirm password
    if ($show_password_fields) {
        // Password validation
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Confirm password validation
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="/resources/img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            font: 14px sans-serif;
            background-color: #262626;
            overflow: hidden;
        }
        .wrapper{
            border: 0.5em solid black;
            margin: 5em;
            padding: 2em;
            border-radius: 1em;
            background: rgba(255, 255, 255, 0.9);
            overflow: hidden;
        }
        .btn-primary {
            color: #fff;
            background-color: black;
            border-color: black;
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
        .registration-form { /* Style for registration form elements */
            display: none;
        }
    </style>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/src/simple-header.php" ?>
<div class="wrapper">
    <h2>Sign Up / Login</h2>
    <p>Please fill this form to create an account or login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <a style="color:red;">*</a>First Name: <input type="text" name="fname" class="fname" id="fname" required/><br/>
        <a style="color:red;">*</a>Last Name: <input type="text" name="lname" required/><br/>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <a style="color:red;">*</a>Email Address: <input type="text" name="email"
                                                     pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/><br/>
        <a style="color:red;">*</a>Telephone or Mobile number: <input type="text" name="tel"
                                                              pattern="[+ 0-9]{11}" required><br/>
        <button type="button" onclick="toggleForm();">Switch to
            <?php echo $show_password_fields ? 'Login' : 'Register'; ?> Form
        </button>
        <div class="registration-form" <?php echo $show_password_fields ? 'style="display: none;"' : ''; ?>>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $password; ?>"
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       required>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password"
                       class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                       value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="login" value="<?php echo $show_password_fields ? 'Login' : 'Register'; ?>">
        </div>
        <p><?php echo $show_password_fields ? 'Don\'t have an account? <a href="register.php">Register here</a>.' : 'Already have an account? <a href="login.php">Login here</a>.'; ?></p>
    </form>
</div>

<script>
    function toggleForm() {
        const registrationForm = document.querySelector('.registration-form');
        registrationForm.style.display = registrationForm.style.display === 'none' ? 'block' : 'none';
    }
</script>
</body>
</html>

