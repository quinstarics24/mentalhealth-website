<?php
session_start();
require_once "config.php"; 


$username = $password = $role = "";
$username_err = $password_err = $role_err = $login_err = "";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please select a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter your username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Proceed if no errors
    if (empty($username_err) && empty($password_err) && empty($role_err)) {
        $table = ($role == 'professional') ? "professionals" : "users";

        // Ensure the table exists
        $check_table = $mysqli->query("SHOW TABLES LIKE '$table'");
        if ($check_table->num_rows == 0) {
            die("Error: Table '$table' does not exist.");
        }

        // Prepare SQL query
        $sql = "SELECT id, username, password FROM $table WHERE username = ? LIMIT 1";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $db_username, $db_password);
                    if ($stmt->fetch()) {
                        if (!password_verify($password, $db_password)) {
                            $login_err = "Invalid username or password.";
                        } else {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $db_username;
                            $_SESSION["role"] = $role;
                            $_SESSION["user_id"] = ($role == 'professional') ? "professional_id" : "user_id";
                            $_SESSION[$_SESSION["user_id"]] = $id;

                            // Redirect
                            $redirect_page = ($role == 'professional') ? "../dashboards/professional.php" : "../dashboards/user.php";
                            header("location: $redirect_page");
                            exit();
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
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

<body>
    <!-- Include Header -->
    <?php include "../static/header.php"; ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container card p-5 shadow-lg rounded" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-4">Login</h2>

            <?php if (!empty($login_err)) echo '<div class="alert alert-danger">' . htmlspecialchars($login_err) . '</div>'; ?>
            <?php if (!empty($role_err)) echo '<div class="alert alert-danger">' . htmlspecialchars($role_err) . '</div>'; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="role" class="form-label">Login as</label>
                    <select name="role" id="role" class="form-select <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>">
                        <option value="">Select role</option>
                        <option value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="professional" <?php echo ($role == 'professional') ? 'selected' : ''; ?>>Professional</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo $role_err; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter username" value="<?php echo $username; ?>">
                    <div class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter password">
                    <div class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">Don't have an account <a href="register.php">Register Now</a>.</p>
            </form>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include "../static/footer.php"; ?>
</body>
