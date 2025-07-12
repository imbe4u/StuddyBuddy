<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("dependency/db.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // no md5, just raw text for now

    $query = mysqli_query($con, "SELECT * FROM domain WHERE username='$username' AND password='$password'");
    
    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        $_SESSION['alogin'] = $username;
        $_SESSION['id'] = $row['id'];

        // ✅ Redirect to main.php
        header("Location: main.php");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
        header("Location: index.php");
        exit();
    }
    if (!empty($_SESSION['errmsg'])) {
        echo '<div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $_SESSION['errmsg'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
        unset($_SESSION['errmsg']); // clear after showing
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <title>StudyBuddy</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>

    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&amp;display=swap'>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="nav">
        <div class="logo">
            <h2 class="logo1">Study</h2>
            <h2 class="logo2">Buddy</h2>
        </div>
        <div class="hamburger" onclick="toggleMenu()">&#9778;</div>
        <div class="navbar" id="navMenu">
           <a href="#" class="atag">Home</a>
           <a href="#" class="atag">About us</a>
           <a href="#" class="atag">Contact us</a>
           <a href="#" class="atag">Login/Signup</a>
        </div>
    </div>



        <div class="wrapper">
        <div class="login-box">
            <div class="login-header">

                <span> Login</span>
            </div>
            <form action="index.php" method="POST" get="" enctype="multipart/form-data"
                onsubmit="return login()">
                <div class="input-box">
                    <input type="text" id="user" class="input-field" name="username" required>

                    <label for="user" class="label">Username
                    </label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input-box">
                    <input type="password" id="pass" class="input-field" name="password" autocomplete="off">
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon" id="show-password">

                    </i>
                </div>
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot">
                        <a href="#">Forgot password</a>
                    </div>
                </div>

                <div class="input-box">
                    <input type="submit" class="input-submit" name="login" value="Login">
                </div>
                <div class="register">
                    <span>Don't have an account?
                        <a href="registration.php">Register</a></span>
                </div>
            </form>
        </div>

    </div>
    <?php
if (!empty($_SESSION['errmsg'])) {
    echo '<div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $_SESSION['errmsg'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>';
    unset($_SESSION['errmsg']); // clear after showing
}
?>


    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const hamburger = document.querySelector(".hamburger");
        const navbar = document.querySelector(".navbar");

        hamburger.addEventListener("click", () => {
            navbar.classList.toggle("active");
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="form.js"></script>
</body>

</html>