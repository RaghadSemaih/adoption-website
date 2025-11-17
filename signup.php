<?php
$conn = new mysqli("localhost", "root", "", "adaptly");

$name = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($name);
    $email = trim($email);
    $pass = trim($pass);

    if ($name != "" && $email != "" && $pass != "" &&
        preg_match("/^[A-Za-z\s]+$/", $name) &&
        filter_var($email, FILTER_VALIDATE_EMAIL) &&
        strlen($pass) >= 6
    ) {
        $conn->query("INSERT INTO users (firstname, email, password) 
                      VALUES ('$name', '$email', '$pass')");
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #FAF1EA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .signup-container {
            background: #D8B99C;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .input-group {
            margin: 15px 0;
            text-align: left;
        }
        label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #C6A58E;
            border-radius: 5px;
            background: #FAF1EA;
        }
        .signup {
            background: #C6A58E;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            transition: 0.3s;
        }
        .signup:hover {
            background: #A07D66;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Create an Account</h2>

    <form id="signup-form" method="POST">
        <div class="input-group">
            <label for="firstname">Your Name</label>
            <input type="text" id="firstname" name="firstname" placeholder="Enter your name">
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>

        <button type="submit" class="signup">Sign Up</button>
    </form>
</div>

<script>
    document.getElementById("signup-form").addEventListener("submit", function(e) {
        var name = document.getElementById("firstname").value.trim();
        var email = document.getElementById("email").value.trim();
        var password = document.getElementById("password").value.trim();
        var namevalidation = /^[A-Za-z\s]+$/;

        if (name === "" || email === "" || password === "") {
            alert("Please fill in all fields!");
            e.preventDefault();
            return;
        }
        if (!namevalidation.test(name)) {
            alert("Name should contain only letters and spaces.");
            e.preventDefault();
            return;
        }
        if (email.indexOf('@') === -1) {
            alert("Please enter a valid email address.");
            e.preventDefault();
            return;
        }
        if (password.length < 6) {
            alert("Password should be at least 6 characters long.");
            e.preventDefault();
            return;
        }
    });
</script>

</body>
</html>
