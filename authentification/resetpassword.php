<?php
// Include config file
require_once "config.php";

// Initialize variables
$email = "";
$email_err = $reset_msg = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Proceed if no errors
    if (empty($email_err)) {
        // Check if the email exists in the database
        $sql = "SELECT id, username FROM users WHERE email = ? LIMIT 1";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // Email exists, send reset link
                    $stmt->bind_result($id, $username);
                    if ($stmt->fetch()) {
                        $reset_token = bin2hex(random_bytes(50)); // Generate a reset token
                        $reset_link = "http://yourwebsite.com/reset_token.php?token=" . $reset_token;

                        // Save token to the database for future validation
                        $update_sql = "UPDATE users SET reset_token = ? WHERE email = ?";
                        if ($update_stmt = $mysqli->prepare($update_sql)) {
                            $update_stmt->bind_param("ss", $reset_token, $email);
                            if ($update_stmt->execute()) {
                                // Send reset email
                                $subject = "Password Reset Request";
                                $message = "Hello $username,\n\nClick the following link to reset your password:\n\n$reset_link";
                                $headers = "From: no-reply@yourwebsite.com";

                                if (mail($email, $subject, $message, $headers)) {
                                    $reset_msg = "A password reset link has been sent to your email address.";
                                } else {
                                    $reset_msg = "There was an error sending the email. Please try again.";
                                }
                            } else {
                                $reset_msg = "There was an error updating the reset token. Please try again.";
                            }
                        }
                    }
                } else {
                    $reset_msg = "No account found with that email address.";
                }
            } else {
                die("Error executing query: " . $mysqli->error);
            }
            $stmt->close();
        } else {
            die("Error preparing statement: " . $mysqli->error);
        }
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .reset-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .reset-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            margin-top: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="reset-container">
        <h2>Reset Password</h2>

        <?php if (!empty($reset_msg)) echo '<div class="alert alert-info">' . htmlspecialchars($reset_msg) . '</div>'; ?>
        <?php if (!empty($email_err)) echo '<div class="alert alert-danger">' . htmlspecialchars($email_err) . '</div>'; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Enter your email address</label>
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter your email">
                <div class="invalid-feedback">
                    <?php echo $email_err; ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            <p class="mt-3 text-center">Remembered your password? <a href="login.php">Login now</a>.</p>
        </form>
    </div>

</body>
</html>
