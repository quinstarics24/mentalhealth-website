<?php
session_start();
require '../includes/db.php'; // Ensure you have a database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));
    $user_ip = $_SERVER['REMOTE_ADDR']; // Capture user IP

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        $_SESSION['error'] = "All required fields must be filled!";
        header("Location: ../contact.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header("Location: contact.php");
        exit();
    }

    // Database connection and insertion
    try {
        $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, phone, email, message, user_ip) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $phone, $email, $message, $user_ip]);

        // Send email notification
        $to = "admin@safespace.com"; // Replace with your admin email
        $subject = "New Contact Form Submission from $first_name $last_name";
        $headers = "From: Safe Space <no-reply@safespace.com>\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $email_body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $first_name $last_name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong> $message</p>
            <p><strong>IP Address:</strong> $user_ip</p>
            <br>
            <p>This message was sent via the Safe Space website.</p>
        ";

        mail($to, $subject, $email_body, $headers);

        // Set success message and redirect
        $_SESSION['success'] = "Your message has been sent successfully!";
        header("Location: contact.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Something went wrong. Please try again later.";
        error_log("Database error: " . $e->getMessage());
        header("Location: contact.php");
        exit();
    }
} else {
    // Redirect to contact page if not a POST request
    header("Location: contact.php");
    exit();
}
?>
