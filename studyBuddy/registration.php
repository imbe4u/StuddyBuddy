<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dependency/db.php';

    $username = $_POST['username'];
    $name = $_POST['studentname'];
    $email = $_POST['email'];
    $password =md5($_POST['password']);

    // Simple insert without duplicate check
    $sql = "INSERT INTO domain (`username`, `name`, `email`, `password`) 
            VALUES ('$username', '$name', '$email', '$password')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: white;
    margin: 0;
    padding: 0;
}
.main-container{
    display:flex;
    flex-direction:row;
    justify-content:space-evenly;
    width: 100%;
   
    
}

.banner{
    float:left;
    margin-top:5px;
}
.container {
    position: relative;
    float:right;
    width: 400px;
      background: white;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px 10px  rgba(0, 0, 0.2, 0.1);
    margin-right:70px;
    margin-top:10px;
    
}


h1 {
    text-align: center;
    color: #333;
    margin-top:-14px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="date"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #218838;
}

    </style>
</head>
<body>
    <div class="main-container">
    <div class="banner">
        <img src="assest/E9TtaYgKZu.gif" alt="">
    </div>
    <div class="container">
        <h1>Student Registration</h1>
        <form id="registrationForm" action="registration.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="studentname" name="studentname" required>
            
            <label for="stream">Username:</label>
            <input type="text" name="username">

            <label for="regno">Registration No:</label>
            <input type="text" name="studentregno" id="studentregno">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required></br></br>

            <input type="submit" value="Register" name="submit">
            
            <a href="index.php" style="padding: 10px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; font-family: Arial, sans-serif;">Login</a>


        </form>
    </div>
</div>
</body>
</html>