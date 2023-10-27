<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="/resources/img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            background-color: #262626;
            overflow: hidden;
        }

        .wrapper {
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

        .btn-primary:hover {
            color: #fff;
            background-color: #3A3684;
            border-color: #3A3684;
        }

        .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #3A3684;
            border-color: #3A3684;
        }

        .registration-form {
            display: none;
        }
    </style>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/src/simple-header.php" ?>
<div class="wrapper">
    <h2>Sign Up / Login</h2>
    <p>Please enter your email to continue.</p>
    <form id="email-form">
        <a style="color:red;">*</a>Email Address: <input type="text" id="email" name="email"
                                                      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required/><br/>
        <button type="button" onclick="checkEmail();">Continue</button>
        <div class="registration-form" style="display: none;">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                       class="form-control"
                       value=""
                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                       title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password"
                       class="form-control"
                       value="">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="register" value="Register">
            <input type="submit" class="btn btn-primary" id="login" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </form>
</div>

<script>
    function checkEmail() {
        const email = document.getElementById('email').value;
        const registrationForm = document.querySelector('.registration-form');
        const loginButton = document.getElementById('login');
        const registerButton = document.getElementById('register');

        // Send an AJAX request to check if the email exists
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_email.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.exists) {
                    registrationForm.style.display = 'none';
                    loginButton.style.display = 'block';
                    registerButton.style.display = 'none';
                } else {
                    registrationForm.style.display = 'block';
                    loginButton.style.display = 'none';
                    registerButton.style.display = 'block';
                }
            }
        };
        xhr.send('email=' + email);
    }
</script>
</body>
</html>

