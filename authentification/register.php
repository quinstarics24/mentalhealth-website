<?php
ob_start();
session_start();
require_once "config.php";
include "../static/header.php";

// Initialize form variables and errors
$username = $email = $phone = $password = $confirm_password = "";
$username_err = $email_err = $phone_err = $password_err = $confirm_password_err = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (!empty($_POST["username"])) {
        $username = trim($_POST["username"]);
    } else {
        $username_err = "Please enter a username.";
    }

    // Validate email
    if (!empty($_POST["email"])) {
        $email = trim($_POST["email"]);
    } else {
        $email_err = "Please enter an email.";
    }

    // Validate phone
    if (!empty($_POST["phone"])) {
        $phone = trim($_POST["phone"]);
    } else {
        $phone_err = "Please enter a phone number.";
    }

    // Validate password
    if (!empty($_POST["password"])) {
        $password = trim($_POST["password"]);
        if (strlen($password) < 6) {
            $password_err = "Password must be at least 6 characters.";
        }
    } else {
        $password_err = "Please enter a password.";
    }

    // Confirm password
    if (!empty($_POST["confirm_password"])) {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }
    } else {
        $confirm_password_err = "Please confirm your password.";
    }

    // Register only as 'user'
    $role = "user";

    // If no errors, insert into users table
    if (empty($username_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $role);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                echo "Something went wrong. Please try again.";
            }
            $stmt->close();
        }
    }

    $mysqli->close();
}
?>

<!-- Registration Form HTML -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-user-plus"></i> Create an Account</h3>
                </div>
                <div class="card-body">
                    <p class="text-center text-muted">Join us today! Fill in your details to get started.</p>

                    <?php if ($username_err || $email_err || $phone_err || $password_err || $confirm_password_err): ?>
                        <div class="alert alert-danger">
                            <?php echo $username_err . "<br>" . $email_err . "<br>" . $phone_err . "<br>" . $password_err . "<br>" . $confirm_password_err; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                            <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="phone"><i class="fas fa-phone me-2"></i>Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                        </div>

                        <div class="form-group position-relative">
                            <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                            <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <i class="fas fa-eye toggle-password" toggle="#password"></i>
                        </div>

                        <div class="form-group position-relative">
                            <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                            <i class="fas fa-eye toggle-password" toggle="#confirm_password"></i>
                        </div>

                        <input type="hidden" name="role" value="user">

                        <div class="form-group text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-paper-plane"></i> Register
                            </button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password Script -->
<style>
    .toggle-password {
        position: absolute;
        top: 38px;
        right: 15px;
        cursor: pointer;
        color: #666;
    }
</style>

<script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', () => {
            const input = document.querySelector(icon.getAttribute('toggle'));
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php include "../static/footer.php"; ?>
<?php ob_end_flush(); ?>
