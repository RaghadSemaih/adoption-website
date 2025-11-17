<?php
session_start();
$conn = new mysqli("localhost", "root", "", "adaptly");

$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($email);
    $pass = trim($pass);

    if ($email != "" && $pass != "" &&
        filter_var($email, FILTER_VALIDATE_EMAIL) &&
        strlen($pass) >= 6
    ) {
        $query = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
        if ($query->num_rows > 0) {
            $_SESSION['email'] = $email;
            header("Location: http://localhost/projectWeb/");
            exit();
        } else {
            $message = "Incorrect email or password.";
        }
    } else {
        $message = "Please fill all fields correctly.";
    }
}

        $loggedIn =$_SESSION['login'] = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        .login-container {
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
        .login {
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
        .login:hover {
            background: #A07D66;
        }
        .message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if ($message != '') echo "<p class='message'>$message</p>"; ?>

    <form id="login-form" method="POST">
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your email">
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
        </div>

        <button type="submit" class="login">Login</button>
    </form>
</div>

<script>
    document.getElementById("login-form").addEventListener("submit", function(e) {
        var email = document.getElementById("email").value.trim();
        var password = document.getElementById("password").value.trim();

        if (email === "" || password === "") {
            alert("Please fill in all fields!");
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