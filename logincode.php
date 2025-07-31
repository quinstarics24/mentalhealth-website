<?php
session_start();

// Hardcoded username and password
$username = "admin237";
$password = "0000";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Check if username and password match
    if ($input_username === $username && $input_password === $password) {
        // Authentication successful, set session variable
        $_SESSION["loggedin"] = true;

        // Redirect to main dashboard
        header("Location: dashboards/admin/admin.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safe Space</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABDo4gJ8V8CkRfdU6P5XSH8ihfM8q8HgFxR1Yw5JtRoc9JoR8p35X+8" crossorigin="anonymous">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        /* Custom Styling for the Login Page */
        body {
            background: linear-gradient(to right, rgb(82, 147, 226), rgb(236, 228, 223));
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        .input-box input:focus {
            border-color: #007bff;
        }

        .input-box i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #007bff;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .remember-forgot a {
            color: #007bff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Error Message Display -->
        <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

        <h1> Admin Login</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-box">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
